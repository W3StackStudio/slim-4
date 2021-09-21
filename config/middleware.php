<?php


use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {

    $basePath = '/iact-api';

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->add(new Tuupola\Middleware\JwtAuthentication([
        "secret" => AUTH_KEY,
        "ignore" => [
            $basePath . "/auth/sign-up-with-email-or-phone",
            $basePath . "/auth/sign-in-with-email-or-phone",
        ],
        "before" => function ($request) {
        },
        "after" =>  function ($request, $args) {
        },
        "error" => function ($response, $arguments) {
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->getBody()->write(json_encode($data));
        }
    ]));
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();


    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
};
