<?php
namespace Controllers;

use Models\ClienteModel;

class ClienteController {
    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $clientes = ClienteModel::with('nivel')->orderBy('cod_cliente')->get();
        
        return $response->withJson($clientes, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = $p['senha'];
        $nivel = $p['cod_nivel'];

        $cliente = ClienteModel::create(['nome'=>$nome,'email'=>$email,'senha'=>$senha,'cod_nivel'=>$nivel]);
        return $response->withJson($cliente, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = $p['senha'];
        $nivel = $p['cod_nivel'];

        try {
            $cliente = ClienteModel::find($id);

            $cliente->nome = $nome;
            $cliente->email = $email;
            $cliente->senha = $senha;
            $cliente->cod_nivel = $nivel;

            $cliente->save();  
            
            return $response->withJson($cliente, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $cliente = ClienteModel::find($id);
    
            return $response->withJson($cliente, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $cliente = ClienteModel::find($id);

        if( $cliente ) {
            $cliente->delete();    
        } else {
            $cliente = new \stdClass();
            
            $cliente->resposta = false;
            $cliente->msg = "Usuário não encontrado.";
        }        

        return $response->withJson($cliente, 200); 
    }
}

?>