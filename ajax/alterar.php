<?php
ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=utf-8');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
require('../conexao/conexao.php');
require('../conexao/funcoes.php');
require('../conexao/mascaras.php');

////////// CLIENTES
if($_POST['acao']=='clientes-alterar') {
$nome            = anti_sql_injection($_POST['nome']);
$data_nascimento = anti_sql_injection(DATA_US($_POST['data_nascimento']));
$documento       = anti_sql_injection(soNumeros($_POST['documento']));
$cep             = anti_sql_injection(soNumeros($_POST['cep']));
$endereco        = anti_sql_injection($_POST['endereco']);
$numero          = anti_sql_injection($_POST['numero']);
$complemento     = anti_sql_injection($_POST['complemento']);
$bairro          = anti_sql_injection($_POST['bairro']);
$cidade          = anti_sql_injection($_POST['cidade']);
$estado          = anti_sql_injection($_POST['estado']);
$telefone        = anti_sql_injection(soNumeros($_POST['telefone']));
$email           = anti_sql_injection(mb_strtolower($_POST['email']));
$senha           = anti_sql_injection($_POST['senha']);

if(!empty($senha)) {
  $nova_senha = ", senha='".md5($senha)."'";
}

////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM clientes WHERE id_cliente='$ID_CLIENTE'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$update = "UPDATE clientes SET documento='$documento', nome='$nome', cep='$cep', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$estado', telefone='$telefone', email='$email', data_nascimento='$data_nascimento' $nova_senha WHERE id_cliente='$ID_CLIENTE'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CLIENTES

mysqli_close($conexao);
?>