<?php

namespace controllers;

use application\Controller;
use application\Session;

/**
 * Description of registrarController
 *
 * @author sam
 */
class Alarmencc extends Controller {

    //put your code here

    private $alarme;

    public function __construct() {
        $this->alarme = $this->LoadModelo('AlarmesNcc');
        parent::__construct();
    }

    public function index($pagina = FALSE) {

        /*
         * @var
         */
        //$this->view->setJs(array("novo"));
        if (!$this->filtraInt($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }

        if (!Session::get('autenticado')) {
            $this->redirecionar();
        }
        $paginador = new \vendor\paginador\Paginador();

        $this->view->titulo = "Alarmes";
        $this->view->alarmes = $paginador->paginar($this->alarme->listaAll(), $pagina, 5);
        $this->view->paginacao = $paginador->getView('paginacao', 'alarmencc/index');


        if ($this->getInt('enviar') == 1) {
            $this->view->dados = $_POST;


            if (!$this->getSqlverifica('criated')) {
                $this->view->erro = "Porfavor Introduza o primeiro nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('severity')) {
                $this->view->erro = "Porfavor Introduza o segundo nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('device_service')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('details')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }


            $this->alarme->setCriated($this->getSqlverifica('criated'));
            $this->alarme->setSeverity($this->getSqlverifica('severity'));
            $this->alarme->setDeviceService($this->getSqlverifica('device_service'));
            $this->alarme->setDetails($this->getSqlverifica('details'));
            $this->alarme->setData(date("Y-m-d"));
            $this->alarme->setIdusario(Session::get('id'));
            if ($this->alarme->Insert($this->alarme)) {
                $this->view->erro = "erro ao criar alarme";
                $this->view->renderizar("novo");
                exit;
            }

            $this->view->dados = FALSE;
            $this->view->mensagem = "A sua conta foi criada com Sucesso";
        }
        $this->view->renderizar("index"
        );
    }

    function novo() {

        $this->view->setJs(array("novo"));
        $this->view->setCss(array("style"));
        $this->view->footer = $this->getFooter('footer', 'index');
        $this->view->renderizar('novo'
        );
    }

    public function editar($id) {
        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("alarmencc");
        }
        $this->view->dados = $this->alarme->listarId($this->filtraInt($id));


        $this->view->titulo = "Editar Alarme";
        $this->view->setJs(array("novo"));

        if ($this->getInt('enviar') == 1) {



            if (!$this->getSqlverifica('criated')) {
                $this->view->erro = "Porfavor Introduza o primeiro nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('severity')) {
                $this->view->erro = "Porfavor Introduza o segundo nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('device_service')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('details')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            $this->alarme->setSeverity($this->getSqlverifica('severity'));
            $this->alarme->setDeviceService($this->getSqlverifica('device_service'));
            $this->alarme->setDetails($this->getSqlverifica('details'));
            $this->alarme->setCriated($this->getSqlverifica('criated'));

            $id = $this->view->dados->getId();
            if ($this->alarme->Update($this->alarme, $id)) {
                $this->view->erro = "Erro ao alterar dados ";
                $this->view->renderizar("editar");
                exit;
            }
            $this->view->mensagem = "Alteração feita com sucesso";
        }

        $this->view->renderizar("editar");
    }

    public function apagar($id) {

        Session::nivelRestrito(array("admin"));

        if (!$this->filtraInt($id)) {
            $this->redirecionar("alarmencc");
        }
        if (!$this->alarme->listarId($this->filtraInt($id))) {
            $this->redirecionar("alarmencc");
        }
        $this->alarme->Delete($id);
        $this->redirecionar("alarmencc");
    }

}
