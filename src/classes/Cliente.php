<?php
    class Cliente extends Usuario{
        public $nivel;
        public $pontuacao;
        
        function __construct($id, $nome, $email, $senha, $pontuacao, $nivel){
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->pontuacao = $pontuacao;
            $this->nivel = $nivel;
        }
    }