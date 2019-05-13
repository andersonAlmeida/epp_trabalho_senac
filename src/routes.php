<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use Controllers\AtracaoController;
use Controllers\AtracaoCategoriaController;
use Controllers\AdministradorController;
use Controllers\NivelController;
use Controllers\ClienteController;
use Controllers\FotoController;
use Controllers\AvaliacaoController;
use Controllers\CupomController;

return function (App $app) {
    $container = $app->getContainer();

    // ===============================================================================================
    // CMS ===========================================================================================
    // ===============================================================================================
    $app->group('/cms/admin', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return AdministradorController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return AdministradorController::criar_admin($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return AdministradorController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return AdministradorController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return AdministradorController::deletar($request, $response, $args);
        });

        $app->post('/login[/]', function($request, $response, $args) use ($app, $container){             
            $sk = $container->get('settings')['jwt']['secret'];            
            return AdministradorController::login($request, $response, $args, $sk);
        });
    });

    $app->group('/cms/nivel', function() use ($app) {
        $app->get('[/]', function($request, $response, $args) {            
            return NivelController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return NivelController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return NivelController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return NivelController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return NivelController::deletar($request, $response, $args);
        });
    });
    
    $app->group('/cms/categoria', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return AtracaoCategoriaController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return AtracaoCategoriaController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return AtracaoCategoriaController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return AtracaoCategoriaController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return AtracaoCategoriaController::deletar($request, $response, $args);
        });
    });

    $app->group('/cms/atracao', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return AtracaoController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return AtracaoController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return AtracaoController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return AtracaoController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return AtracaoController::deletar($request, $response, $args);
        });
    });

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
    });

    // Foto
    $app->group('/foto', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return FotoController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return FotoController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return FotoController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return FotoController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return FotoController::deletar($request, $response, $args);
        });
    });
    
    // Avaliação
    $app->group('/avaliacao', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return AvaliacaoController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return AvaliacaoController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return AvaliacaoController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return AvaliacaoController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return AvaliacaoController::deletar($request, $response, $args);
        });
    });

    // Cupom
    $app->group('/cupom', function() use ($app, $container) {
        $app->get('[/]', function($request, $response, $args) {            
            return CupomController::listar($request, $response, $args);
        });

        $app->post('[/]', function($request, $response, $args) { 
            return CupomController::inserir($request, $response, $args);
        });
    
        $app->get('/{id}[/]', function($request, $response, $args) {            
            return CupomController::buscarPorId($request, $response, $args);
        }); 

        $app->put('/{id}[/]', function($request, $response, $args) {            
            return CupomController::atualizar($request, $response, $args);
        });

        $app->delete('/{id}[/]', function($request, $response, $args) {            
            return CupomController::deletar($request, $response, $args);
        });
    });

    // Autenticação
    // $app->post('/login', function($request, $response, $args) { 
    //     return ClienteController::login($request, $response, $args);
    // });
};
