<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use Controllers\AtracaoController;
use Controllers\AtracaoCategoriaController;
use Controllers\AdministradorController;
use Controllers\NivelController;
use Controllers\FotoController;
use Controllers\AvaliacaoController;
use Controllers\CupomController;

use Controllers\ProdutoController;

return function (App $app) {
    $container = $app->getContainer();

    // Cliente
    $app->group('/cliente', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {
            return ClienteController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) {
            return ClienteController::inserir($request, $response, $args);
        });

        $app->get('/{id}[/]', function($request, $response, $args) {
            return ClienteController::buscarPorId($request, $response, $args);
        });

        $app->put('/{id}[/]', function($request, $response, $args) {
            return ClienteController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {
            return ClienteController::deletar($request, $response, $args);
        });

        $app->post('/login[/]', function($request, $response, $args) use ($app, $container){
            $sk = $container->get('settings')['jwt']['secret'];
            return ClienteController::login($request, $response, $args, $sk);
        });
    });

    // Cupom
    $app->group('/produtos', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {
            return ProdutoController::listar($request, $response, $args);
        });

        $app->get('/{id}[/]', function($request, $response, $args) {
            return ProdutoController::buscarPorId($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) {
            return ProdutoController::inserir($request, $response, $args);
        });


        $app->put('/{id}[/]', function($request, $response, $args) {
            return ProdutoController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {
            return ProdutoController::deletar($request, $response, $args);
        });
    });
};
