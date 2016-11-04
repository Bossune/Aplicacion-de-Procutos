<?php
	require '../config/db.php';
	if (($IDN = $_GET['IDN']) == 1){
		$namep = $_GET['namep'];
		$cons= "select p.id,u.nombre,c.nombre,p.nombre,p.tipo_publicacion,p.disponible from producto p inner join usuario u on(p.id_usuario=u.id) inner join comuna c on(p.id_comuna=c.id) where p.nombre='$namep'";
		$query = $mysqli->query($cons);
		
		echo "<table id='TablaSelect'>
		<tr>
		<th>Nombre Usuario</th>
		<th>Comuna</th>
		<th>Nombre Producto</th>
		<th>Tipo Publicacion</th>
		<th>Disponible</th>
		<th>Detalle</th>
		</tr>";
		while($row = mysqli_fetch_array($query)) {
		    echo "<tr>";
		    echo "<td>" . $row[1] . "</td>";
		    echo "<td>" . $row[2] . "</td>";
		    echo "<td>" . $row[3] . "</td>";
		    echo "<td>" . $row[4] . "</td>";
		    echo "<td>" . $row[5] . "</td>";
			echo "<td><a href='./producto.php?Idn2=1&id_img=".$row[0]."'><label value='".$row[0]."'> ? </label></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		$namereg = $_GET['namereg'];
		$CONS1 = "select p.id,u.nombre,c.nombre,p.nombre,p.tipo_publicacion,p.disponible from producto p inner join usuario u on(p.id_usuario=u.id) inner join comuna c on(p.id_comuna=c.id) inner join provincia pr on(c.id_provincia=pr.id) inner join region rg on(pr.id_region=rg.id) where rg.id=".$namereg;
		$query1 = $mysqli->query($CONS1);
		
		echo "<table id='TablaSelect'>
		<tr>
		<th>Nombre Usuario</th>
		<th>Comuna</th>
		<th>Nombre Producto</th>
		<th>Tipo Publicacion</th>
		<th>Disponible</th>
		<th>Detalle</th>
		</tr>";
		while($row = mysqli_fetch_array($query1)) {
		    echo "<tr>";
		    echo "<td>" . $row[1] . "</td>";
		    echo "<td>" . $row[2] . "</td>";
		    echo "<td>" . $row[3] . "</td>";
		    echo "<td>" . $row[4] . "</td>";
		    echo "<td>" . $row[5] . "</td>";
		    //
			//Linea Nueva 62: al hacer click en ella se cargan los detalles del producto seleccionado.
			//
			echo "<td><a href='producto.php?Idn2=1&id_img=".$row[0]."'><label value='".$row[0]."'> ? </label></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>