<?php
    include_once './classes/Usuario.php';
	include_once './config/PDOFactory.php';

    class UsuarioDAO
    {
        public function inserir(Usuario $usuario)
        {
            $qInserir = "INSERT INTO produto(nome,preco) VALUES (:nome,:email,:senha)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":preco",$usuario->email);
            $comando->bindParam(":preco",$usuario->senha);
            $comando->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from produto WHERE id=:id";            
            $produto = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $produto;
        }

        public function atualizar(Usuario $usuario)
        {
            $qAtualizar = "UPDATE produto SET nome=:nome, preco=:preco WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$produto->nome);
            $comando->bindParam(":preco",$produto->preco);
            $comando->bindParam(":id",$produto->id);
            $comando->execute();
            return $produto;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM produto';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $produtos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $produtos[] = new Produto($row->id,$row->nome,$row->preco);
            }
            return $produtos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM produto WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Produto($result->id,$result->nome,$result->preco);           
        }
    }
