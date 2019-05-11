<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use Controllers\AtracaoCategoriaController;
use Controllers\AdministradorController;
use Controllers\NivelController;
use Controllers\ClienteController;

return function (App $app) {
    $container = $app->getContainer();

    // ===============================================================================================
    // CMS ===========================================================================================
    // ===============================================================================================
    $app->group('/cms/admin', function() use ($app) {
        $app->get('', function($request, $response, $args) {            
            return AdministradorController::listar($request, $response, $args);
        });

        $app->post('', function($request, $response, $args) { 
            return AdministradorController::criar_admin($request, $response, $args);
        });
    
        $app->get('/{id}', function($request, $response, $args) {            
            return AdministradorController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}', function($request, $response, $args) {            
            return AdministradorController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}', function($request, $response, $args) {            
            return AdministradorController::deletar($request, $response, $args);
        });
    });

    $app->group('/cms/nivel', function() use ($app) {
        $app->get('', function($request, $response, $args) {            
            return NivelController::listar($request, $response, $args);
        });

        $app->post('', function($request, $response, $args) { 
            return NivelController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}', function($request, $response, $args) {            
            return NivelController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}', function($request, $response, $args) {            
            return NivelController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}', function($request, $response, $args) {            
            return NivelController::deletar($request, $response, $args);
        });
    });
    
    $app->group('/cms/categoria', function() use ($app, $container) {
        $app->get('', function($request, $response, $args) {            
            return AtracaoCategoriaController::listar($request, $response, $args);
        });

        $app->post('', function($request, $response, $args) { 
            return AtracaoCategoriaController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}', function($request, $response, $args) {            
            return AtracaoCategoriaController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}', function($request, $response, $args) {            
            return AtracaoCategoriaController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}', function($request, $response, $args) {            
            return AtracaoCategoriaController::deletar($request, $response, $args);
        });
    });

    // Cliente
    $app->group('/cliente', function() use ($app, $container) {
        $app->get('', function($request, $response, $args) {            
            return ClienteController::listar($request, $response, $args);
        });

        $app->post('', function($request, $response, $args) { 
            return ClienteController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}', function($request, $response, $args) {            
            return ClienteController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}', function($request, $response, $args) {            
            return ClienteController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}', function($request, $response, $args) {            
            return ClienteController::deletar($request, $response, $args);
        });
    });
};
