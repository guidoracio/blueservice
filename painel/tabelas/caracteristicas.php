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
$searchValue     = mysqli_real_escape_string($conexao,$_POST['search']['value']); 

///// BUSCA
$searchQuery = '';
if($searchValue != ''){
  $searchQuery = " AND (nome LIKE '%".$searchValue."%')";
}

///// NÚMERO TOTAL DE REGISTROS SEM FILTRAGEM
$s_total        = "SELECT COUNT(*) AS Caracteristicas FROM caracteristicas WHERE status<>'D'";
$q_total        = mysqli_query($conexao,$s_total);
$total          = mysqli_fetch_assoc($q_total);
$totalRegistros = $total['Caracteristicas'];

///// NÚMERO TOTAL DE REGISTRO COM FILTRAGEM
$s_total_busca        = "SELECT COUNT(*) AS CaracteristicasBusca FROM caracteristicas WHERE status<>'D' ".$searchQuery;
$q_total_busca        = mysqli_query($conexao,$s_total_busca);
$total_busca          = mysqli_fetch_assoc($q_total_busca);
$totalRegistrosFiltro = $total_busca['CaracteristicasBusca'];

///// LISTAR
$s_listar = "SELECT * FROM caracteristicas WHERE status<>'D' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$q_listar = mysqli_query($conexao, $s_listar);
$data     = array();

while($row = mysqli_fetch_assoc($q_listar)) {
  if($row['status']=='S') $status_class = 'success'; else $status_class = 'danger';
  if($row['status']=='S') $status       = 'ativo'; else $status = 'inativo';
  
  $data[] = array( 
    'id'                => encrypt_decrypt('encrypt', $row['id_caracteristica']),
    'id_caracteristica' => $row['id_caracteristica'],
    'nome'              => $row['nome'],
    'status'            => '<a href="javascript:void(0)" class="statusRegistro btn btn-sm btn-'.$status_class.'" data-id="'.encrypt_decrypt('encrypt', $row['id_caracteristica']).'" data-acao="caracteristicaStatus" id="btStatus-'.encrypt_decrypt('encrypt', $row['id_caracteristica']).'">'.$status.'</a>',
    'funcoes'           => '<div class="dropdown">
          <button class="btn btn-light dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="./caracteristicas-alterar/'.encrypt_decrypt('encrypt', $row['id_caracteristica']).'"><i class="fa-solid fa-pen-to-square"></i> Alterar</a></li>
            <li><a class="excluirRegistro dropdown-item text-danger" href="javascript:void(0);" data-id="'.encrypt_decrypt('encrypt', $row['id_caracteristica']).'" data-acao="caracteristicasApagar"><i class="fa-solid fa-trash-can"></i> Apagar</a></li>
          </ul>
        </div>'
   );
}

///// RETORNO
$response = array(
  "draw"                 => intval($draw),
  "iTotalRecords"        => $totalRegistros,
  "iTotalDisplayRecords" => $totalRegistrosFiltro,
  "aaData"               => $data
);

echo json_encode($response);

mysqli_close($conexao);
?>