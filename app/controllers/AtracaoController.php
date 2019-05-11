<?php
namespace Controllers;

use Models\AtracaoModel;

class AtracaoController {
    public function listar($request, $response, $app, $args) {
        $mod = new AtracaoModel();
        $resultado = $mod->listar($app); 

        return $response->withJson($resultado,200); 
    }
    
    public function buscarPorId($request, $response, $args) {
        
    }

    public function inserir( $request, $response, $args) {        
        // $a = $request->getParsedBody(); 
        // $atracao = new Atracao($a['nome'], $a['descricao'], $a['inicio'], $a['fim'], $a['categoria'], $a['endereco'], $a['lat'], $a['lng']);

        // $mod = new AtracaoModel;
        // $resultado = $mod->inserir($atracao); 

        // return $response->withJson($resultado,201);   
    }
    
    public function atualizar($request, $response, $args) {
          
    }

    public function deletar($request, $response, $args) {
        
    }
}