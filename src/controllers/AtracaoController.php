<?php
// use App\AtracaoModel;

include_once __DIR__ . '/../classes/Atracao.php';
include_once __DIR__ . '/../models/AtracaoModel.php';


class AtracaoController {
    public function listar($request, $response, $args) {
         return 'oi';
    }
    
    public function buscarPorId($request, $response, $args) {
        
    }

    public function inserir( $request, $response, $args) {        
        $a = $request->getParsedBody(); 
        $atracao = new Atracao($a['nome'], $a['descricao'], $a['inicio'], $a['fim'], $a['categoria'], $a['endereco'], $a['lat'], $a['lng']);

        $mod = new AtracaoModel;
        $resultado = $mod->inserir($atracao); 

        return $response->withJson($resultado,201);   
    }
    
    public function atualizar($request, $response, $args) {
          
    }

    public function deletar($request, $response, $args) {
        
    }
}