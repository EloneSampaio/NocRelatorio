<?php

// bootstrap.php
//vamos configurar a chamada ao Entity Manager, o mais importante do Doctrine
// o Autoload é responsável por carregar as classes sem necessidade de incluí-las previamente
//require_once "/var/www/html/noc/vendor/autoload.php";
// o Doctrine utiliza namespaces em sua estrutura, por isto estes uses
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$root = "/var/www/html/noc/";
//onde irão ficar as entidades do projeto? Defina o caminho aqui
$entidades = array($root . "models/");

$isDevMode = true;

// configurações de conexão. Coloque aqui os seus dados
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'elone',
    'dbname' => 'NOC',
);

//setando as configurações definidas anteriormente
$config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode, NULL, NULL, FALSE);
//criando o Entity Manager com base nas configurações de dev e banco de dados
$entityManager = EntityManager::create($dbParams, $config);

?>