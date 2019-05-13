<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class AvaliacaoModel extends Model
    {
        protected $table = 'avaliacao';
        protected $fillable = ['nota', 'comentario', 'cod_atracao', 'cod_cliente'];
        public $timestamps = false;
        protected $primaryKey = 'cod_avaliacao';

        public function fotos() {
            return $this->morphMany('Models\FotoModel', 'fotoable');
        }

        public function atracao() {
            return $this->belongsTo('Models\AtracaoModel', 'cod_atracao');
        }
        
        public function cliente() {
            return $this->belongsTo('Models\ClienteModel', 'cod_cliente')->select(['cod_cliente', 'nome', 'cod_nivel']);
        }
    }
?>