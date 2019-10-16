<?php
define('CONTROLLER', 'controller');
define('ACTION', 'action');
define('PARAMS', 'params');
define('SRC', __DIR__ . '/src');

if ($_SERVER['HTTPS'] !='') {
    define ('PROTOCOL', 'https://');
} else {
    define ('PROTOCOL', 'http://');
}

/**
 * @return array
 */
function urlSlice()
{
    $split = [];
    $uri = explode("/", $_SERVER['REQUEST_URI']);

    $whereAmI = explode(DIRECTORY_SEPARATOR, __DIR__);


    //узнаю название совей дирректории
    $myFolder = $whereAmI[count($whereAmI) - 1];


    $flag = true;
    $path = '/';
    $i = 0;

    if (strpos($_SERVER['REQUEST_URI'], $myFolder) == 0) {
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $i = 1;
    } else {
        foreach ($uri as $key => $value) {
            if ($value == '') {
                $i++;
                continue;
            }

            if ($value != $myFolder) {
                $path .= $value . '/';
                $i++;
                $flag = true;
                continue;
            }
            $path .= $value . '/';
            $i++;
            $flag = false;
            break;
        }

    }

    //костыльный костыль для добавления в занка вопроса а зачем? => читай ниже
    if ($_SERVER['REQUEST_URI'] == $path || $path == '//') {
        $_SERVER['REQUEST_URI'] = '/?';
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $i = 1;
    }


    //убираем знак вопроса чтоб корректно понять какйо контроллер
    // а добавил знак вопроса чтоб сервер не считал "/" за разделитель дирректорий а считал запрос как параметр
    $uri[$i] = substr($uri[$i], 1);

    if ($flag === false) {
        define('CSS', PROTOCOL . $_SERVER['HTTP_HOST'] . $path . 'public/css/styles.css');
        define('JS',  PROTOCOL . $_SERVER['HTTP_HOST'] . $path .'public/js/app.js');
        define('PREFIX', $path);

        (isset($uri[$i]) && $uri[$i] !== '') ? $split[CONTROLLER] = $uri[$i] : $split[CONTROLLER] = 'Main';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[ACTION]   = $uri[$i] : $split[ACTION] = 'index';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[PARAMS]   = $uri[$i] : null;
    } else {
        define('CSS', PROTOCOL . $_SERVER['HTTP_HOST'] . '/public/css/styles.css');
        define('JS',  PROTOCOL . $_SERVER['HTTP_HOST'] . '/public/js/app.js');
        define('PREFIX', '/');

        (isset($uri[$i])   && $uri[$i]  !== '') ? $split[CONTROLLER] = $uri[$i] : $split[CONTROLLER] = 'Main';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[ACTION]    = $uri[$i] : $split[ACTION] = 'index';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[PARAMS]    = $uri[$i] : null;
    }

    if (isset($split[PARAMS])) {
        parse_str($split[PARAMS], $split[PARAMS]);
    }

    unset($uri);

    return $split;
}

$split = urlSlice();

/**
 * @return object
 *
 * create Controller object
 */
function createController()
{
    global $split;

    $name = ucfirst($split[CONTROLLER]);

    $controller = '\\App\\Controllers\\' . $name;
    $controller404 = '\\App\\Controllers\\Controller404';
    $pathToController = SRC . '/Controllers/' . $name . '.php';

    if (file_exists($pathToController)) {
        $object = new $controller();
        return $object;
    } else {
        $object = new $controller404();
        call_user_func([$object, 'index'], $split[PARAMS]);
        die();
    }
}

/**
 *
 * include all php files as PSR-4
 * @param $dir
 *
 */
function including($dir)
{
    if (is_dir($dir)) {
        $structure = scandir($dir);
        $structure = array_diff($structure, ['.', '..']);

        foreach ($structure as $s) {
            if (ctype_upper($s[0])) {

                $s = $dir . '/' . $s;

                if ((substr($s, -4) === '.php')) {
                    include $s;
                }
                including($s);
            }
        }
    }
}

function callAction()
{
    global $split;
    $slice = $split;

    if (isset($slice[PARAMS])) {
        call_user_func([createController(), $split[ACTION]], $split[PARAMS]);
    } else {
        call_user_func([createController(), $split[ACTION]]);
    }
}