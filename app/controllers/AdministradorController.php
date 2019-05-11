<?php
namespace Controllers;

use Illuminate\Database\Query\Builder;
use Models\AdministradorModel;
use TheSeer\Tokenizer\Exception;

class AdministradorController {
    protected $table;

    public function __construct(
        Builder $table
    ) {
        $this->table = $table;
    }

    public static function listar( $request, $response, $args ) {
        $admins = AdministradorModel::orderBy('cod_admin')->get();
        
        return $response->withJson($admins, 200); 
    }

    public static function criar_admin($request, $response, $args){
        $p = $request->getParsedBody();
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = $p['senha'];

        $admin = AdministradorModel::create(['nome'=>$nome,'email'=>$email,'senha'=>$senha]);
        return $response->withJson($admin, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];
        $email = $p['email'];
        $senha = $p['senha'];
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
}

?>