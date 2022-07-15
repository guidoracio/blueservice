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

////////// CARACTERÍSTICAS
if($_POST['acao']=='caracteristicas-cadastrar') {
$nome = anti_sql_injection($_POST['nome']);

////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM caracteristicas WHERE nome='$nome' AND status<>'D'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$insert = "INSERT into caracteristicas (nome, status) VALUES ('$nome', 'S')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Característica já cadastrada', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CARACTERÍSTICAS

////////// CATEGORIAS
if($_POST['acao']=='categorias-cadastrar') {
$nome = anti_sql_injection($_POST['nome']);

////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM categorias WHERE nome='$nome' AND status<>'D'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$insert = "INSERT into categorias (nome, status) VALUES ('$nome', 'S')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Categoria já cadastrada', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CATEGORIAS

////////// USUÁRIOS
if($_POST['acao']=='usuarios-cadastrar') {
$nome  = anti_sql_injection($_POST['nome']);
$login = anti_sql_injection($_POST['login']);
$senha = md5(anti_sql_injection($_POST['senha']));

////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM usuarios WHERE login='$login' AND status<>'D'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$insert = "INSERT into usuarios (nome, login, senha, status) VALUES ('$nome', '$login', '$senha', 'S')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Usuário já cadastrado', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// USUÁRIOS

////////// CLIENTES
if($_POST['acao']=='clientes-cadastrar') {
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
$senha           = md5(anti_sql_injection($_POST['senha']));

////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM clientes WHERE documento='$documento' AND status<>'D'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$insert = "INSERT into clientes (documento,nome,cep,endereco,numero,complemento,bairro,cidade,estado,telefone,email,senha,data_nascimento,status) 
                         VALUES ('$documento','$nome','$cep','$endereco','$numero','$complemento','$bairro','$cidade','$estado','$telefone','$email','$senha','$data_nascimento','S')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT');
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Cliente já cadastrado', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// CLIENTES

////////// PRODUTOS
if($_POST['acao']=='produtos-cadastrar') {
$categorias      = $_POST['id_categoria'];
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
$imagem = $arquivo;
move_uploaded_file($_FILES['arquivo']["tmp_name"], "../../uploads/produtos/$arquivo");
}
  
////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM produtos WHERE nome='$nome' AND status<>'D'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==0) {
$insert = "INSERT into produtos (caracteristicas,nome,descricao,imagem,valor,status) 
                         VALUES ('$caracteristicas','$nome','$descricao','$imagem','$valor','S')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT');
  
$id_produto = mysqli_insert_id($conexao);
  
///// CADASTRA CATEGORIA
foreach ($categorias as $key => $id) {
$id_categoria = encrypt_decrypt('decrypt', $id);
  
if($id_categoria>0) {
$insert = "INSERT into produtos_categorias (id_produto,id_categoria) 
                                    VALUES ('$id_produto','$id_categoria')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT CATEGORIA');
}  
}
///// CADASTRA CATEGORIA
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Produto já cadastrado', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// PRODUTOS

////////// PRODUTOS CATEGORIAS
if($_POST['acao']=='produtos-categorias-cadastrar') {
$id_produto = anti_sql_injection(encrypt_decrypt('decrypt', $_POST['produto']));
$categorias = $_POST['id_categoria'];
  
////////// VERIFICA SE JÁ TEM CADASTRO 
$s_dado = "SELECT * FROM produtos WHERE id_produto='$id_produto'";
$q_dado = mysqli_query($conexao, $s_dado) or die('ERRO - DADOS');
$tem    = mysqli_num_rows($q_dado);

if($tem==1) {
///// CADASTRA CATEGORIA
foreach ($categorias as $key => $id) {
$id_categoria = encrypt_decrypt('decrypt', $id);
  
////////// VERIFICA SE JÁ TEM CADASTRO 
$s_categoria   = "SELECT * FROM produtos_categorias WHERE id_produto='$id_produto' AND id_categoria='$id_categoria'";
$q_categoria   = mysqli_query($conexao, $s_categoria) or die('ERRO - CATEGORIA');
$tem_categoria = mysqli_num_rows($q_categoria);
  
if($id_categoria>0 and $tem_categoria==0) {
$insert = "INSERT into produtos_categorias (id_produto,id_categoria) 
                                    VALUES ('$id_produto','$id_categoria')";
$query  = mysqli_query($conexao, $insert) or die('ERRO - INSERT CATEGORIA');
}  
}
///// CADASTRA CATEGORIA
  
$retorno = array('retorno'=>'success', 'mensagem'=>'Cadastrado com sucesso!', 'sub_mensagem'=>'Aguarde...');
} else {
$retorno = array('retorno'=>'error', 'mensagem'=>'Produto não encontrado', 'sub_mensagem'=>'Tente novamente...');
}
  
echo json_encode($retorno); 
}
////////// PRODUTOS

mysqli_close($conexao);
?>