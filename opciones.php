<?php
  require './config/db.php';
  session_start();
  if(!isset($_SESSION['id'])){
    header('Location: ./');
    exit();
  }
  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vende Todo - Perfil</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" >
    <!-- Optional theme -->
    <link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="./assets/js/bootstrap.min.js"></script>
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
            <?php }?>
          </div>
        </div>
      </nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="text-center">
          <h4 class="text-uppercase">Opciones</h4>
          <hr/>
        </div>
        <div class="col-md-6 col-md-offset-1">
          <div class="panel panel-default">
            <h5 class="text-uppercase text-center" style="padding-top: 10px">Cambiar Contraseña</h5>
            <hr/>
            <div id="response" class="col-sm-10 col-sm-offset-1">

            </div>
            <div class="panel-body">
              <div class="form-group" id="div-pass">
                <label for="pass">Contraseña Actual:</label>
                <input type="password" class="form-control" id="pass" placeholder="Ingrese su contraseña..." >
                <span class="help-block" id="help-pass"></span>
              </div>
              <div class="form-group" id="div-pass1">
                <label for="pass">Contraseña Nueva:</label>
                <input type="password" class="form-control" id="pass1" placeholder="Ingrese su nueva contraseña..." >
                <span class="help-block" id="help-pass1"></span>
              </div>
              <div class="form-group" id="div-pass2">
                <label for="pass2">Repita Contraseña Nueva:</label>
                <input type="password" class="form-control" id="pass2" placeholder="Ingrese su nuevamente la contraseña...">
                <span class="help-block" id="help-pass2"></span>
              </div>
              <div class="form-group">
                <a href="#" class="btn btn-sm btn-block btn-primary" onclick="cambiarPassword()">Cambiar Contraseña</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <h5 class="text-uppercase text-center" style="padding-top: 10px">Cambiar imagen de Perfil</h5>
            <hr/>
            <div class="panel-body">
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="exampleInputFile">
                <p class="help-block">Example block-level help text here.</p>
              </div>
              <div class="form-group">
                <a href="#" class="btn btn-sm btn-block btn-primary" onclick="cambiarImage()">Cambiar Imagen</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/opciones.js"></script>
  </body>
</html>
