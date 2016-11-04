<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vende Todo</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
		#TablaVendedor{
			text-align: center;
			border: 1px solid #D4D4D4;
			background-color: #F4F4F4;
		}
		#a_VU{
			color: white;
			text-decoration: none;
		}
		#a_VU:hover{
			color:white;
		}
	</style>
</head>
<body>
	<div class="container">
			<br>
			<header>
				<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="./" class="navbar-brand">Vende Todo</a>
					</div>

					<div class="collapse navbar-collapse" id="navbar-1">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
									Categorias <span class="caret"></span>
								</a>
								<?php include('./ajax/categorias.php') ?>
							</li>
							<li><a href="">Favoritos</a></li>
						</ul>
            <?php if(isset($_SESSION['id'])){?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                  <?php echo $_SESSION['nombre'];?> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="./perfil.php?id=<?php echo $_SESSION['id'];?>">Mi Perfil</a></li>
                  <li><a href="./opciones.php">Opciones</a></li>
                  <li><a href="./logout.php">Cerrar Sesión</a></li>
                </ul>
              </li>
						</ul>
            <?php }else{?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./login.php" class="text-info"> Iniciar Sesión </a></li>
              <li><a href="./signup.php" class="text-info"> Registraté </a></li>
            </ul>
            <?php }?>
					</div>
				</div>
			</nav>
			</header>
	</div>
	<?php
		require './config/db.php';
		if($Idn2=$_GET["Idn2"]==1){
			$id_img = $_GET['id_img'];
			$consulta = "select i.url,p.nombre,p.id,p.precio from producto p inner join imagen_producto i on(i.id_producto=p.id) where i.id_producto=".$id_img;
			//se guardan los registros obtenidos:
			$respuesta = $mysqli->query($consulta);
			//Seccion que se visualiza en index.php, esta desordenado. La proxima vez sera mas comodo para la vista.
			$row = mysqli_fetch_array($respuesta);
			echo "<div class='container'>";
			echo "<div class='row'>";
			echo "<div class='col-md-4'>";
			//
			//se visualiza el nombre del producto.
			//
			echo "<h2>".$row[1]."</h2>";
			//
			//se visualiza la imagen del producto.
			//
			echo "<img src='".$row[0]."' class='img-rounded' height='325' width='370'>";
			echo "</div>";
			//
			//Cosas para rellenar.
			//
			echo "<div class='col-md-4'>";
			echo "<h3>Caracteristicas</h3>";
			echo "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
			echo "<button type='button' class='btn btn-success'><a id='a_VU' href='producto.php?Idn2=2&id_uno=".$row[2]."'>Contactar Usuario</a></button>";
			echo "</div>";
			echo "<div class='col-md-4'>";
			echo "<h3>Recomendaciones</h3>";
			echo "</div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<div class='col-md-4'>";
			echo "<table class='table'>";
			echo "<tr>
					<th>Precio</th>
					<th>Transaccion</th>
					<th>Codigo</th>
				</tr>";
			echo "<tr>
					<th>".$row[3]."</th>
					<th>venta/permuta</th>
					<th>123456789</th>
				</tr>";
			echo "</table>";
			echo "</div>";
			echo "<div class='clearfix visible-lg-block'></div>";
			echo "</div>";
			echo "</div>";
		} elseif ($Idn2=$_GET["Idn2"]==2){
			$id_uno=$_GET["id_uno"];
			$cons2="select u.nombre,u.email,c.nombre from usuario u inner join producto p on(u.id=p.id_usuario) inner join comuna c on(p.id_comuna=c.id) where p.id=".$id_uno;
			$Q = $mysqli->query($cons2);
			$Q1 = mysqli_fetch_array($Q);
			echo "<div class='container'>
			<table id='TablaVendedor'>
			<tr>
			<td>Vendedor:</td>
			<td>".$Q1[0]."</td>
			</tr>
			<tr>
			<td>Correo:</td>
			<td>".$Q1[1]."</td>
			</tr>
			<tr>
			<td>Comuna:</td>
			<td>".$Q1[2]."</td>
			</tr>
			</table>
			</div>";
		}	
	?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>