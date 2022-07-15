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

////////// PRODUTOS
if($_GET['acao']=='produtoStatus') {
  
$s_dados = "SELECT * FROM produtos WHERE id_produto='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if($dados['status']=='S') { $novoStatus = 'N'; $logStatus = 'INATIVO'; }
if($dados['status']=='N') { $novoStatus = 'S'; $logStatus = 'ATIVO';   }

$update = "UPDATE produtos SET status='$novoStatus' WHERE id_produto='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo $novoStatus;
}

if($_GET['acao']=='produtosApagar') {

$update = "UPDATE produtos SET status='D' WHERE id_produto='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}

if($_GET['acao']=='produtosCategoriaApagar') {

$delete = "DELETE FROM produtos_categorias WHERE id='$recebido'";
$query  = mysqli_query($conexao, $delete) or die('ERRO');

echo 1;
}

if($_GET['acao']=='produtoImagemApaga') {

$s_dados = "SELECT imagem FROM produtos WHERE id_produto='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if (!empty($dados['imagem']))
{
@unlink('../../uploads/produtos/'.$dados['imagem']);
}

$update = "UPDATE produtos SET imagem='' WHERE id_produto='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');
  
echo 1;
}
////////// PRODUTOS

////////// CATEGORIAS
if($_GET['acao']=='categoriaStatus') {
  
$s_dados = "SELECT * FROM categorias WHERE id_categoria='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if($dados['status']=='S') { $novoStatus = 'N'; $logStatus = 'INATIVO'; }
if($dados['status']=='N') { $novoStatus = 'S'; $logStatus = 'ATIVO';   }

$update = "UPDATE categorias SET status='$novoStatus' WHERE id_categoria='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo $novoStatus;
}

if($_GET['acao']=='categoriasApagar') {

$update = "UPDATE categorias SET status='D' WHERE id_categoria='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}
////////// CATEGORIAS

////////// CARACTERÍSTICAS
if($_GET['acao']=='caracteristicaStatus') {
  
$s_dados = "SELECT * FROM caracteristicas WHERE id_caracteristica='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if($dados['status']=='S') { $novoStatus = 'N'; $logStatus = 'INATIVO'; }
if($dados['status']=='N') { $novoStatus = 'S'; $logStatus = 'ATIVO';   }

$update = "UPDATE caracteristicas SET status='$novoStatus' WHERE id_caracteristica='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo $novoStatus;
}

if($_GET['acao']=='caracteristicasApagar') {

$update = "UPDATE caracteristicas SET status='D' WHERE id_caracteristica='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}
////////// CARACTERÍSTICAS

////////// CLIENTES
if($_GET['acao']=='clienteStatus') {
  
$s_dados = "SELECT * FROM clientes WHERE id_cliente='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if($dados['status']=='S') { $novoStatus = 'N'; $logStatus = 'INATIVO'; }
if($dados['status']=='N') { $novoStatus = 'S'; $logStatus = 'ATIVO';   }

$update = "UPDATE clientes SET status='$novoStatus' WHERE id_cliente='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo $novoStatus;
}

if($_GET['acao']=='clientesApagar') {

$update = "UPDATE clientes SET status='D' WHERE id_cliente='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}
////////// CLIENTES

////////// USUARIOS
if($_GET['acao']=='usuarioStatus') {
  
$s_dados = "SELECT * FROM usuarios WHERE id_usuario='$recebido'";
$q_dados = mysqli_query($conexao, $s_dados) or die('ERRO');
$dados   = mysqli_fetch_assoc($q_dados);

if($dados['status']=='S') { $novoStatus = 'N'; $logStatus = 'INATIVO'; }
if($dados['status']=='N') { $novoStatus = 'S'; $logStatus = 'ATIVO';   }

$update = "UPDATE usuarios SET status='$novoStatus' WHERE id_usuario='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo $novoStatus;
}

if($_GET['acao']=='usuariosApagar') {

$update = "UPDATE usuarios SET status='D' WHERE id_usuario='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}
////////// USUARIOS

////////// PEDIDOS
if($_GET['acao']=='pedidosApagar') {

$update = "UPDATE pedidos SET apagado='S' WHERE id_pedido='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}

if($_GET['acao']=='pedidosItensApagar') {

$update = "UPDATE pedidos SET apagado='S' WHERE id_pedido='$recebido'";
$query  = mysqli_query($conexao, $update) or die('ERRO');

echo 1;
}
////////// PEDIDOS

mysqli_close($conexao);
?>