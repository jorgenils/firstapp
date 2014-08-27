<?php

include "conexion.php";
include "controler.php";
page_load();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function nuevoAjax()
{ 
    /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
    lo que se puede copiar tal como esta aqui */
    var xmlhttp=false; 
    try 
    { 
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch(e)
    { 
        try
        { 
            // Creacion del objet AJAX para IE 
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
        } 
        catch(E) { xmlhttp=false; }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

    return xmlhttp; 
}

function traerDatos1(tipoDato)
{
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa=document.getElementById("demoArr");
    // Creo el objeto AJAX
    var ajax=nuevoAjax();
    // Coloco el mensaje "Cargando..." en la capa
    capa.innerHTML="Cargando...";
    // Abro la conexión, envío cabeceras correspondientes al uso de POST y envío los datos con el método send del objeto AJAX
    ajax.open("POST", "controler.php?decode=ok", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id="+tipoDato);

    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            // Respuesta recibida. Coloco el texto plano en la capa correspondiente
            capa.innerHTML=ajax.responseText;
        }
    }
}
function traerDatos2(tipoDato)
{
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa=document.getElementById("demoArr");
    // Creo el objeto AJAX
    var ajax=nuevoAjax();
    // Coloco el mensaje "Cargando..." en la capa
    capa.innerHTML="Cargando...";
    // Abro la conexión, envío cabeceras correspondientes al uso de POST y envío los datos con el método send del objeto AJAX
    ajax.open("POST", "controler.php?matriz=ok", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id="+tipoDato);

    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            // Respuesta recibida. Coloco el texto plano en la capa correspondiente
            capa.innerHTML=ajax.responseText;
        }
    }
}
</script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="alpaca.css" />
  <title></title>
</head>    
<body>
<br>
<p><span class="phpmaker">&nbsp;&nbsp;&nbsp;INCAUTADO
<br><br>
	<form name="formpatt" action="indexs.php" method="post">
            <input type="text" size="35"  name="text" id="text">
            <input type="submit" name="submit" value="BUSCAR">
            <BR><BR>
                <input type="text" name="text1" id="text1">
            <input type="submit" name="submit" value="Nuevo">
	<?php
        $sql = "select * from mensajes";
        $dat = mysql_query($sql);
        ?>		 
            <center>
			 <table class="ewTable" border = '1'>
			<tr  class="ewTableRow">
			<td class="ewTableHeader">ID</td>
			<td class="ewTableHeader">MSG_ENCRIPTADO</td>
            <td class="ewTableHeader">ACCIONES</td>
			
            
            <?php
            while($reglistpdf = @mysql_fetch_assoc($dat)){
?>
</tr>
            <tr  class="ewTableRow">
            <td><?php echo $reglistpdf ['ID'] ?></td>
            <td><?php echo $reglistpdf ['msg_encriptado'] ?></td>
            <td><a href = "#" onclick="traerDatos1(<?php echo $reglistpdf ['ID'] ?>)">DESENCRIPTARx</a>&nbsp;&nbsp;<a href = "#" onclick="traerDatos2(<?php echo $reglistpdf ['ID'] ?>)">VerMatrizx</a></td>
            </tr>
<?php
        }
            ?>
			</table>
			</center>

</form>
<div id="demoArr"></div>
</body>
</html>

<?php
function page_load(){
    if(!empty($_POST['submit']) AND $_POST['submit'] == "BUSCAR"){
        $valor = $_POST['text'];
        $resultado = buscar($valor);
        echo "<h6>Resultado buscar</h6><br>".$resultado;
    }
    if(!empty($_POST['submit']) AND $_POST['submit'] == "Nuevo"){
        $valor = $_POST['text1'];
        agregar($valor);
    }
}
?>