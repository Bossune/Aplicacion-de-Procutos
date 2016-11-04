<?php
    include "./config/db.php";
    $resultado = $mysqli->query("select * from imagen_producto where id_producto =".$_GET['id']);
    $row = $resultado   ->fetch_object();
    header("Content-type: image/jpeg");
    echo $row->imagen;
?>