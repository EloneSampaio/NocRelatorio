<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrarModel
 *
 * @author sam
 */

/**
 * @Entity
 * @Table(name="usuarios")
 * 
 */
class usuario extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id_usuario")
     */
    protected $id;

    /**
     * @Column(type="string", name="nome")
     */
    protected $nome;

    /**
     * @Column(type="string", name="login")
     * 
     */
    protected $login;

    /**
     * @Column(type="string", name="senha")
     */
    protected $senha;

    /**
     * @Column(type="string", name="nivel")
     * 
     */
    protected $nivel;

    /**
     * @Column(type="string", name="status")
     */
    protected $status;

/*
 * Metodo __set metodo magico do php
 */
    public function __set($nome, $valor) {
        return $this->$nome = $valor;
    }

    /*
     * Metodo __get metodo magico do php
     * ver documentação
     */
    public function __get($nome) {
        return $this->$nome;
    }

    /*
     * Metodos da minha Classe
     */

    /*
     * Metodo Insert
     * Responsavel pela inserção dos dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    public function Insert($objecto) {
        require $this->db;
        $entityManager->persist($objecto);
        $entityManager->flush();
    }

    /*
     * Metodo listarAll
     * Responsavel pela listagem de todos os  dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listaAll() {
        require $this->db;
        return $entityManager->getRepository('usuario')->findAll();
    }

    /*
     * Metodo listarNome
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarNome() {
        require $this->db;
        return $entityManager->getRepository('usuario')->findOneBy(array('nome' => 'sam'));
    }

    /*
     * Metodo listarId
     * Responsavel pela listagem de todos os  dados onde o id é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarId($usuario) {
        require $this->db;
        return $entityManager->getRepository('usuario')->findOneBy(array('id' => $usuario->id));
    }

    /*
     * Metodo Update
     * Responsavel pela alteração de todos os  dados no banco onde os valores a serem alterados são passados por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Update($dados) {
        require $this->db;
        $updat = $entityManager->find('usuario', $dados->id);
        $updat->nome = $dados->nome;
        $updat->login = $dados->login;
        $updat->nivel = $dados->nivel;
        if (isset($dados->senha)) {
            $updat->senha = Hash::getHash('md5', $dados->senha, HASH_KEY);
        }
        $entityManager->persist($updat);
        $entityManager->flush();
    }

    /*
     * Metodo Delete
     * Responsavel pela remoção de dados no banco onde o id é passado por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Delete($id) {
        require $this->db;
        $excluir = $entityManager->find('usuario', $id->id);
        $entityManager->remove($excluir);
        $entityManager->flush();
    }

    /*
     * Metodo Autenticar
     * Responsavel pela autenticação do usuario na aplicação
     * @objecto->contem o login e senha do usuario
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Autenticar($objecto) {
        require $this->db;
        return $entityManager->getRepository('usuario')->findOneBy(array('login' => $objecto->login, 'senha' => $objecto->senha));
    }

}
