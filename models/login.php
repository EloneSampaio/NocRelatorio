<?php

/**
 * Description of Login_Model
 *
 * @author sam
 */

/**
 * 
 */
class login extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function login($dados) {
        
        require $this->db;
        $entityManager->find();
    }

//fim
}
