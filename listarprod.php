<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
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
		table{
			text-align: center;
			border: 1px solid #D4D4D4;
			background-color: #F4F4F4;
		}
		#TablaBuscar{
			float: right;
			margin-top: 6em;
			margin-right: 5em;
		}
		#DivRegion{
			float: right;
			/*margin-left: 14.5em;*/
			margin-right: -18.9em;
			text-align: center;
			border: 1px solid #D4D4D4;
			background-color: #F4F4F4;
		}
		#SelectReg{
			width: 18.8em;
		}
	</style>
	<script>
		function Ajaxobt() {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xml=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xml=new ActiveXObject("Microsoft.XMLHTTP");
            }
            return xml;
        }
		function Enviando(x){
            var objx = Ajaxobt();
            objx.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById('TablaSelect').innerHTML = objx.responseText;
                }
            };
            if (x==1){
            	var n = document.getElementById('namep').value;
            	objx.open("GET","./ajax/buscarp.php?IDN=1&namep="+n,true);
            } else {
            	objx.open("GET","./ajax/buscarp.php?IDN=2&namereg="+x,true);
            }
            objx.send();
        }
	</script>
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
	<div>
	<!-- Este es el "Formulario" de busqueda que utliza la funcion Enviando a la cual se le implemento Ajax. -->
		<table id="TablaBuscar">
			<tr>
				<td>Buscar Producto:</td><td><input type="text" id="namep" name="namep"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="button" id="btnBus" onclick="Enviando(1)">Buscar</button></td>
			</tr>
		</table>
	</div>
	<div id='DivRegion'>
		<!-- Este trozo de PHP recupera los datos de la tabla region, y los carga dentro de un Select para poder vizualizarlos, tambien ocupa la funcion Enviando (Ajax) -->
		<?php 
			require './config/db.php';
			$cons1= "select id,nombre from region";
			$resp1 = $mysqli->query($cons1);
			
			echo "<label>Buscar por Region</label><br>";
			echo "<select id='SelectReg' name='reg' onchange='Enviando(this.value)'>";
			echo "<option value = 0>...</option>";
			while ($fila1 = $resp1->fetch_array(MYSQLI_BOTH)) {
				echo "<option value=".$fila1[id].">".$fila1[nombre]."</option>";
			}
			echo "</select>";
		?>
	</div>
	<div class="container">
		<?php
			$id_pd = $_GET["id_pd"];
			require './config/db.php';
			//Realizar consulta MySQL, seleccionando de las tablas Producto,Usuario y Comuna los atributos pedidos.
			$consulta = "select p.id,u.nombre,c.nombre,p.nombre,p.tipo_publicacion,p.disponible from producto p inner join usuario u on(p.id_usuario=u.id) inner join comuna c on(p.id_comuna=c.id) where p.id_categoria=$id_pd";
			//se guardan los registros obtenidos:
			$respuesta = $mysqli->query($consulta);
			//Ubicacion y orden para los registros obtenidos de la consulta en caso de los haya: se genera una tabla, donde la variable "row" sera una arreglo donde cada elemento sera un registro.
			echo "<table id='TablaSelect'>
			<tr>
			<th>Nombre Usuario  </th>
			<th>Comuna  </th>
			<th>Nombre Producto  </th>
			<th>Tipo Publicacion  </th>
			<th>Disponible  </th>
			<th>Detalle  </th>
			</tr>";
			while($row = mysqli_fetch_array($respuesta)) {
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
		?>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>