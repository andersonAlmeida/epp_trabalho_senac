<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class NivelModel extends Model
    {
        protected $table = 'nivel';
        protected $fillable = ['nome'];
        public $timestamps = false;
        protected $primaryKey = 'cod_nivel';

        public function usuario() {
            return $this->hasMany('Models\ClienteModel', 'cod_cliente');
        }
    }
?>