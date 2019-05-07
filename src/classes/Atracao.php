<?php
    class Atracao {        
        public $nome;
        public $descricao;
        public $inicio;
        public $fim;
        public $categoria;
        public $endereco;
        public $lat;
        public $lng;
        
        function __construct($nome, $descricao, $inicio, $fim, $categoria, $endereco, $lat, $lng){
            // $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->inicio = $inicio;
            $this->fim = $fim;
            $this->categoria = $categoria;
            $this->endereco = $endereco;
            $this->lat = $lat;
            $this->lng = $lng;
        }
    }