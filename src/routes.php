<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use Controllers\AtracaoController;
use Controllers\AdministradorController;

// include_once  __DIR__ . '/controllers/UsuarioController.php';
// include_once  __DIR__ . '/controllers/AtracaoController.php';

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($app, $container) {
        $db = $app->getContainer()->get('db');
        $usuarios = $db->table('usuario')->get();

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

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
    
        $app->get('/{id}','UsuarionController:buscarPorId');    
        $app->put('/{id}','UsuarionController:atualizar');
        $app->delete('/{id}', 'UsuarionController:deletar');
    });
    
    $app->group('/cms/atracao', function() use ($app, $container) {
        $app->get('', function (Request $request, Response $response, array $args) use ($app, $container) {          
            $a = new AtracaoController;  
            $a->listar($request, $response, $app, $args);
        });
        $app->post('','AtracaoController:inserir');
    
        $app->get('/{id}','AtracaoController:buscarPorId');    
        $app->put('/{id}','AtracaoController:atualizar');
        $app->delete('/{id}', 'AtracaoController:deletar');
    });
};
