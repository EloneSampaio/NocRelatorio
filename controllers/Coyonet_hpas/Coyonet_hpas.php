<?php

namespace controllers;

use application\Controller;
use application\Session;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoriaController
 *
 * @author sam
 */
class Coyonet_hpas extends Controller {

    private $coyonet;

    public function __construct() {
        $this->coyonet = $this->LoadModelo('CoyonetHpas');
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

        $this->view->titulo = "Coyonete ";
        $this->view->coyonet = $paginador->paginar($this->coyonet->listaAll(), $pagina, 5);
        $this->view->paginacao = $paginador->getView('paginacao', 'alarmencc/index');


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
            $this->coyonet->setData(date("Y-m-d"));
            $this->coyonet->setIdUsuario(Session::get('id'));

            if (!$this->coyonet->Insert($this->coyonet)) {
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
        $this->view->renderizar('novo'
        );
    }

    public function editar($id) {
        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("coyonet_hpas");
        }
        $this->view->dados = $this->coyonet->listarId($this->filtraInt($id));


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
            $this->redirecionar("coyonet_hpas");
        }
        if (!$this->coyonet->listarId($this->filtraInt($id))) {
            $this->redirecionar("coyonet_hpas");
        }
        $this->coyonet->Delete($id);
        $this->redirecionar("coyonet_hpas");
    }

}
