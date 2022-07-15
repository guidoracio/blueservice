<?php
ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=utf-8');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
require('../../conexao/conexao.php');
require('../../conexao/funcoes.php');
require('../../conexao/mascaras.php');

////////// LOGIN
if($_POST['acao']=='login') {
$login = anti_sql_injection($_POST['login']);
$senha = anti_sql_injection(md5($_POST['senha']));
  
//// DADOS
$s_dados = "SELECT * FROM usuarios WHERE login='$login' AND senha='$senha' AND status='S'";   
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO - DADOS');
$dados   = mysqli_fetch_assoc($q_dados);
$t_dados = mysqli_num_rows($q_dados);
	
if($t_dados==1)
{
  
$_SESSION['PAINEL_ID']    = $dados['id_usuario'];
$_SESSION['PAINEL_LOGIN'] = $dados['login'];
$_SESSION['PAINEL_PASS']  = $dados['senha'];
  
$cache_limiter = session_cache_limiter();
$cache_expire  = session_cache_expire();
	
$retorno = array('retorno'=>'success', 'mensagem'=>'Logado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Dados inválidos ou usuário desativado.', 'sub_mensagem'=>'Tente novamente...');
}
echo json_encode($retorno); 
}
////////// LOGIN

mysqli_close($conexao);
?>