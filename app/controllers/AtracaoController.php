<?php
namespace Controllers;

use Models\AtracaoModel;

class AtracaoController {

    public function __construct() {}

    public static function listar( $request, $response, $args ) {
        $atracoes = AtracaoModel::with(['categoria', 'fotos', 'avaliacoes'])->orderBy('cod_atracao')->get();
        
        return $response->withJson($atracoes, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $dados = [];

        foreach($p as $key => $value) {
            if( empty($value) ) $value = null;
            
            $dados[$key] = $value;
        }                

        $atracao = AtracaoModel::create($dados);
        return $response->withJson($atracao, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];

        try {
            $atracao = AtracaoModel::find($id);

            $atracao->nome = $p['nome'];
            $atracao->descricao = $p['descricao'];
            $atracao->data_inicio = !empty($p['data_inicio']) ? $p['data_inicio'] : null;
            $atracao->data_fim = !empty($p['data_fim']) ? $p['data_fim'] : null;
            $atracao->cod_atracao_categoria = $p['cod_atracao_categoria'];
            $atracao->endereco = $p['endereco'];
            $atracao->lat = $p['lat'];
            $atracao->lng = $p['lng'];

            $atracao->save();  
            
            return $response->withJson($atracao, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $atracao = AtracaoModel::with(['categoria', 'fotos'])->find($id);
    
            return $response->withJson($atracao, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $atracao = AtracaoModel::find($id);

        if( $atracao ) {
            $atracao->delete();    
        } else {
            $atracao = new \stdClass();
            
            $atracao->resposta = false;
            $atracao->msg = "Atração não encontrada.";
        }        

        return $response->withJson($atracao, 200); 
    }
}

?>