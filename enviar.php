<?php
require('config/db.php');

$bandera = false;

if (!empty($_POST)) {
	
	$nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
	$comuna = mysqli_real_escape_string($mysqli,$_POST['comuna']);
	$categoria = mysqli_real_escape_string($mysqli,$_POST['categoria']);
	$tipo = mysqli_real_escape_string($mysqli,$_POST['tipoT']);
	$precio = mysqli_real_escape_string($mysqli,$_POST['precio']);
	$descripcion = mysqli_real_escape_string($mysqli,$_POST['descrip']);
    $imagen = addslashes(file_get_contents($_FILES['foto']['tmp_name']));


	$error = "";


	$sqlInsert = "INSERT INTO producto (id_usuario, id_comuna, id_categoria, nombre, descripcion, precio, tipo_publicacion) VALUES ('1', '$comuna', '$categoria', '$nombre', '$descripcion','$precio', '$tipo')";
    
    $resultNew = $mysqli->query($sqlInsert);
    
    $rs = mysql_query("SELECT @@identity AS id");
    if ($row = mysql_fetch_row($rs)) {
        $id = trim($row[0]);
        
        $sqlInsert2 = "INSERT INTO imagen_producto (id_prodcuto, imagen) VALUES ('$id', '$imagen')";
        
        $resultNew2 = $mysqli->query($sqlInsert2);
    }
	header("Location: index.php");
    

}

?>
