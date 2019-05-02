<?php

include_once './classes/Usuario.php';
include_once './config/PDOFactory.php';


class UsuarioController
{
    public function listar($request, $response, $args)
    {
        $dao = new UsuarioDAO;
        $usuarios =  $dao->listar();

        return $response->withJson($usuarios);
    }

    public function buscarPorId($request, $response, $args)
    {
        $id = $args['id'];

        $dao = new UsuarioDAO;
        $usuario = $dao->buscarPorId($id);

        return $response->withJson($usuario);
    }

    public function inserir($request, $response, $args)
    {
        $p = $request->getParsedBody();
        $usuario = new Usuario($p['nome'], $p['email'], $p['senha']);

        $dao = new UsuarioDAO;
        $usuario = $dao->inserir($usuario);

        return $response->withJson($usuario, 201);
    }

    public function atualizar($request, $response, $args)
    {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $produto = new Produto($id, $p['nome'], $p['preco']);

        $dao = new UsuarioDAO;
        $produto = $dao->atualizar($produto);

        return $response->withJson($produto);
    }

    public function deletar($request, $response, $args)
    {
        $id = $args['id'];

        $dao = new UsuarioDAO;
        $produto = $dao->deletar($id);

        return $response->withJson($produto);
    }
}
