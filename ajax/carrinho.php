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

////////// APAGAR ITEM CARRINHO
if($_POST['acao']=='apagar-item') {
$id_item = encrypt_decrypt('decrypt', $_POST['item']);
  
////////// ITENS
$s_carrinho_itens = "SELECT * FROM carrinho_itens WHERE id_item='$id_item'";
$q_carrinho_itens = mysqli_query($conexao, $s_carrinho_itens) or die('ERRO - ITENS');
$carrinho_itens   = mysqli_fetch_assoc($q_carrinho_itens);
$t_carrinho_itens = mysqli_num_rows($q_carrinho_itens);
  
if($t_carrinho_itens>0) {
$delete = "DELETE FROM carrinho_itens WHERE id_item='$id_item'";
$query  = mysqli_query($conexao, $delete) or die('ERRO');

$retorno = array('retorno'=>'success', 'mensagem'=>'Produto apagado do carrinho com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Produto não encontrado', 'sub_mensagem'=>'Tente novamente...');
}

echo json_encode($retorno);
}
////////// APAGAR ITEM CARRINHO

////////// APAGAR ITEM CARRINHO
if($_POST['acao']=='finalizar-carrinho') {
  
////////// CARRINHO
$s_carrinho = "SELECT * FROM carrinho WHERE codigo='$SESSION_CARRINHO'";
$q_carrinho = mysqli_query($conexao, $s_carrinho) or die('ERRO - CARRINHO');
$carrinho   = mysqli_fetch_assoc($q_carrinho);
$t_carrinho = mysqli_num_rows($q_carrinho);

$id_carrinho = $carrinho['id_carrinho'];
  
////////// ITENS
$s_carrinho_itens = "SELECT * FROM carrinho_itens WHERE id_carrinho='$id_carrinho'";
$q_carrinho_itens = mysqli_query($conexao, $s_carrinho_itens) or die('ERRO - ITENS');
$carrinho_itens   = mysqli_fetch_assoc($q_carrinho_itens);
$t_carrinho_itens = mysqli_num_rows($q_carrinho_itens);
  
if($t_carrinho>0) {
$valor_pedido = 0;
  
//// CRIA PEDIDO
$s_insert = "INSERT INTO pedidos (id_cliente, cliente, codigo, data_hora, cep, endereco, numero, bairro, complemento, cidade, estado) 
						 SELECT id_cliente, cliente, codigo, data_hora, cep, endereco, numero, bairro, complemento, cidade, estado FROM carrinho WHERE id_carrinho='$id_carrinho'";
$q_insert = mysqli_query($conexao, $s_insert) or die('ERRO - INSERT');
	
$id_pedido = mysqli_insert_id($conexao);
  
//// ITEMS DO PEDIDO
if($t_carrinho_itens>0) {
  do {
    $id_caracteristica = $carrinho_itens['id_caracteristica'];
    $id_produto        = $carrinho_itens['id_produto'];
    $nome_produto      = $carrinho_itens['nome_produto'];
    $quantidade        = $carrinho_itens['quantidade'];
    $valor             = $carrinho_itens['valor'];
    
    $s_insert_itens = "INSERT INTO pedidos_itens (id_caracteristica, id_pedido, id_produto, nome_produto, quantidade, valor)
                                          VALUES ('$id_caracteristica', '$id_pedido', '$id_produto', '$nome_produto', '$quantidade', '$valor')";
    $q_insert_itens = mysqli_query($conexao, $s_insert_itens) or die('ERRO - INSERT ITENS');
    
    $valor_pedido = $valor_pedido + ($carrinho_itens['quantidade']*$carrinho_itens['valor']);
  } while ($carrinho_itens = mysqli_fetch_assoc($q_carrinho_itens));
  
  //// ATUALIZA PEDIDO
  $update = "UPDATE pedidos SET status_pedido='INSERIDO', valor_pedido='$valor_pedido' WHERE id_pedido='$id_pedido'";
  $query  = mysqli_query($conexao, $update) or die('ERRO - UPDATE');
}
  
//// LIMPA SESSION
$_SESSION['LOJA_CARRINHO'] = '';
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Carrinho finalizado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Carrinho não encontrado', 'sub_mensagem'=>'Tente novamente...');
}

echo json_encode($retorno);
}
////////// APAGAR ITEM CARRINHO

mysqli_close($conexao);
?>