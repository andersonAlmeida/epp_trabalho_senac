<?php
namespace Controllers;

use Models\ClienteModel;
use \Firebase\JWT\JWT;

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
        $senha = password_hash($p['senha'], PASSWORD_DEFAULT); // criptografa a senha do Cliente para salvar no banco
        $nivel = $p['cod_nivel'];
        
        if( ClienteController::verificaEmail($email) == NULL ) { // verifica se o email já foi cadastrado
            $cliente = ClienteModel::create(['nome'=>$nome,'email'=>$email,'senha'=>$senha,'cod_nivel'=>$nivel]);
            return $response->withJson($cliente, 201); 
        } else {
            return $response->withJson([
                "resposta" => false,
                "msg" => "E-mail já cadastrado"
            ], 200); 
        }       

    }

    public static function verificaEmail($email) {
        return ClienteModel::where('email', $email)->first();
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = password_hash($p['senha'], PASSWORD_DEFAULT); // criptografa a senha do Cliente para salvar no banco
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

    public static function login($request, $response, $args, $sKey) {
        $p = $request->getParsedBody();
        $cliente = ClienteModel::where('email', $p['email'])->get();

        foreach ($cliente as $c) {
            if( password_verify( $p['senha'], $c->senha ) ) {
                date_default_timezone_set('America/Sao_Paulo');

                $token = array(
                    'user' => strval($c->cod_cliente),
                    'nome' => $c->nome,
                    'date' => date("Y-m-d H:i:s"),
                    'iat' => time(),
                    'nbf' => time() + 10,
                    'exp' => time() + 3600
                );
                
                $jwt = JWT::encode($token, $sKey);

                return $response->withJson(["token" => $jwt], 201)
                    ->withHeader('Content-type', 'application/json');   
            } else {
                return $response->withJson(["resposta"=> false, "msg" => "Usuário ou senha inválidos"], 200);           
            }
        }

    }
}

?>