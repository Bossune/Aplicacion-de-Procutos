<?php
  function generateRandomString($length = 10) {
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  session_start();
  if(isset($_SESSION['id'])){
      require '../config/db.php';
      if ( 0 < $_FILES['file']['error'] ) {
          $arr = array('status' => 'error');
          header('Content-Type: application/json');
          echo json_encode($arr);
      }
      else {
          $info = getimagesize($_FILES['file']['tmp_name']);
          if ($info === FALSE) {
            $arr = array('status' => 'error');
            header('Content-Type: application/json');
            echo json_encode($arr);
          }
          elseif (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
            $arr = array('status' => 'error');
            header('Content-Type: application/json');
            echo json_encode($arr);
          }else{
            $url = generateRandomString(30) . $_FILES['file']['name'];
            $id = $_SESSION['id'];

            move_uploaded_file($_FILES['file']['tmp_name'], '../assets/images/users/'.$url);
            $mysqli->query("UPDATE usuario SET avatar = '$url' WHERE id = $id");
            $arr = array('status' => 'ok');
            header('Content-Type: application/json');
            echo json_encode($arr);
          }
      }
  }else{
    $arr = array('status' => 'error');
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
?>
