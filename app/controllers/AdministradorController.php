<?php
namespace Controllers;

use Illuminate\Database\Query\Builder;
use Models\AdministradorModel;

class AdministradorController {
    protected $table;

    public function __construct(
        Builder $table
    ) {
        $this->table = $table;
    }

    public static function listar( $request, $response, $args ) {
        $admins = AdministradorModel::all();
        
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
}

?>