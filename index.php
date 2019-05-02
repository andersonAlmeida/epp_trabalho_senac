<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('./controllers/UsuarioController.php');
require './vendor/autoload.php';
$app = new \Slim\App;

define('DS', DIRECTORY_SEPARATOR);
define('DR', realpath(dirname(__FILE__)).DS);

$app->group('/usuario', function() use ($app) {
    $app->get('','UsuarioController:listar');
    $app->post('','UsuarioController:inserir');

    $app->get('/{id}','UsuarioController:buscarPorId');    
    $app->put('/{id}','UsuarioController:atualizar');
    $app->delete('/{id}', 'UsuarioController:deletar');
});

$app->run();

?>
