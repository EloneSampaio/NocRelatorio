<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoyonetHpas
 *
 * @ORM\Table(name="coyonet_hpas")
 * @ORM\Entity
 */
class CoyonetHpas {
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
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="amp", type="string", length=15, nullable=false)
     */
    private $amp;

    /**
     * @var string
     *
     * @ORM\Column(name="power", type="string", length=15, nullable=false)
     */
    private $power;

    /**
     * @var string
     *
     * @ORM\Column(name="tube_temp", type="string", length=15, nullable=false)
     */
    private $tubeTemp;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=true)
     */
    private $obs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_usuario", type="boolean", nullable=false)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=15, nullable=false)
     */
    private $data;

    public function getId() {
        return $this->id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getAmp() {
        return $this->amp;
    }

    public function getPower() {
        return $this->power;
    }

    public function getTubeTemp() {
        return $this->tubeTemp;
    }

    public function getObs() {
        return $this->obs;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getData() {
        return $this->data;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setAmp($amp) {
        $this->amp = $amp;
    }

    public function setPower($power) {
        $this->power = $power;
    }

    public function setTubeTemp($tubeTemp) {
        $this->tubeTemp = $tubeTemp;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setData($data) {
        $this->data = $data;
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
        return $entityManager->getRepository('models\CoyonetHpas')->findby(array(), array("id" => "DESC"));
        $entityManager->flush();
    }

    /*
     * Metodo listarNome
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarNome($nome) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\CoyonetHpas')->findOneBy(array('nome' => $nome));
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
        return $entityManager->getRepository('models\CoyonetHpas')->findOneBy(array('id' => $id));
        $entityManager->flush();
    }

    /*
     * Metodo Update
     * Responsavel pela alteração de todos os  dados no banco onde os valores a serem alterados são passados por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Update($dados, $id) {

        require ROOT . "config/bootstrap.php";
        $updat = $entityManager->find('models\CoyonetHpas', $id);
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
        $excluir = $entityManager->find('models\CoyonetHpas', $id);
        $entityManager->remove($excluir);
        $entityManager->flush();
    }

}
