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

///////// DADOS LOGIN 
$s_logado = "SELECT SQL_NO_CACHE * FROM clientes WHERE id_cliente='{$_SESSION['CLIENTE_ID']}' AND documento='{$_SESSION['CLIENTE_LOGIN']}' AND senha='{$_SESSION['CLIENTE_PASS']}' AND status='S'";  
$q_logado = mysqli_query($conexao, $s_logado) or die('ERRO - LOGADO');
$logado   = mysqli_fetch_assoc($q_logado);
$t_logado = mysqli_num_rows($q_logado);

if($t_logado>0) {
$id_produto        = encrypt_decrypt('decrypt', $_POST['produto']);
$id_caracteristica = encrypt_decrypt('decrypt', $_POST['caracteristicas']);

////////// PRODUTOS
$s_produtos = "SELECT * FROM produtos WHERE status='S' AND id_produto='$id_produto'";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - PRODUTOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);

if($t_produtos>0) {
  
if(empty($SESSION_CARRINHO)) {
$token = mb_strtoupper(md5(uniqid(rand(), true)));
	
$_SESSION['LOJA_CARRINHO'] = $token;
  
////////// CLIENTES
$s_clientes = "SELECT * FROM clientes WHERE id_cliente='$ID_CLIENTE' AND status<>'D'";
$q_clientes = mysqli_query($conexao, $s_clientes) or die('ERRO - CLIENTES');
$clientes   = mysqli_fetch_assoc($q_clientes);
$t_clientes = mysqli_num_rows($q_clientes);
	
$cliente     = $clientes['nome'];
$cep         = $clientes['cep'];
$endereco    = $clientes['endereco'];
$numero      = $clientes['numero'];
$bairro      = $clientes['bairro'];
$complemento = $clientes['complemento'];
$cidade      = $clientes['cidade'];
$estado      = $clientes['estado'];
  
////////// INSERT
$s_insert = "INSERT INTO carrinho (id_cliente, codigo, valor_pedido, cliente, cep, endereco, numero, bairro, complemento, cidade, estado) 
                           VALUES ('$ID_CLIENTE', '$token', '0.00', '$cliente', '$cep', '$endereco', '$numero', '$bairro', '$complemento', '$cidade', '$estado')";
$q_insert  = mysqli_query($conexao,$s_insert) or die('ERRO - CARRINHO INSERT');

$id_carrinho = mysqli_insert_id($conexao);
} else {
$s_carrinho = "SELECT id_carrinho FROM carrinho WHERE codigo='$SESSION_CARRINHO'";
$q_carrinho = mysqli_query($conexao,$s_carrinho) or die('ERRO - CARRINHO');
$carrinho   = mysqli_fetch_assoc($q_carrinho);

$id_carrinho = $carrinho['id_carrinho'];
}
$SESSION_CARRINHO = $_SESSION['LOJA_CARRINHO'];
  
/// VERIFICA SE O ITENS ESTÁ NO CARRINHO
$s_carrinho_itens = "SELECT * FROM carrinho_itens WHERE id_carrinho='$id_carrinho' AND id_caracteristica='$id_caracteristica' AND id_produto='$id_produto'";
$q_carrinho_itens = mysqli_query($conexao,$s_carrinho_itens) or die('ERRO - CARRINHO ITENS');
$carrinho_itens   = mysqli_fetch_assoc($q_carrinho_itens);
$t_carrinho_itens = mysqli_num_rows($q_carrinho_itens);
  
if($t_carrinho_itens==0) {
////////// INSERT
$nome_produto = $produtos['nome'];
$valor        = $produtos['valor'];
  
$s_item_insert = "INSERT INTO carrinho_itens (id_carrinho, id_caracteristica, id_produto, nome_produto, quantidade, valor) 
																		  VALUES ('$id_carrinho', '$id_caracteristica', '$id_produto', '$nome_produto', '1', '$valor')";
$q_item_insert = mysqli_query($conexao,$s_item_insert) or die('ERRO - INSERT CARRINHO ITENS');  
} else {
$id_item    = $carrinho_itens['id_item'];

$s_item_update = "UPDATE carrinho_itens SET quantidade=quantidade+1 WHERE id_item='$id_item'";
$q_item_update = mysqli_query($conexao,$s_item_update) or die('ERRO - UPDATE CARRINHO ITENS');
}
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Produto adicionado ao carrinho com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Produto não encontrado', 'sub_mensagem'=>'Tente novamente...');
}
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Você deve estar logado!', 'sub_mensagem'=>'Tente novamente...');
}

echo json_encode($retorno);

mysqli_close($conexao);
?>