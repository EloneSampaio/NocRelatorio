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
class servicos_logsModel extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function registrar($data) {
        $this->db->Inserir("servicos_logs", array(
            'servicos' => $data['servicos'],
            'inicio' => $data['inicio'],
            'fim' => $data['fim'],
            'data' => date("Y-m-d"),
            'id_usuario' => Session::get('id_usuario'),
            'intervencao_causa' => $data['intervencao_causa'],
            'status' => $data['status'],
            'obs' => $data['obs'],
            
        ));
    }

    public function verifcar_tel($tel) {

        $tel = implode(",", $tel);
        $em = $this->db->prepare("SELECT telefone FROM  servicos_logs WHERE telefone IN (" . $tel . ")");
        $em->execute();
        return $em->fetch();
    }

    public function verificar_id($id) {
        $em = $this->db->prepare("SELECT * FROM  servicos_logs WHERE id=:id");

        $em->execute(array(
            ':id' => $id,
        ));
        return $em->fetch();
    }

    public function verificar_codigo($codigo) {

        $em = $this->db->prepare("SELECT * FROM  servicos_logs WHERE codigo=:codigo");

        $em->execute(array(
            ':codigo' => $codigo,
        ));
        return $em->fetch();
    }

    public function verificar_nome() {
        return $this->db->Selecionar('SELECT nome,telefone FROM  servicos_logs');
    }

//fim

    public function listarAll() {
        return $this->db->Selecionar('SELECT * FROM  servicos_logs ORDER BY id DESC');
    }

    public function listarContactos() {
        return $this->db->Selecionar('SELECT telefone FROM  servicos_logs');
    }

    public function listarUltimos() {
        return $this->db->Selecionar('SELECT * FROM   servicos_logs ORDER BY  id DESC LIMIT 3');
    }

    public function apagar_cliente($id) {
        $this->db->apagar(' servicos_logs', "id = '$id'");
    }

    public function editar_cliente($data, $id) {

        $data = array(
            'nome' => $data['nome'],
            'telefone' => $data['telefone'],
            'morada' => $data['morada'],
            'total' => $data['total'],
            'descricao' => $data['descricao']
        );
        $this->db->Actualizar(' servicos_logs', $data, "id={$id}");
    }

}
