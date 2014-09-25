<?php

/**
 * Description of categoriaModel
 *
 * @author sam
 */
class Identificacao_turnosModel extends Model {

     //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function registrar($data) {
        $this->db->Inserir("identificacao_turnos", array(
            'turno' => $data['turno'],
            'inicio' => $data['inicio'],
            'fim' => $data['fim'],
            'data' => date("Y-m-d"),
            'id_usuario' => Session::get('id_usuario'),
            'obs' => $data['obs'],
        ));
    }

    public function verifcar_tel($tel) {

        $tel = implode(",", $tel);
        $em = $this->db->prepare("SELECT telefone FROM identificacao_turnos WHERE telefone IN (" . $tel . ")");
        $em->execute();
        return $em->fetch();
    }

    public function verificar_id($id) {
        $em = $this->db->prepare("SELECT * FROM identificacao_turnos WHERE id=:id");

        $em->execute(array(
            ':id' => $id,
        ));
        return $em->fetch();
    }

    public function verificar_codigo($codigo) {

        $em = $this->db->prepare("SELECT * FROM identificacao_turnos WHERE codigo=:codigo");

        $em->execute(array(
            ':codigo' => $codigo,
        ));
        return $em->fetch();
    }

    public function verificar_nome() {
        return $this->db->Selecionar('SELECT nome,telefone FROM identificacao_turnos');
    }

//fim

    public function listarAll() {
        return $this->db->Selecionar('SELECT * FROM identificacao_turnos ORDER BY id DESC');
    }

    public function listarContactos() {
        return $this->db->Selecionar('SELECT telefone FROM identificacao_turnos');
    }

    public function listarUltimos() {
        return $this->db->Selecionar('SELECT * FROM  identificacao_turnos ORDER BY  id DESC LIMIT 3');
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
