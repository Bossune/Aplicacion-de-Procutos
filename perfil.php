<?php
  require './config/db.php';
  session_start();
  if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $sql = "SELECT * FROM usuario where id = ".$_GET['id']."";
    $result = $mysqli->query($sql);
    $count = $result->num_rows;
    if($count != 1){
      $err = "Este usuario no existe";
    }else{
      $row = $result->fetch_array(MYSQLI_BOTH);
      $res = "SELECT b.nombre, b.avatar, a.descripcion, a.fecha FROM comentario a, usuario b where a.id_usuario_comentado = ".$_GET['id']." and a.id_usuario_comentando = b.id ORDER BY a.fecha DESC LIMIT 5";
      $result2 = $mysqli->query($res);
      $sqlNota = "SELECT avg(nota) as nota FROM valoracion where id_usuario_valorado = ".$_GET['id']."";
      $nota = $mysqli->query($sqlNota);
      $rowNota = $nota->fetch_array(MYSQLI_BOTH);
      $nn = "N.V";
      if($rowNota['nota'] != null){
        $nn = round($rowNota['nota'], 1);
      }
    }
  }else{
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
      <div class="row">
        <div class="col-md-3 text-center">
          <img src="./assets/images/users/<?php echo $row['avatar']; ?>" alt="" class="img-responsive img-rounded" />
          <hr/>
          <h4 class="text-uppercase"><?php echo $row['nombre']; ?></h4>
          <h1 id="nota-v"><?php echo $nn; ?></h1>
          <?php if($nn == "N.V"){ ?>
          <p style="margin-top: -10px"><small id="nota-t">(No Valorado)</small></p>
          <?php }else{ ?>
          <p style="margin-top: -10px"><small id="nota-t">Nota de Valoración</small></p>
          <?php }?>
          <p id="response-nota"></p>
          <?php if(isset($_SESSION['id']) && $_SESSION['id'] != $_GET['id']){ ?>
          <button class="btn btn-xs btn-primary btn-block" data-toggle="modal" data-target="#myModal">Valorar a este usuario</button>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <?php if(isset($_SESSION['id']) && $_SESSION['id'] != $_GET['id']){ ?>
          <h6 class="text-uppercase text-muted">Dejar una reseña</h6>
          <div class="form-group" id="div-comentario">
            <textarea class="form-control" rows="3" id="comentario" placeholder="Escribe una reseña..."></textarea>
            <small id="comentarioHelp" class="form-text text-danger"></small>
            <a style="margin-top: 10px;" href="#" onclick="enviarComentario(<?php echo $_GET['id']; ?>)" class="btn btn-default btn-block btn-sm">Publicar reseña</a>
          </div>
          <hr/>
          <?php } ?>
          <?php
            $count2 = $result2->num_rows;
            if($count2 > 0){ ?>
          <h6 class="text-uppercase text-muted">Reseñas sobre <?php echo $row['nombre']; ?></h6>
          <ul class="media-list" id="ul-comentarios">
            <?php
              while ($row2 = $result2->fetch_assoc()) {
              ?>
            <hr/>
            <li class="media">
              <div class="media-left">
                <a href="#">
                <img class="media-object img-rounded" src="./assets/images/users/<?php echo $row2['avatar']; ?>" width="48px">
                </a>
              </div>
              <div class="media-body">
                <h5 class="media-heading"><?php echo $row2['nombre']; ?> <small class="text-muted pull-right"><?php echo $row2['fecha']; ?></small></h5>
                <p><?php echo $row2['descripcion']; ?></p>
              </div>
            </li>
            <?php }?>
            <hr/>
          </ul>
          <?php if($count2 == 5){
            echo '<a href="#" class="btn btn-sm btn-block btn-primary">Cargar mas reseñas</a>';
            }?>
          <?php }else{ ?>
          <ul class="media-list" id="ul-comentarios">
            <div class="alert alert-info" id="sin-rese">
              <strong>Sin reseñas!</strong> Este usuario no tiene reseñas
            </div>
            <hr/>
          </ul>
          <?php }?>
        </div>
        <div class="col-md-3">
          <br/>
          <h6 class="text-uppercase text-muted">Algunos productos de <?php echo $row['nombre']; ?></h6>
          <hr/>
          <div class="thumbnail">
            <img src="https://www.disfruting.es/media/product/f1f/televisor-telefunken-tv-domus-48dsm-led-full-hd-48-smart-tv-wifi-c67.jpg" class="img-responsive" alt="...">
            <div class="caption">
              <h4>Smart TV Led Full HD 48"</h4>
              <p>Venta/Intercambio</p>
              <p><a href="#" class="btn btn-primary btn-xs" role="button">Ver producto</a></p>
            </div>
          </div>
          <div class="thumbnail">
            <img src="https://cdn1.macworld.co.uk/cmsdata/features/3605337/macbookair11_lifestyle_15_thumb800.jpg" class="img-responsive" alt="...">
            <div class="caption">
              <h4>Macbook Air 13"</h4>
              <p>Venta</p>
              <p><a href="#" class="btn btn-primary btn-xs" role="button">Ver producto</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if(isset($_SESSION['id']) && $_SESSION['id'] != $_GET['id']){ ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close"
              data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Valorando a un usuario...
            </h4>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form class="form-horizontal" role="form">
              <div class="form-group" id="div-nota">
                <div class="col-sm-8 col-sm-offset-2">
                  <input type="number" class="form-control" id="nota" placeholder="Ej: 7" style="font-size: 72px; height: 100px;"/>
                  <p class="help-block" id="help-nota">Es necesario ingresar un numero entre 1 y 7 sin decimales</p>
                  <p class="help-block"><strong>NOTA: </strong>Solo contaremos la ultima valoración que ingreses, de modo que no puedes valorar a un mismo usuario con 2 notas.</p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="button" class="btn btn-primary btn-block" onclick="sendValoration(<?php echo $_GET['id'];?>)">Enviar Valoración</button>
                </div>
              </div>
            </form>
          </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            <div class="col-sm-6 col-sm-offset-3">
              <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="./assets/js/comentario.js"></script>
    <script src="./assets/js/valoracion.js"></script>
  </body>
</html>
