<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class ProdutoModel extends Model
    {
        protected $table = 'produto';
        protected $fillable = ['preco', 'nome', 'descricao', 'desconto', 'estoque', 'id_marca', 'id_categoria', 'ativo'];
        public $timestamps = false;

        // public function cliente() {
        //     return $this->belongsTo('Models\ClienteModel', 'cod_cliente');
        // }
    }
?>