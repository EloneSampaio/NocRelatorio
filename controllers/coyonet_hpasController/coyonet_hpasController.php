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

    //put your code here
    private $pagamentos;
    private $clientes;

    public function __construct() {
        parent::__construct();
        $this->pagamentos = $this->LoadModelo("coyonet_hpas");
    }

    public function index($pagina = FALSE) {
        if (!$this->filtraInt($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }

        if (!Session::get('autenticado')) {
            $this->redirecionar();
        }
        $this->view->setJs(array("novo"));

        $this->getBibliotecas('paginador');
        $paginador = new Paginador();

        $this->view->titulo = "Pagamentos Efectuados";
        $this->view->pagamentos = $paginador->paginar($this->pagamentos->listarAll(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'pagamento/index');

        if ($this->getInt('enviar') == 1) {
            $this->view->dados = $_POST;


            if (!$this->getInt('codigo')) {
                $this->view->erro = "Porfavor Introduza um codigo valido ";
                $this->view->renderizar("novo");
                exit;
            }
        }

        $this->view->renderizar("index");
    }

    function novo() {
        $this->view->setJs(array("novo"));
        $this->view->setCss(array("style"));
        $this->view->footer = $this->getFooter('footer', 'index');
        $this->view->renderizar('novo');
    }

}
