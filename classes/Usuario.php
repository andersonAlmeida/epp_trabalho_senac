<?php
    class Usuario {       
        public $nome;
        public $email;
        public $senha;

        function __construct($nome, $email, $senha){
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }
    }
?>