<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "/var/www/html/noc/config/bootstrap.php";
require '/var/www/html/noc/models/src/usuario.php';


$teste=$entityManager->find('usuario',1);
print $teste->nome;

$teste1=$entityManager->getRepository('usuario')->findOneBy(array('nome' => 'sam'));
print_r($teste1);

$alt=$entityManager->find('usuario', 3);

$alt->nome='Herlenmm';
$entityManager->persist($alt);
$entityManager->flush();
//
//$excluir = $entityManager->find('usuario', 4);
//$entityManager->remove($excluir);
//$entityManager->flush();