<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class AtracaoCategoriaModel extends Model
    {
        protected $table = 'atracao_categoria';
        protected $fillable = ['nome'];
        public $timestamps = false;
        protected $primaryKey = 'cod_atracao_categoria';

        public function atracao() {
            return $this->hasMany('Models\AtracaoModel', 'cod_atracao');
        }
    }
?>