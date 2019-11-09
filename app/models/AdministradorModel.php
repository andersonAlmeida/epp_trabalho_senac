<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class AdministradorModel extends Model
    {
        protected $table = 'administrador';
        protected $fillable = ['nome', 'email', 'senha'];
        public $timestamps = false;
        protected $primaryKey = 'cod_admin';
    }
?>