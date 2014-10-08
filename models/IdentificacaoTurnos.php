<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * IdentificacaoTurnos
 *
 * @ORM\Table(name="identificacao_turnos")
 * @ORM\Entity
 */
class IdentificacaoTurnos {
    /* @var $entityManager \Doctrine\ORM\EntityManager */

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
     * @ORM\Column(name="data", type="string", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="turno", type="string", length=20, nullable=false)
     */
    private $turno;

    /**
     * @var string
     *
     * @ORM\Column(name="inicio", type="string", nullable=false)
     */
    private $inicio;

    /**
     * @var string
     *
     * @ORM\Column(name="fim", type="string", nullable=false)
     */
    private $fim;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=false)
     */
    private $obs;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     */
    private $idUsuario;

    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function getFim() {
        return $this->fim;
    }

    public function getObs() {
        return $this->obs;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function setFim($fim) {
        $this->fim = $fim;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    /*
     * Metodo Insert
     * Responsavel pela inserção dos dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    public function Insert($objecto) {
        require ROOT . "config/bootstrap.php";
        $entityManager->persist($objecto);
        $entityManager->flush();
        return TRUE;
    }

    /*
     * Metodo listarAll
     * Responsavel pela listagem de todos os  dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listaAll() {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\IdentificacaoTurnos')->findby(array(), array("id" => "DESC"));
        $entityManager->flush();
    }

    /*
     * Metodo listarNome
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarNome($nome) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\IdentificacaoTurnos')->findOneBy(array('nome' => $nome));
        $entityManager->flush();
    }

    /*
     * Metodo listarLogin
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */



    /*
     * Metodo listarId
     * Responsavel pela listagem de todos os  dados onde o id é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarId($id) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\IdentificacaoTurnos')->findOneBy(array('id' => $id));
        $entityManager->flush();
    }

    /*
     * Metodo Update
     * Responsavel pela alteração de todos os  dados no banco onde os valores a serem alterados são passados por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Update($dados, $id) {

        require ROOT . "config/bootstrap.php";
        $updat = $entityManager->find('models\IdentificacaoTurnos', $id);
        $updat->setStatus($dados->getStatus());
        $updat->setAmp($dados->getAmp());
        $updat->setPower($dados->getPower());
        $updat->setTubetemp($dados->getTubetemp());
        $updat->setObs($dados->getObs());
        $entityManager->flush();
    }

    /*
     * Metodo Delete
     * Responsavel pela remoção de dados no banco onde o id é passado por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Delete($id) {
        require ROOT . "config/bootstrap.php";
        $excluir = $entityManager->find('models\IdentificacaoTurnos', $id);
        $entityManager->remove($excluir);
        $entityManager->flush();
    }

}
