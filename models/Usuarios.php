<?php

namespace models;

use application\Hash;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=40, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=100, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=20, nullable=false)
     */
    private $nivel;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false)
     */
    private $status;

    /*
     * Metodo __set metodo magico do php
     */

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function setStatus($status) {
        $this->status = $status;
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
        require ROOT . "config/bootstrap.php";
        $entityManager->persist($objecto);
        $entityManager->flush();
    }

    /*
     * Metodo listarAll
     * Responsavel pela listagem de todos os  dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listaAll() {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\Usuarios')->findby(array(), array("id" => "DESC"));
        $entityManager->flush();
    }

    /*
     * Metodo listarNome
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarNome($nome) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\Usuarios')->findOneBy(array('nome' => $nome));
        $entityManager->flush();
    }

    /*
     * Metodo listarLogin
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarLogin($login) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\Usuarios')->find($login);
        $entityManager->flush();
    }

    /*
     * Metodo listarId
     * Responsavel pela listagem de todos os  dados onde o id é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarId($id) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\Usuarios')->findOneBy(array('id' => $id));
        $entityManager->flush();
    }

    /*
     * Metodo Update
     * Responsavel pela alteração de todos os  dados no banco onde os valores a serem alterados são passados por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Update($dados) {

        require ROOT . "config/bootstrap.php";
        $updat = $entityManager->find('models\Usuarios', $dados->getId());
        $updat->setNome($dados->getNome());
        $updat->setLogin($dados->getLogin());
        $updat->setNivel($dados->getNivel());
        if (!empty($dados->getSenha())) {
            $updat->setSenha(Hash::getHash('md5', $dados->getSenha(), HASH_KEY));
        }
        $entityManager->flush();
    }

    /*
     * Metodo Delete
     * Responsavel pela remoção de dados no banco onde o id é passado por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Delete($id) {
        require ROOT . "config/bootstrap.php";
        $excluir = $entityManager->getPartialReference('models\Usuarios', $id);
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

        //require $this->db;
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\Usuarios')->findOneBy(array('login' => $objecto->getLogin(), 'senha' => $objecto->getSenha()));
        $entityManager->flush();
    }

}
