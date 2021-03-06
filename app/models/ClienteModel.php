<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class ClienteModel extends Model
    {
        protected $table = 'cliente';
        protected $fillable = ['nome', 'email', 'senha', 'cod_nivel'];
        public $timestamps = false;
        protected $primaryKey = 'cod_cliente';

        public function nivel() {
            return $this->belongsTo('Models\NivelModel', 'cod_nivel');
        }
        
        public function avaliacoes() {
            return $this->hasMany('Models\AvaliacaoModel', 'cod_avaliacao');
        }

        public function cupons() {
            return $this->hasMany('Models\CupomModel', 'cod_cupom');
        }
        
    }
?>