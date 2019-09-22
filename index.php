<?php
error_reporting(0);

include './autoload.php';
including(SRC);

global $split;

App\Render\Render::setController($split[CONTROLLER]);
App\Render\Render::setAction($split[ACTION]);


callAction();