<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($app, $container) {
        $db = $app->getContainer()->get('db');
        $usuarios = $db->table('usuario')->get();

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
