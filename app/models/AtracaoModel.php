<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class AtracaoModel extends Model
    {
        protected $table = 'atracao';
        // protected $fillable = [];
        public $timestamps = false;
        protected $primaryKey = 'cod_atracao';

        public function categoria() {
            return $this->belongsTo('Models\AtracaoCategoriaModel', 'cod_atracao_categoria');
        }
    }
?>