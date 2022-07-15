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

///// POST
$draw            = anti_sql_injection($_POST['draw']);
$row             = anti_sql_injection($_POST['start']);
$rowperpage      = anti_sql_injection($_POST['length']);
$columnIndex     = anti_sql_injection($_POST['order'][0]['column']);
$columnName      = anti_sql_injection($_POST['columns'][$columnIndex]['data']);
$columnSortOrder = anti_sql_injection($_POST['order'][0]['dir']);
$id_pedido       = encrypt_decrypt('decrypt', $_POST['id']);

///// NÚMERO TOTAL DE REGISTROS SEM FILTRAGEM
$s_total        = "SELECT COUNT(*) AS Itens FROM pedidos_itens WHERE apagado='N' AND id_pedido='$id_pedido'";
$q_total        = mysqli_query($conexao,$s_total);
$total          = mysqli_fetch_assoc($q_total);
$totalRegistros = $total['Itens'];

///// LISTAR
$s_listar = "SELECT p.*, pr.nome AS produto, ca.nome AS Caracteristica
             FROM pedidos_itens AS p, caracteristicas AS ca, produtos AS pr
             WHERE 
             p.id_pedido='$id_pedido' AND 
             p.id_caracteristica=ca.id_caracteristica AND 
             p.id_produto=pr.id_produto";
$q_listar = mysqli_query($conexao, $s_listar);

$data = array();

while($row = mysqli_fetch_assoc($q_listar)) {
  $data[] = array( 
    'id_tr'      => encrypt_decrypt('encrypt', $row['id_item']),
    'id_item'    => $row['id_item'],
    'produto'    => $row['produto'].'<br><small><strong>'.$row['Caracteristica'].'</strong></small>',
    'quantidade' => $row['quantidade'],
    'valor'      => 'R$ '.dinheiro($row['valor'])
   );
}

///// RETORNO
$response = array(
  "draw"                 => intval($draw),
  "iTotalRecords"        => $totalRegistros,
  "iTotalDisplayRecords" => 0,
  "aaData"               => $data
);

echo json_encode($response);

mysqli_close($conexao);
?>