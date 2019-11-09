<?php
namespace Controllers;

use Models\CupomModel;

class cupomController {
    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $cupons = CupomModel::all();
        
        return $response->withJson($cupons, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $descricao = $p['descricao'];
        $data_criacao = $p['data_criacao'];        
        $data_expiracao = $p['data_expiracao'];
        $cod_cliente = $p['cod_cliente'];

        $cupom = CupomModel::create(['descricao'=>$descricao,'data_criacao'=>$data_criacao,'data_expiracao'=>$data_expiracao,'cod_cliente'=>$cod_cliente]);
        return $response->withJson($cupom, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $descricao = $p['descricao'];
        $data_criacao = $p['data_criacao'];        
        $data_expiracao = $p['data_expiracao'];
        $cod_cliente = $p['cod_cliente'];

        try {
            $cupom = CupomModel::find($id);

            $cupom->descricao = $descricao;
            $cupom->data_criacao = $data_criacao;
            $cupom->data_expiracao = $data_expiracao;
            $cupom->cod_cliente = $cod_cliente;

            $cupom->save();  
            
            return $response->withJson($cupom, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $cupom = CupomModel::find($id);
    
            return $response->withJson($cupom, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $cupom = CupomModel::find($id);

        if( $cupom ) {
            $cupom->delete();    
        } else {
            $cupom = new \stdClass();
            
            $cupom->resposta = false;
            $cupom->msg = "Cupom não encontrado.";
        }        

        return $response->withJson($cupom, 200); 
    }
}

?>