<?php
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(false);
session_start();

$hostname = 'localhost';
$database = 'blue_loja';
$username = 'root';
$password = '';

$conexao = mysqli_connect($hostname, $username, $password, $database);
if(mysqli_connect_errno()) {
  echo 'Falha ao conectar ao MySQL: ' . mysqli_connect_error();
}

$conexao->set_charset("utf8mb4");

///////// PADRÕES
$by          = 'Guilherme Comelli Dorácio';
$Open_URL    = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$Name        = 'Blue Service - Loja';
$painel      = 'http://localhost/blue/painel';
$dominio     = 'http://localhost/blue';
$componentes = 'http://localhost/blue/componentes';
$versao      = '?v='.date('YmdHis');

$SESSION_CARRINHO = $_SESSION['LOJA_CARRINHO'];
$ID_CLIENTE       = $_SESSION['CLIENTE_ID'];
?>