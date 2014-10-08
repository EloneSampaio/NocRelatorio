<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlarmesNcc
 *
 * @ORM\Table(name="alarmes_ncc")
 * @ORM\Entity
 */
class AlarmesNcc {

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
     * @ORM\Column(name="criated", type="string", length=30, nullable=true)
     */
    private $criated;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuario", type="integer", nullable=false)
     */
    private $idusario;

    /**
     * @var string
     *
     * @ORM\Column(name="severity", type="string", length=30, nullable=true)
     */
    private $severity;

    /**
     * @var string
     *
     * @ORM\Column(name="device_service", type="string", length=30, nullable=true)
     */
    private $deviceService;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=30, nullable=true)
     */
    private $details;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", nullable=false)
     */
    private $data;

    public function getId() {
        return $this->id;
    }

    public function getCriated() {
        return $this->criated;
    }

    public function getSeverity() {
        return $this->severity;
    }

    public function getDeviceService() {
        return $this->deviceService;
    }

    public function getDetails() {
        return $this->details;
    }

    public function getData() {
        return $this->data;
    }

    public function setCriated($criated) {
        $this->criated = $criated;
    }

    public function setSeverity($severity) {
        $this->severity = $severity;
    }

    public function setDeviceService($deviceService) {
        $this->deviceService = $deviceService;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getIdusario() {
        return $this->idusario;
    }

    public function setIdusario($idusario) {
        $this->idusario = $idusario;
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
    }

    /*
     * Metodo listarAll
     * Responsavel pela listagem de todos os  dados
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listaAll() {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\AlarmesNcc')->findby(array(), array("id" => "DESC"));
        $entityManager->flush();
    }

    /*
     * Metodo listarNome
     * Responsavel pela listagem de todos os  dados onde o nome é igual ao que é passado pelo paramentro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function listarNome($nome) {
        require ROOT . "config/bootstrap.php";
        return $entityManager->getRepository('models\AlarmesNcc')->findOneBy(array('nome' => $nome));
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
        return $entityManager->getRepository('models\AlarmesNcc')->findOneBy(array('id' => $id));
        $entityManager->flush();
    }

    /*
     * Metodo Update
     * Responsavel pela alteração de todos os  dados no banco onde os valores a serem alterados são passados por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Update($dados,$id) {

        require ROOT . "config/bootstrap.php";
        $updat = $entityManager->find('models\AlarmesNcc', $id);
        $updat->setCriated($dados->getCriated());
        $updat->setSeverity($dados->getSeverity());
        $updat->setDeviceService($dados->getDeviceService());
        $updat->setDetails($dados->getDetails());
        $updat->setData($dados->getData());
        $entityManager->flush();
    }

    /*
     * Metodo Delete
     * Responsavel pela remoção de dados no banco onde o id é passado por parametro
     * @db->variavel que contem o meu arquivo bootstrap do doctrine
     */

    function Delete($id) {
        require ROOT . "config/bootstrap.php";
        $excluir = $entityManager->find('models\AlarmesNcc', $id);
        $entityManager->remove($excluir);
        $entityManager->flush();
    }

}
