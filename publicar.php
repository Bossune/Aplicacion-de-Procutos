<?php
	require './config/db.php';
	session_start();
	if(!isset($_SESSION['id'])){
		header('Location: ./');
		exit();
	}
	$categorias = $mysqli->query("SELECT * FROM categoria");
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
</head>
<body>

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
							<ul class="dropdown-menu">
								<?php
								while ($rowC = $categorias->fetch_assoc()) { ?>
								<li><a href="./Busqueda.php?categorias=<?php echo $rowC['id'];?>"><?php echo $rowC['nombre_categoria'];?></a></li>
								<?php } ?>
							</ul>
						</li>
					</ul>
					<?php if(isset($_SESSION['id'])){?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
							<?php echo $_SESSION['nombre'];?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="./perfil.php?id=<?php echo $_SESSION['id'];?>">Mi Perfil</a></li>
								<li><a href="./publicar.php">Publicar</a></li>
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
	<div class="container">
		<br>
		<div class="row">
		    <div class="col-md-10 col-md-offset-1">
		        <div id="alerta">

		        </div>
		    </div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="form-horizontal" action="enviar.php" id="Fproducto" name="Fproducto" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="Nombre" class="control-label col-md-2">Nombre:</label>
						<div class="col-md-8">
							<input type="text" name="nombre" placeholder="Nombre" class="form-control" id="nombrep">
						</div>
					</div>

					<div class="form-group">
						<label for="option" class="control-label col-md-2">Comuna:</label>
						<div class="col-md-8">
							<select class="form-control" name="comuna">
								<?php
								    require('config/conexionPDO.php');
                                    $conn = Conectar();
                                    $sql = "SELECT id, nombre FROM comuna";
                                    $stmt = $conn->prepare($sql);
                                    $result = $stmt->execute();
                                    $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
                                    foreach($rows as $row){
                                        ?>
                                        <option value="<?php print($row->id); ?>"><?php echo utf8_encode($row->nombre); ?></option>
                                        <?php
                                    }

								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="option" class="control-label col-md-2">Categoria:</label>
						<div class="col-md-8">
							<select class="form-control" name="categoria">
								<?php
                                    $sql = "SELECT id, nombre_categoria FROM categoria";
                                    $stmt = $conn->prepare($sql);
                                    $result = $stmt->execute();
                                    $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
                                    foreach($rows as $row){
                                        ?>
                                        <option value="<?php print($row->id); ?>"><?php echo utf8_encode($row->nombre_categoria); ?></option>
                                        <?php
                                    }

								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="option" class="control-label col-md-2">Tipo de transaccion</label>
						<div class="col-md-8">
							<select class="form-control" name="tipoT">
								<option>venta</option>
								<option>trueque</option>
								<option>venta/trueque</option>
							</select>
						</div>
					</div>

                    <div class="form-group">
						<label for="precio" class="control-label col-md-2">Precio:</label>
						<div class="col-md-8">
							<input type="text" name="precio" placeholder="Precio" class="form-control" id="precio">
						</div>
					</div>

					<div class="form-group">
						<label for="Descripcion" class="control-label col-md-2">Descripcion:</label>
						<div class="col-md-8">
							<textarea class="form-control" placeholder="Describe tu producto" name="descrip" id="descrip"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="foto" class="control-label col-md-2">Foto:</label>
						<div class="col-md-8">
							<input type="file" name="foto">
							<p class="help-block">Maximo 50MB</p>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button class="btn btn-primary" type="button" onclick="validar()">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
        function validarN(){
            var valor = document.getElementById("nombrep").value;
				if (valor == null || valor == "" || /^\s+$/.test(valor)) {
					alert("falta llenar nombre");
					return false;
				}else{
					return true;
				}
        }

        function validarP(){
            var valor = document.getElementById("precio").value;
				if (valor == null || valor == "" || /^\s+$/.test(valor)) {
					alert("falta llenar precio");
					return false;
				}else{
					return true;
				}
        }
        function validarD(){
            var valor = document.getElementById("descrip").value;
				if (valor == null || valor == "" || /^\s+$/.test(valor)) {
					alert("falta llenar descripcion");
					return false;
				}else{
					return true;
				}
        }

        function validar(){
            if (validarN() && validarP() && validarD()){
                document.Fproducto.submit();
            }
        }
    </script>
</body>
</html>
