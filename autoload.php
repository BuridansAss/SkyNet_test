<?php
define('CONTROLLER', 'controller');
define('ACTION', 'action');
define('PARAMS', 'params');
define('SRC', __DIR__ . '/src');
//define('CSS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/css/styles.css');
//define('JS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/js/app.js');

function whereAmI() {
    $whereAmI = explode(DIRECTORY_SEPARATOR, __DIR__);
    $result = '';

    foreach ($whereAmI as $key => $value) {
        $result .= $value . '/';
    }

    return $result;
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

    $count = count($uri) - 1;
    $path = '';

    if ($count > 3) {
        foreach ($uri as $key => $value) {
            if ($value != $myFolder) {
                $path .= $value . '/';
                unset($uri[$key]);
                continue;
            }
            $path .= $value . '/';

            break;
        }
        define('CSS', 'http://' . $_SERVER['HTTP_HOST'] . $path . 'public/css/styles.css');
        define('JS', 'http://' . $_SERVER['HTTP_HOST'] . $path .'/public/js/app.js');
    } else {
        define('CSS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/css/styles.css');
        define('JS', 'http://' . $_SERVER['HTTP_HOST'] . '/public/js/app.js');
    }


    $uri = array_values($uri);

    (isset($uri[1]) && $uri[1] !== '') ? $split[CONTROLLER] = $uri[1] : $split[CONTROLLER] = 'Main';
    (isset($uri[2]) && $uri[2] !== '') ? $split[ACTION] = $uri[2] : $split[ACTION] = 'index';
    (isset($uri[3]) && $uri[3] !== '') ? $split[PARAMS] = $uri[3] : null;

    if (isset($split[PARAMS])) {
        parse_str($split[PARAMS], $split[PARAMS]);
    }

    unset($uri);

    return $split;
}

/**
 * @return object
 *
 * create Controller object
 */
function createController()
{
    $name = ucfirst(urlSlice()[CONTROLLER]);

    $controller = '\\App\\Controllers\\' . $name;
    $controller404 = '\\App\\Controllers\\Controller404';
    $pathToController = SRC . '/Controllers/' . $name . '.php';

    if (file_exists($pathToController)) {
        $object = new $controller();
        return $object;
    } else {
        $object = new $controller404();
        call_user_func([$object, 'index'], urlSlice()[PARAMS]);
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
    $slice = urlSlice();

    if (isset($slice[PARAMS])) {
        call_user_func([createController(), urlSlice()[ACTION]], urlSlice()[PARAMS]);
    } else {
        call_user_func([createController(), urlSlice()[ACTION]]);
    }
}