<?php

include '../cn.php';

$f1 = $_POST['f1'];
$f2 = $_POST['f2'];
$f3 = $_POST['f3'];
$f4 = $_POST['f4'];
$f5 = $_POST['f5'];
$f6 = $_POST['f6'];
$f7 = $_POST['f7'];
$f8 = $_POST['f8'];
$f9 = $_POST['f9'];
session_start();

if ($_POST['user']) {
     $user = $_POST['user'];
}else{
     $user = $_SESSION['key']['usuario'];
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "delete from contact where id = '$id'";
}else{

     if (isset($_POST['actualizar'])) {
          $id = $_POST['id'];
          $f10 = $_POST['f10'];
          $f11 = $_POST['f11'].';'.$_POST['notas'];
          $f12 = $_POST['f12'];
          $actividad = $_POST['actividad'];
          $ruta = $_POST['ruta'];
          $query = "update contact set fecha_lead = '$f9',nombre = '$f1', celular = '$f2',email = '$f3',marca = '$f4', vehiculo = '$f5', medio = '$f6', observacion = '$f7', banco='$f8',estado='$f10',seguimiento='$f11;',actividad='$actividad',ruta='$ruta',cumpleaños='$f12' where id='$id'";
     }else{
          if (isset($_POST['f1'])) {
               $query = "INSERT INTO contact(fecha_lead,nombre, celular,email,marca, vehiculo, medio, seguimiento, estado, usuario) 
               VALUES ('$f9','$f1', '$f2', '$f3','$f4', '$f5', '$f6','$f7;', 'En espera', '$user')";
          }
     }
   
     if (isset($_POST['act'])) {
          $desk = $_POST['inputValue'];
          $inputId = $_POST['inputId'];
          $inputFecha = $_POST['inputFecha'];
          $query = "INSERT INTO actividades(desk,user,idinput) VALUES('$desk','$user','$inputId')";
     }
     if (isset($_POST['date'])) {
          $desk = $_POST['inputValue'];
          $inputId = $_POST['inputId'];
          $query = "update actividades set fecha_actividad='$desk' where id='$inputId' ";
     }
     
     if(isset($_POST['changeow'])){
          $id = $_POST['id'];
          $query = "UPDATE contact set usuario = '$user' where id = '$id'";
     }
}


    
$r = mysqli_query($conn, $query);

if ($r) {
     $resultado['estado'] = 'success';
}else{
     $resultado['estado'] = 'error';
     $resultado['mensaje'] = 'Error en la consulta: ' . mysqli_error($conn);
}

?>