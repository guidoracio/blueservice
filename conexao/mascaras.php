<?php
// True ou False 
function TrueFalseEnum($str) {
	if ($str == 'true' or $str == true or $str == 1)   { $retorno = 'S'; }
	if ($str == 'false' or $str == false or $str == 0) { $retorno = 'N'; }
	return $retorno;
}

// Timestamp para data us
function TimestampUS($timestamp) {
	$date = new \DateTime();
	$date->setTimestamp($timestamp);

	return $date->format('Y-m-d H:i:s');
}

// Sim ou Nao
function simNao($str)
	{
	if ($str == 'S') { $retorno = 'SIM'; }
	if ($str == 'N') { $retorno = 'NÃO'; }
	return $retorno;
}

// Pessoa Fisica ou Juridica
function tipoCadastro($str)
	{
	if ($str=='Jurídica')
	return 'JURIDICA';
	else
	return 'FISICA';
}

// Transforma em dinheiro
function dinheiro($vlr)
	{
	return number_format($vlr,2,".",".");
}

// Converte CNPJ 09536696000140 para 09.536.696/0001-40
function CNPJ($cnpj)
	{ 
	$parte1=strval(substr($cnpj,0,2)); 
	$parte2=strval(substr($cnpj,2,3)); 
	$parte3=strval(substr($cnpj,5,3));
	$parte4=strval(substr($cnpj,8,4));
	$parte5=strval(substr($cnpj,12,2));
	
	return $parte1.'.'.$parte2.'.'.$parte3.'/'.$parte4.'-'.$parte5;
}

// Converte CPF 28695890856 para 286.958.908-56
function CPF($cpf)
	{ 
	$parte1=strval(substr($cpf,0,3)); 
	$parte2=strval(substr($cpf,3,3)); 
	$parte3=strval(substr($cpf,6,3));
	$parte4=strval(substr($cpf,9,2));
	
	return $parte1.'.'.$parte2.'.'.$parte3.'-'.$parte4;
}

// Converte CEP 19801278 para 19801-278
function CEP($rg)
	{ 
	$parte1=strval(substr($rg,0,5)); 
	$parte2=strval(substr($rg,5,3)); 
	
	return $parte1.'-'.$parte2;
}

// Converte TELEFONE 18997233373 para (18) 99723-3373 / 1833234150 para (18) 3323-4150
function TELEFONE($tel)
	{
	if ($tel=='')
	return '';
	if (strlen($tel)==11){
	$parte1=strval(substr($tel,0,2)); 
	$parte2=strval(substr($tel,2,5)); 
	$parte3=strval(substr($tel,7,4));
	} else {
	$parte1=strval(substr($tel,0,2)); 
	$parte2=strval(substr($tel,2,4)); 
	$parte3=strval(substr($tel,6,4));
    }
	return '('.$parte1.') '.$parte2.'-'.$parte3;
}

// Converte data 0000-00-00 para 00/00/0000
function DATA_BR($data)
	{ 
	if ($data=="0000-00-00") return ''; 
	$ano=strval(substr($data,0,4)); 
	$mes=strval(substr($data,5,2)); 
	$dia=strval(substr($data,8,2)); 
	
	return date("$dia/$mes/$ano");
}

function DATA_BLOG($data)
	{ 
	if ($data=="0000-00-00") return ''; 
	$ano = strval(substr($data,0,4)); 
	$mes = strval(substr($data,5,2)); 
	$dia = strval(substr($data,8,2)); 
	
	$mes = mb_strtolower(MES($data));
	
	return "$dia de $mes de $ano";
}

// Converte CEP 00/00/0000 para 0000-00-00
function DATA_US($data)
	{ 
	if ($data=="00/00/0000") return ''; 
	$dia=strval(substr($data,0,2)); 
	$mes=strval(substr($data,3,2)); 
	$ano=strval(substr($data,6,4)); 
	
	return date("$ano-$mes-$dia");
}

// Converte horas 00:00:00 para 00:00
function HORA_BR($horas)
	{
	if ($horas=="00:00:00") return ''; 

	$hora   = strval(substr($horas,0,2)); 
	$minuto = strval(substr($horas,3,2)); 

	return "$hora:$minuto";
}

// Data e Hora Brasil	
function DATA_HORA_BR($data)
	{
	if ($dt=="0000-00-00 00:00:00") return '';
	
	$ano = strval(substr($data,0,4));
	$mes = strval(substr($data,5,2));
	$dia = strval(substr($data,8,2));
	$hr = strval(substr($data,11,2));
	$mn = strval(substr($data,14,2));

	return "$dia/$mes/$ano &agrave;s $hr:$mn";
}

// Dia da Semana
function DIA_SEMANA($data) {
	$ano =  substr("$data", 8, 4);
	$mes =  substr("$data", 3, 2);
	$dia =  substr("$data", 0, 2);
	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "Domingo";       break;
		case"1": $diasemana = "Segunda-Feira"; break;
		case"2": $diasemana = "Terça-Feira";   break;
		case"3": $diasemana = "Quarta-Feira";  break;
		case"4": $diasemana = "Quinta-Feira";  break;
		case"5": $diasemana = "Sexta-Feira";   break;
		case"6": $diasemana = "Sábado";        break;
	}
	return $diasemana;
}

// Mes
function MES($data) {
	$mes = strval(substr($data,5,2)); 

	switch($mes) {
		case"01": $MesSelecionado = "Janeiro";   break;
		case"02": $MesSelecionado = "Fevereiro"; break;
		case"03": $MesSelecionado = "Marco";     break;
		case"04": $MesSelecionado = "Abril";     break;
		case"05": $MesSelecionado = "Maio";      break;
		case"06": $MesSelecionado = "Junho";     break;
		case"07": $MesSelecionado = "Julho";     break;
		case"08": $MesSelecionado = "Agosto";    break;
		case"09": $MesSelecionado = "Setembro";  break;
		case"10": $MesSelecionado = "Outubro";   break;
		case"11": $MesSelecionado = "Novembro";  break;
		case"12": $MesSelecionado = "Dezembro";  break;
	}
	return utf8_decode($MesSelecionado);
}

function ESTADOS($uf) {
	switch($uf) {
		case"AC": $estado = "Acre";                break;
		case"AL": $estado = "Alagoas";             break;
		case"AM": $estado = "Amazonas";            break;
		case"AP": $estado = "Amapá";               break;
		case"BA": $estado = "Bahia";               break;
		case"CE": $estado = "Ceará";               break;
		case"DF": $estado = "Distrito Federal";    break;
		case"ES": $estado = "Espírito Santo";      break;
		case"GO": $estado = "Goiás";               break;
		case"MA": $estado = "Maranhão";            break;
		case"MG": $estado = "Minas Gerais";        break;
		case"MS": $estado = "Mato Grosso do Sul";  break;
		case"MT": $estado = "Mato Grosso";         break;
		case"PA": $estado = "Pará";                break;
		case"PB": $estado = "Paraíba";             break;
		case"PE": $estado = "Pernambuco";          break;
		case"PI": $estado = "Piauí";               break;
		case"PR": $estado = "Paraná";              break;
		case"RJ": $estado = "Rio de Janeiro";      break;
		case"RN": $estado = "Rio Grande do Norte"; break;
		case"RO": $estado = "Rondônia";            break;
		case"RR": $estado = "Roraima";             break;
		case"RS": $estado = "Rio Grande do Sul";   break;
		case"SC": $estado = "Santa Catarina ";     break;
		case"SE": $estado = "Sergipe";             break;
		case"SP": $estado = "São Paulo";           break;
		case"TO": $estado = "Tocantins";           break;
	}
	return mb_strtoupper($estado);
}
?>