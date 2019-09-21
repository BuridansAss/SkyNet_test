<?php

include './autoload.php';

including(SRC);

$uri = urlSlice();

App\Render\Render::setController($uri[CONTROLLER]);
App\Render\Render::setAction($uri[ACTION]);


callAction();