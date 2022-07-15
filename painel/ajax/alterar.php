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

////////// POST PADRAO
$recebido = anti_sql_injection(encrypt_decrypt('decrypt', $_POST['id']));

////////// CARACTERÍSTICAS
if($_POST['acao']=='caracteristicas-alterar') {
$nome = anti_sql_injection($_POST['nome']);

////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM caracteristicas WHERE id_caracteristica='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$update = "UPDATE caracteristicas SET nome='$nome' WHERE id_caracteristica='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CARACTERÍSTICAS

////////// CATEGORIAS
if($_POST['acao']=='categorias-alterar') {
$nome = anti_sql_injection($_POST['nome']);

////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM categorias WHERE id_categoria='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$update = "UPDATE categorias SET nome='$nome' WHERE id_categoria='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CATEGORIAS

////////// USUÁRIOS
if($_POST['acao']=='usuarios-alterar') {
$nome  = anti_sql_injection($_POST['nome']);
$login = anti_sql_injection($_POST['login']);
$senha = anti_sql_injection($_POST['senha']);

if(!empty($senha)) {
  $nova_senha = ", senha='".md5($senha)."'";
}
  
////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM usuarios WHERE id_usuario='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$update = "UPDATE usuarios SET nome='$nome', login='$login' $nova_senha WHERE id_usuario='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// USUÁRIOS

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
$s_dado = "SELECT * FROM clientes WHERE id_cliente='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$update = "UPDATE clientes SET documento='$documento', nome='$nome', cep='$cep', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$estado', telefone='$telefone', email='$email', data_nascimento='$data_nascimento' $nova_senha WHERE id_cliente='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CLIENTES

////////// PRODUTOS
if($_POST['acao']=='produtos-alterar') {
$caracteristicas = DecodificaArrayImplode($_POST['caracteristicas']);
$nome            = anti_sql_injection($_POST['nome']);
$descricao       = anti_sql_injection($_POST['descricao']);
$valor           = anti_sql_injection($_POST['valor']);
$imagem          = '';
  
/////////// ARQUIVO
$extensao = str_replace('.','',strrchr($_FILES["arquivo"]["name"], '.'));
$arquivo  = rand(1111111111,9999999999).date("dmYHis").".".$extensao;
/////////// ARQUIVO
	
$extensoesPermitidas = array('jpg','jpeg','png','gif');

if(in_array($extensao, $extensoesPermitidas))
{
$imagem = ", imagem='$arquivo'";
move_uploaded_file($_FILES['arquivo']["tmp_name"], "../../uploads/produtos/$arquivo");
}
  
////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM produtos WHERE id_produto='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==1) {
$update = "UPDATE produtos SET caracteristicas='$caracteristicas', nome='$nome', descricao='$descricao', valor='$valor' $imagem WHERE id_produto='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// PRODUTOS

////////// PEDIDOS
if($_POST['acao']=='pedido-status') {
$status_pedido = anti_sql_injection($_POST['status_pedido']);
  
////////// VERIFICA SE TEM CADASTRO 
$s_dado = "SELECT * FROM pedidos WHERE id_pedido='$recebido'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==1) {
$update = "UPDATE pedidos SET status_pedido='$status_pedido' WHERE id_pedido='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Alterado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Não foi possível alterar', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// PEDIDOS

mysqli_close($conexao);
?>