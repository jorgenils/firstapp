<?php
include "conexion.php";
function buscar($text){
	$res = '';
	$cod=base64_encode($text);
	$sql = "select * from mensajes where msg_encriptado = '$cod'";
	$dat = mysql_query($sql);
	while($reg = @mysql_fetch_assoc($dat)){
		$res .= 'ID:'.$reg['ID'].'   msgEncriptado:'.$reg['msg_encriptado']."<br>";
	}
	return ($res);
}
function decodificar($valor){
	$sql = "select * from mensajes where ID = '$valor'";
	$reg = @mysql_fetch_assoc(mysql_query($sql));
	return base64_decode($reg['msg_encriptado']);
}
function matriz($valor){
	$sql = "select * from mensajes where ID = '$valor'";
	$reg = @mysql_fetch_assoc(mysql_query($sql));
	$msg = $reg['msg_encriptado'];
	$msgdc = base64_decode($msg);
	$vector = str_split($msgdc);
	//echo count($vector);
	$dim = strlen($msgdc);
	$dimmat = sqrt($dim);
	$cont=0;
	$cont1=0;
	for($i = 0; $i <= (count($vector)-1); $i++){
		if($cont1 > ($dimmat-1)){
			$cont++;
			$cont1 = 0;
		}
		$mat[$cont][$cont1]=$vector[$i];
		$cont1++;
	}
	return $mat;
}
function agregar($msgdc){
	$msgdc = str_replace(" ", "@", $msgdc);
	$dim = strlen($msgdc);
	$dimmat = ceil(sqrt($dim));
	$caracfalt = ($dimmat*$dimmat)-$dim;
	if($caracfalt > 0){
		for($i=1;$i<=$caracfalt;$i++){
			$msgdc .= '@';
		}
	}
	$msgcod = addslashes(base64_encode($msgdc));
	$insert = "insert into mensajes (msg_encriptado) Values ('$msgcod')";
	mysql_query($insert);
}
?>