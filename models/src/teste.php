<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Fazendo o require do arquivo Bootstrap.php, podemos utilizar tudo que lá foi definido.
 * Estou falando principalmente do EntityManager, criado sobre a variável $entityManager
 */
 $t=$_SERVER['DOCUMENT_ROOT']; 

require_once "/var/www/html/noc/config/bootstrap.php";
require './usuario.php';
/**
 * 
 *  instanciando a entidade Categoria
 */
$teste = new usuario();
 
/**
 * 
 * utilizando a função setNome 
 * Defino o nome da categoria a ser criada no banco de dados
 */
$teste->nome="sdff";
$teste->login="herlen";
$teste->nivel="admin";
$teste->senha="sam";
$teste->status="on";

//$teste->setNo('tetsfsse');
//$teste->setLogin('asdf');
//$teste->setSenha('sam');
//$teste->setStatus('on');
//$teste->setNivel('admin');
 
/**
 * 
 * Aqui o EM entra em ação. 
 * A função persist aguarda por um objeto  para colocá-lo na fila
 * de instruções a ser executada sobre o banco de dados
 */
$entityManager->persist($teste);

 
/**
 * 
 * Novamente o EM age e invoca a função flush.
 * Esta é a responsável por pegar todas as intruções previamente preparadas
 * pelo persist e executá-las no banco de dados. 
 * Só a apartir daqui o banco é alterado de alguma forma.
 */
$entityManager->flush();