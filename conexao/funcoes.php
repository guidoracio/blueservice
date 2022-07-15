<?php
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "não for Windows"

// Criptografia
function encrypt_decrypt($action, $string) {
	$output         = false;
  $encrypt_method = "AES-256-CBC";
  $secret_key     = '1O9AEQk9IU';
  $secret_iv      = '7jON8XYOLk';
  $key            = hash('sha256', $secret_key); 
	$iv             = substr(hash('sha256', $secret_iv), 0, 16);

	if($action=='encrypt') {
  	$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  } else if($action=='decrypt')	{
  	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

// Decodificar Array + Implode
function DecodificaArrayImplode($array) {
	if(!empty($array) and count($array)>0) {
		$array_retorno = array();
		for($i=0; $i<count($array); $i++) {
			$id = trim(encrypt_decrypt('decrypt', $array[$i]));
			if(!empty($id)) {
				array_push($array_retorno, $id);
			}
		}
		return implode(',', $array_retorno);
	} else {
		return '';
	}	
}

// Remove o campo vazio do array
function RemoveCamposVazioArray($array)
{
if(empty($array)) {
  return array();
}
if(count($array)>0) {
$array = array_filter($array);
$array = array_values($array);
}
return $array;
}

// Somente numeros
function soNumeros($str) {
	$numero = preg_replace("/[^0-9]/", "", $str);
	return $numero;
}

// função para retirar acentos e passar a frase para minúscula
function tiraAcentos($string) {
$comAcentos  = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
$semAcentos  = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
$comSimbolos = array('"','!','@','#','$','%','&','*','(',')','_','-','+','=','{','[','}',']','/','?',';',':','.',',','<','>','°','º','ª','\\');
$semSimbolos = array('','','','','','','','','','','','','','','','','','','-','','','','','','','','','','','');

$newString = str_replace($comAcentos, $semAcentos, $string);
$newString = str_replace($comSimbolos, $semSimbolos, $newString);
$newString = str_replace(" ","-",$newString);
$newString = str_replace(array("-----","----","---","--"),"-",$newString);

return strtolower(utf8_encode($newString));
}

function trocaVirgula($string)
{
return str_replace(",", ".", $string);
}


function anti_sql_injection($campo, $adicionaBarras = false) {
// remove palavras que contenham sintaxe sql
$campo = preg_replace("/(from|alter table|select|insert|delete|update|were|drop table|show tables)/i","Anti Sql-Injection",$campo);
$campo = trim($campo);//limpa espaços vazio
if($adicionaBarras || !get_magic_quotes_gpc())
$campo = addslashes($campo);
$campo = trim($campo);
return $campo;
}

function anti_xss($string) {
	$string  = htmlspecialchars($string);	
  $string  = htmlentities($string);
  return $string;
}

function utf8Fix($msg) {
$accents = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
$utf8 = array("Ã¡","Ã ","Ã¢","Ã£","Ã¤","Ã©","Ã¨","Ãª","Ã«","Ã­","Ã¬","Ã®","Ã¯","Ã³","Ã²","Ã´","Ãµ","Ã¶","Ãº","Ã¹","Ã»","Ã¼","Ã§","Ã","Ã€","Ã‚","Ãƒ","Ã„","Ã‰","Ãˆ","ÃŠ","Ã‹","Ã","ÃŒ","ÃŽ","Ã","Ã“","Ã’","Ã”","Ã•","Ã–","Ãš","Ã™","Ã›","Ãœ","Ã‡");
$fix = str_replace($utf8, $accents, $msg);
return $fix;
}
?>