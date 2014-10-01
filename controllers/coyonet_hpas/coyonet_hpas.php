<?php

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
class Coyonet_hpasController extends Controller {

    private $coyonet;

    public function __construct() {
        $this->coyonet = $this->LoadModelo('coyonet_hpas');
        parent::__construct();
    }

    public function index($pagina = FALSE) {

        /*
         * @var
         */
        $this->view->setJs(array("novo"));
        if (!$this->filtraInt($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }

        if (!Session::get('autenticado')) {
            $this->redirecionar();
        }


        $this->getBibliotecas('paginador', 'paginador');
        $paginador = new Paginador();

        $this->view->titulo = "Clientes Cadastrado";
        $this->view->clientes = $paginador->paginar($this->coyonet->listarAll(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'coyonet_hpas/index');


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



            $data = array();
            $data['status'] = $this->getSqlverifica('status');
            $data['amp'] = $this->getSqlverifica('amp');
            $data['power'] = $this->getSqlverifica('power');
            $data['tube_temp'] = $this->getSqlverifica('tube_temp');
            $data['obs'] = $this->getSqlverifica('obs');
            if ($this->coyonet->registrar($data)) {
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
            $this->redirecionar("cliente");
        }

        if (!$this->coyonet->listar_id($this->filtraInt($id))) {
            $this->redirecionar("cliente");
        }


        $this->view->titulo = "Editar Cliente";
        $this->view->setJs(array("novo"));

        if ($this->getInt('envia') == 1) {


            if (!$this->getSqlverifica('nome')) {
                $this->view->erro = "Porfavor Introduza um nome do cliente valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getSqlverifica('morada')) {
                $this->view->erro = "POrfavor Introduza um endereço ou morada  valido";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getInt('total')) {
                $this->view->erro = "POrfavor Introduza um valor  valido";
                $this->view->renderizar("novo");
                exit;
            }


            if (!$this->getSqlverifica('descricao')) {
                $this->view->erro = "Porfavor Introduza uma descrição valida";
                $this->view->renderizar("novo");
                exit;
            }

            $data = array();
            $data['telefone'] = $this->getInt('telefone');
            $data['morada'] = $this->getSqlverifica('morada');
            $data['nome'] = $this->getSqlverifica('nome');
            $data['descricao'] = $this->getSqlverifica('descricao');
            $data['total'] = $this->getInt('total');

            $this->coyonet->editar_cliente($data, $this->filtraInt($id));
            $this->view->dados = $this->view->mensagem = "Alterado com Sucesso";
        }

        $this->view->dados = $this->coyonet->listar_id($this->filtraInt($id));
        $this->view->renderizar(
                "editar");
    }

    public function apagar($id) {

        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("cliente");
        }

        if (!$this->coyonet->listar_id($this->filtraInt($id))) {
            $this->redirecionar("cliente");
        }
        $this->coyonet->apagar_cliente($this->filtraInt($id));
        $this->redirecionar("cliente");
    }

    public function listar($codigo) {
        if ($this->filtraInt($codigo)) {
            $this->view->dados = $this->coyonet->verificar_id($this->filtraInt($codigo));
            $this->view->renderizar("listar");
        } else {
            $this->view->renderizar('novo');
        }
    }
    
}
    