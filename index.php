<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './vendor/autoload.php';
include 'config/config.php';
include 'config/cli-config.php';
require './config/autoload.php';
require './config/bootstrap.php';

try {


   
    Session::iniciar();

    Bootstrap::run(new Request());
} catch (Exception $ex) {
    echo $ex->getMessage();
}


        
