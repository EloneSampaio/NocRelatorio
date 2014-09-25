<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoriaModel
 *
 * @author sam
 */
class coyonet_hpasModel extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function registrar($data) {
        $this->db->Inserir("coyonet_hpas", array(
            'status' => $data['status'],
            'amp' => $data['amp'],
            'power' => $data['power'],
            'data' => date("Y-m-d"),
            'id_usuario' => Session::get('id_usuario'),
            'tube_temp' => $data['tube_temp'],
            'obs' => $data['obs']
        ));
    }

    public function verifcar_tel($tel) {

        $tel = implode(",", $tel);
        $em = $this->db->prepare("SELECT telefone FROM coyonet_hpas WHERE telefone IN (" . $tel . ")");
        $em->execute();
        return $em->fetch();
    }

    public function verificar_id($id) {
        $em = $this->db->prepare("SELECT * FROM coyonet_hpas WHERE id=:id");

        $em->execute(array(
            ':id' => $id,
        ));
        return $em->fetch();
    }

    public function verificar_codigo($codigo) {

        $em = $this->db->prepare("SELECT * FROM coyonet_hpas WHERE codigo=:codigo");

        $em->execute(array(
            ':codigo' => $codigo,
        ));
        return $em->fetch();
    }

    public function verificar_nome() {
        return $this->db->Selecionar('SELECT nome,telefone FROM coyonet_hpas');
    }

//fim

    public function listarAll() {
        return $this->db->Selecionar('SELECT * FROM coyonet_hpas ORDER BY id DESC');
    }

    public function listarContactos() {
        return $this->db->Selecionar('SELECT telefone FROM coyonet_hpas');
    }

    public function listarUltimos() {
        return $this->db->Selecionar('SELECT * FROM  coyonet_hpas ORDER BY  id DESC LIMIT 3');
    }

    public function apagar_cliente($id) {
        $this->db->apagar('clientes', "id = '$id'");
    }

    public function editar_cliente($data, $id) {

        $data = array(
            'nome' => $data['nome'],
            'telefone' => $data['telefone'],
            'morada' => $data['morada'],
            'total' => $data['total'],
            'descricao' => $data['descricao']
        );
        $this->db->Actualizar('clientes', $data, "id={$id}");
    }

}
