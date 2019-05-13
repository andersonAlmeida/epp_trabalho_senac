<?php
namespace Controllers;

use Models\FotoModel;

class FotoController {

    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $fotos = FotoModel::all();
        
        return $response->withJson($fotos, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();        

        $foto = FotoModel::create($p);
        return $response->withJson($foto, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];

        $foto = FotoModel::find($id);

        $foto->imagem = $p['imagem'];
        $foto->fotoable_id = $p['fotoable_id'];
        $foto->fotoable_type = $p['fotoable_type'];

        try {

            $foto->save();  
            
            return $response->withJson($foto, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $foto = FotoModel::find($id);
    
            return $response->withJson($foto, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $foto = FotoModel::find($id);

        if( $foto ) {
            $foto->delete();    
        } else {
            $foto = new \stdClass();
            
            $foto->resposta = false;
            $foto->msg = "Foto não encontrada.";
        }        

        return $response->withJson($foto, 200); 
    }
}

?>