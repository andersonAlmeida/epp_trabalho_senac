<?php
    class Usuario {
        public $id;
        public $nome;
        public $email;
        public $senha;
        
        function __construct($id, $nome, $email, $senha){
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }
    }