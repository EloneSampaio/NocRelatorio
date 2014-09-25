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

/**
 * @Entity
 * @Table(name="usuarios")
 * 
 */
class usuario{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id_usuario")
     */
    protected $id;

    /**
     * @Column(type="string", name="nome")
     */
    protected $nome;

    /**
     * @Column(type="string", name="login")
     * 
     */
    protected $login;

    /**
     * @Column(type="string", name="senha")
     */
    protected $senha;

    /**
     * @Column(type="string", name="nivel")
     * 
     */
    protected $nivel;

    /**
     * @Column(type="string", name="status")
     */
    protected $status;

    //Guetter AND Setter de todos os atributos

    public function __set($nome, $valor) {
        return $this->$nome = $valor;
    }

    public function __get($nome) {
        return $this->$nome;
    }

    public function Insert($objecto) {
        $entityManager->persist($objecto);
        $entityManager->flush();
    }

}
