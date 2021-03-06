<?php
namespace Controllers;

use Models\AvaliacaoModel;
use Models\ClienteModel;
use PHPUnit\Framework\Exception;

class AvaliacaoController {

    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $avaliacoes = AvaliacaoModel::with(['fotos', 'cliente'])->orderBy('cod_avaliacao')->get();
        
        return $response->withJson($avaliacoes, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $dados = [];

        foreach($p as $key => $value) {
            $dados[$key] = $value;
        }     
        
        try {
            $avaliacao = AvaliacaoModel::create($dados);

            if( $avaliacao ) {
                // Adiciona pontuação por ter avaliado
                // ex: https://stackoverflow.com/questions/37666135/how-to-increment-and-update-column-in-one-eloquent-query
                ClienteModel::where('cod_cliente', $dados['cod_cliente'])->increment('pontuacao', 10);
                
                // if( AvaliacaoController::calcularPontuacao($dados['cod_cliente']) > 50 ) {

                // }

                return $response->withJson($avaliacao, 201);
            }    
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function calcularPontuacao($id) {
        return ClienteModel::find($id)->select('pontuacao');
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];        

        try {
            $avaliacao = AvaliacaoModel::find($id);

            $avaliacao->nota = $p['nota'];
            $avaliacao->comentario = $p['comentario'];
            $avaliacao->cod_cliente = $p['cod_cliente'];
            $avaliacao->cod_atracao = $p['cod_atracao'];

            $avaliacao->save();  
            
            return $response->withJson($avaliacao, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $avaliacao = AvaliacaoModel::with('fotos')->find($id);
    
            return $response->withJson($avaliacao, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $avaliacao = AvaliacaoModel::find($id);

        if( $avaliacao ) {
            $avaliacao->delete();    
        } else {
            $avaliacao = new \stdClass();
            
            $avaliacao->resposta = false;
            $avaliacao->msg = "Avaliação não encontrada.";
        }        

        return $response->withJson($avaliacao, 200); 
    }
}

?>