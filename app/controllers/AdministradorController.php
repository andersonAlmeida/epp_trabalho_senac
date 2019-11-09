<?php
namespace Controllers;

use Models\AdministradorModel;
use \Firebase\JWT\JWT;

class AdministradorController {
    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $admins = AdministradorModel::orderBy('cod_admin')->get();
        
        return $response->withJson($admins, 200); 
    }

    public static function criar_admin($request, $response, $args){
        $p = $request->getParsedBody();
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = password_hash($p['senha'], PASSWORD_DEFAULT); // criptografa a senha do Admin para salvarno banco

        $admin = AdministradorModel::create(['nome'=>$nome,'email'=>$email,'senha'=>$senha]);
        return $response->withJson($admin, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = password_hash($p['senha'], PASSWORD_DEFAULT); // criptografa a senha do Admin para salvarno banco
        $resposta = null;

        try {
            $admin = AdministradorModel::find($id);

            $admin->nome = $nome;
            $admin->email = $email;
            $admin->senha = $senha;

            $resposta = $admin->save();  
            
            return $response->withJson($resposta, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $admin = AdministradorModel::find($id);
    
            return $response->withJson($admin, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $admin = AdministradorModel::find($id);

        if( $admin ) {
            $admin->delete();    
        } else {
            $admin = new \stdClass();
            
            $admin->resposta = false;
            $admin->msg = "Administrador não encontrado.";
        }        

        return $response->withJson($admin, 200); 
    }

    public static function login($request, $response, $args, $sKey) {
        $p = $request->getParsedBody();
        $admin = AdministradorModel::where('email', $p['email'])->get();

        foreach ($admin as $a) {
            if( password_verify( $p['senha'], $a->senha ) ) {
                $token = array(
                    'user' => strval($a->cod_admin),
                    'nome' => $a->nome
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