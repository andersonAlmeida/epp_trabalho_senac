<?php
    namespace Models;

    include_once __DIR__ . '/../classes/Atracao.php';

    use Slim\App;
    use Illuminate\Database\Eloquent\Model;

    class AtracaoModel extends Model
    {
        protected $table = 'atracao';
        public $timestamps = false;

        public function inserir(Atracao $atracao)
        {
            $db = App::getContainer()->get('db');
            $resultado = $db->table( $this->table )->save();        
            return true;
        }

        public function deletar($id)
        {
            
        }

        public function atualizar(Atracao $atracao)
        {
                 
        }

        public function listar($app)
        {
            $db = $app->getContainer()->get('db');
            $db::all();

            print($db);
        }

        public function buscarPorId($id)
        {
 		            
        }
    }
?>