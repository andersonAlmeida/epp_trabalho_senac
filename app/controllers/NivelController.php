<?php
namespace Controllers;

// use Illuminate\Database\Query\Builder;
use Models\NivelModel;
use PHPUnit\Framework\MockObject\Stub\Exception;

// use TheSeer\Tokenizer\Exception;

class NivelController {
    // protected $table;

    public function __construct() {
        // $this->table = $table;
    }

    public static function listar( $request, $response, $args ) {
        $niveis = NivelModel::orderBy('cod_nivel')->get();
        
        return $response->withJson($niveis, 200); 
    }

    public static function inserir($request, $response, $args){
        $p = $request->getParsedBody();
        $nome = $p['nome'];

        $nivel = NivelModel::create(['nome'=>$nome]);
        return $response->withJson($nivel, 201); 
    }

    public static function atualizar($request, $response, $args) {
        $p = $request->getParsedBody();
        $id = $args['id'];
        $nome = $p['nome'];

        try {
            $nivel = NivelModel::find($id);

            $nivel->nome = $nome;

            $nivel->save();  
            
            return $response->withJson($nivel, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public static function buscarPorId($request, $response, $args) {        
        $id = $args['id'];

        try {
            $nivel = NivelModel::find($id);
    
            return $response->withJson($nivel, 200); 
        } catch(Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
            die();
        }
    }

    public static function deletar($request, $response, $args){
        $id = $args['id'];
        $nivel = NivelModel::find($id);

        if( $nivel ) {
            try {
                $nivel->delete();    
            } catch(\Illuminate\Database\QueryException $e) {
                return $response->withJson([
                    "resposta" => false,
                    "msg" => $e->getMessage()
                ], 403); 
            }
        } else {
            $nivel = new \stdClass();
            
            $nivel->resposta = false;
            $nivel->msg = "Nível não encontrado.";
        }        

        return $response->withJson($nivel, 200); 
    }
}

?>