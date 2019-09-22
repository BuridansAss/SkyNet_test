<?php
define('CONTROLLER', 'controller');
define('ACTION', 'action');
define('PARAMS', 'params');
define('SRC', __DIR__ . '/src');

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

    $path = '';
    $i = 0;
    $flag = false;

    foreach ($uri as $key => $value) {
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

    if ($flag === false) {
        define('CSS', 'http://' . $_SERVER['HTTP_HOST'] . $path . 'public/css/styles.css');
        define('JS', 'http://' . $_SERVER['HTTP_HOST'] . $path .'public/js/app.js');
        define('PREFIX', $path);

        (isset($uri[$i]) && $uri[$i] !== '') ? $split[CONTROLLER] = $uri[$i] : $split[CONTROLLER] = 'Main';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[ACTION] = $uri[$i] : $split[ACTION] = 'index';
        (isset($uri[++$i]) && $uri[$i] !== '') ? $split[PARAMS] = $uri[$i] : null;
    } else {
        define('CSS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/css/styles.css');
        define('JS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/js/app.js');
        define('PREFIX', '/');

        (isset($uri[1]) && $uri[1] !== '') ? $split[CONTROLLER] = $uri[1] : $split[CONTROLLER] = 'Main';
        (isset($uri[2]) && $uri[2] !== '') ? $split[ACTION] = $uri[2] : $split[ACTION] = 'index';
        (isset($uri[3]) && $uri[3] !== '') ? $split[PARAMS] = $uri[3] : null;
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