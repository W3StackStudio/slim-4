<?php

use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\ImageController;

return function (App $app) {
    $app->get('/', HomeController::class . ':home');
};
