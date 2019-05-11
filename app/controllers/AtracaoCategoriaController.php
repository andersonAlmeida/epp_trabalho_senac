<?php
namespace Controllers;

use Models\AtracaoCategoriaModel;

class AtracaoCategoriaController {

    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $categorias = AtracaoCategoriaModel::orderBy('cod_atracao_categoria')->get();
        
        return $response->withJson($categorias, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $nome = $p['nome'];

        $categoria = AtracaoCategoriaModel::create(['nome'=>$nome]);
        return $response->withJson($categoria, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];

        try {
            $categoria = AtracaoCategoriaModel::find($id);

            $categoria->nome = $nome;

            $categoria->save();  
            
            return $response->withJson($categoria, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $categoria = AtracaoCategoriaModel::find($id);
    
            return $response->withJson($categoria, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $categoria = AtracaoCategoriaModel::find($id);

        if( $categoria ) {
            $categoria->delete();    
        } else {
            $categoria = new \stdClass();
            
            $categoria->resposta = false;
            $categoria->msg = "Categoria não encontrada.";
        }        

        return $response->withJson($categoria, 200); 
    }
}

?>