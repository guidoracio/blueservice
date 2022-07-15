<?php
ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=utf-8');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
require('./conexao/conexao.php');
require('./conexao/funcoes.php');
require('./conexao/mascaras.php');

// URL amigável
$atual     = (isset($_GET['pg'])) ? $_GET['pg'] : 'home';
$permissao = array('home','categorias','produto','carrinho','meus-dados','meus-pedidos','pedidos-visualizar');
if(substr_count($atual, '/') > 0) {
	$atual        = explode('/', $atual);
	$urlAcesso    = (file_exists($atual[0].'.php') && in_array($atual[0], $permissao)) ? $atual[0] : 'erro';
	$Complemento1 = anti_sql_injection($atual[1]);
	$Complemento2 = anti_sql_injection($atual[2]);
  $Complemento3 = anti_sql_injection($atual[3]);
} else {
	$urlAcesso    = (file_exists($atual.'.php') && in_array($atual, $permissao)) ? $atual : 'home';
	$Complemento1 = 0;
	$Complemento2 = 0;
	$Complemento3 = 0;
}

///////// DADOS LOGIN 
$s_logado = "SELECT SQL_NO_CACHE * FROM clientes WHERE id_cliente='{$_SESSION['CLIENTE_ID']}' AND documento='{$_SESSION['CLIENTE_LOGIN']}' AND senha='{$_SESSION['CLIENTE_PASS']}' AND status='S'";  
$q_logado = mysqli_query($conexao, $s_logado) or die('ERRO - LOGADO');
$logado   = mysqli_fetch_assoc($q_logado);
$t_logado = mysqli_num_rows($q_logado);

echo '<!DOCTYPE html>';
echo '<html class="h-100">';
	require('head.php');
echo '<body class="h-100">';
  echo '<div class="container">';
	 require('topo.php');
	 require("{$urlAcesso}.php");
	 require('rodape.php');
  echo '</div>';
	require('scripts.php');
echo '</body>';
echo '</html>';

mysqli_close($conexao);
?>