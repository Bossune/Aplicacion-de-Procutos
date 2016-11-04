<?php
	function Conectar(){
		$con = null;
		$host = 'localhost';
		$db = 'DAE_PRODUCTOS';
		$user = 'root';
		$pwd = 'root';

		try{
			$con = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
		}catch(PDOException $e){
			echo ":(Error al conectar a la base de datos ".$e;
			exit();
		}
		return $con;
	}
?>