<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class CupomModel extends Model
    {
        protected $table = 'cupom';
        protected $fillable = ['descricao', 'data_criacao', 'data_expiracao', 'cod_cliente'];
        public $timestamps = false;
        protected $primaryKey = 'cod_cupom';

        public function cliente() {
            return $this->belongsTo('Models\ClienteModel', 'cod_cliente');
        }
    }
?>