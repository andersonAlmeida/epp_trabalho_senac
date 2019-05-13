<?php
    namespace Models;
    use \Illuminate\Database\Eloquent\Model;

    class FotoModel extends Model
    {
        protected $table = 'foto';
        protected $fillable = ['imagem', 'fotoable_id', 'fotoable_type'];
        public $timestamps = false;
        protected $primaryKey = 'cod_foto';

        public function fotoable() {
            return $this->morphTo();
        }
    }
?>