<?php

include "conexion.php";
include "controler.php";
page_load();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="jquery.js"></script> 
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
            <td><a href = "indexs.php?decode=ok&id=<?php echo $reglistpdf ['ID'] ?>">DESENCRIPTAR</a>&nbsp;&nbsp;<a href = "indexs.php?matriz=ok&id=<?php echo $reglistpdf ['ID'] ?>">VerMatriz</a></td>
            </tr>
<?php
        }
            ?>
			</table>
			</center>
</form>

</body>
</html>

<?php
function page_load(){
    if(!empty($_POST['submit']) AND $_POST['submit'] == "BUSCAR"){
        $valor = $_POST['text'];
        $resultado = buscar($valor);
        echo "<h6>Resultado buscar</h6><br>".$resultado;
    }
    if(!empty($_GET['decode']) AND $_GET['decode'] == "ok"){
        $valor = $_GET['id'];
        $resultado1 = decodificar($valor);
        echo "<h6>Resultado decodificar</h6><br>".$resultado1;
    }
    if(!empty($_GET['matriz']) AND $_GET['matriz'] == "ok"){
        $valor = $_GET['id'];
        $resultado2 = matriz($valor);
        $dim = count($resultado2);
        echo "<h6>Resultado matriz</h6><br>";
        for($i = 0; $i<=$dim-1; $i++){
            for($j = 0; $j<=$dim-1; $j++){
                echo $resultado2[$i][$j];
                //echo $valf;
            }
            echo "<br>";
        } 
    }
    if(!empty($_POST['submit']) AND $_POST['submit'] == "Nuevo"){
        $valor = $_POST['text1'];
        agregar($valor);
    }
}
?>