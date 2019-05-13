<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class AtracaoModel extends Model
    {
        protected $table = 'atracao';
        protected $fillable = ['nome', 'descricao', 'data_inicio', 'data_fim', 'endereco', 'lat', 'lng', 'cod_atracao_categoria'];
        public $timestamps = false;
        protected $primaryKey = 'cod_atracao';

        public function categoria() {
            return $this->belongsTo('Models\AtracaoCategoriaModel', 'cod_atracao_categoria');
        }

        public function avaliacoes() {
            return $this->hasMany('Models\AvaliacaoModel', 'cod_avaliacao');
        }

        public function fotos() {
            return $this->morphMany('Models\FotoModel', 'fotoable');
        }
    }
?>