<?php

namespace controllers;

use application\Controller;
use application\Session;

/**
 * Description of registrarController
 *
 * @author sam
 */
class Identificacao_turnos extends Controller {

    private $turno;

    public function __construct() {
        $this->turno = $this->LoadModelo('IdentificacaoTurnos');
        parent::__construct();
    }

    public function index($pagina = FALSE) {


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

        $this->view->titulo = "Turnos";
        $this->view->turno = $paginador->paginar($this->turno->listaAll(), $pagina, 5);
        $this->view->paginacao = $paginador->getView('paginacao', 'alarmencc/index');
        if ($this->getInt('enviar') == 1) {
            $this->view->dados = $_POST;


            if (!$this->getSqlverifica('turno')) {
                $this->view->erro = "Porfavor Introduza o primeiro nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('inicio')) {
                $this->view->erro = "Porfavor Introduza o segundo nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('fim')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('obs')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }
            $this->turno->setTurno($this->getSqlverifica('turno'));
            $this->turno->setInicio($this->getSqlverifica('inicio'));
            $this->turno->setFim($this->getSqlverifica('fim'));
            $this->turno->setObs($this->getSqlverifica('obs'));
            $this->turno->setData(date("Y-m-d"));
            $this->turno->setIdUsuario(Session::get('id'));

            if (!$this->turno->Insert($this->turno)) {
                $this->view->erro = "erro ao criar alarme";
                $this->view->renderizar("novo");
                exit;
            }

            $this->view->dados = FALSE;
            $this->view->mensagem = "A sua conta foi criada com Sucesso";
        }
        $this->view->renderizar("index");
    }

    function novo() {

        $this->view->setJs(array("novo"));
        $this->view->setCss(array("style"));
        $this->view->footer = $this->getFooter('footer', 'index');
        $this->view->renderizar('novo');
    }

    public function editar($id) {
        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("identificacao_turnos");
        }
        $this->view->dados = $this->turno->listarId($this->filtraInt($id));


        $this->view->titulo = "Editar Alarme";
        $this->view->setJs(array("novo"));

        if ($this->getInt('enviar') == 1) {
            $this->view->dados = $_POST;


            if (!$this->getSqlverifica('status')) {
                $this->view->erro = "Porfavor Introduza o primeiro nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('amp')) {
                $this->view->erro = "Porfavor Introduza o segundo nome do cliente ";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('power')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('tube_temp')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('obs')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }
            $this->coyonet->setStatus($this->getSqlverifica('status'));
            $this->coyonet->setAmp($this->getSqlverifica('amp'));
            $this->coyonet->setPower($this->getSqlverifica('power'));
            $this->coyonet->setTubetemp($this->getSqlverifica('tube_temp'));
            $this->coyonet->setObs($this->getSqlverifica('obs'));

            $id = $this->view->dados->getId();
            if ($this->coyonet->Update($this->coyonet, $id)) {
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
            $this->redirecionar("identificacao_turnos");
        }
        if (!$this->turno->listarId($this->filtraInt($id))) {
            $this->redirecionar("identificacao_turnos");
        }
        $this->turno->Delete($id);
        $this->redirecionar("identificacao_turnos");
    }

}
