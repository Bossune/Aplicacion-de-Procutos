<?php
	require './config/db.php';
	$consulta = "select * from categoria";
	
	$respuesta = $mysqli->query($consulta);
	
	echo "<ul class='dropdown-menu' name='cat'>";
	while ($fila = $respuesta->fetch_array(MYSQLI_BOTH)) {
		echo "<a href='listarprod.php?id_pd=$fila[id]'><li value='$fila[id]'>$fila[nombre]</li></a>";
	}
	echo "</ul>";
?>