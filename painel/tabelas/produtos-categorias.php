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
$id_produto      = encrypt_decrypt('decrypt', $_POST['id']);

///// NÚMERO TOTAL DE REGISTROS SEM FILTRAGEM
$s_total        = "SELECT COUNT(*) AS ProdutosCategorias FROM produtos_categorias WHERE id_produto='$id_produto'";
$q_total        = mysqli_query($conexao,$s_total);
$total          = mysqli_fetch_assoc($q_total);
$totalRegistros = $total['ProdutosCategorias'];

///// LISTAR
$s_listar = "SELECT pc.id AS id, p.nome AS produto, c.nome AS categoria 
             FROM produtos_categorias AS pc, produtos AS p, categorias AS c
             WHERE 
             pc.id_produto='$id_produto' AND 
             pc.id_produto=p.id_produto AND 
             pc.id_categoria=c.id_categoria
             ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$q_listar = mysqli_query($conexao, $s_listar);

$data = array();

while($row = mysqli_fetch_assoc($q_listar)) {
  $data[] = array( 
    'id_tr'     => encrypt_decrypt('encrypt', $row['id']),
    'id'        => $row['id'],
    'produto'   => $row['produto'],
    'categoria' => $row['categoria'],
    'funcoes'    => '<div class="dropdown">
          <button class="btn btn-light dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="excluirRegistro dropdown-item text-danger" href="javascript:void(0);" data-id="'.encrypt_decrypt('encrypt', $row['id']).'" data-acao="produtosCategoriaApagar"><i class="fa-solid fa-trash-can"></i> Apagar</a></li>
          </ul>
        </div>'
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