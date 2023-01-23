<?php
session_start();
 include_once "./conexion.php";
 $name  = $_POST["name"];
 $correo    = $_POST["correo"];
 $con   = $_POST["pass2"];
 $tipo="cl";
 $clave =  password_hash($con, PASSWORD_DEFAULT);


 $sms= "INSERT INTO usuario (name,con,correo,tipo)
        VALUES ('$name','$clave','$correo','$tipo')";
 $resultado = $conexion->query($sms);

 if($resultado){header("location:index.php");}
 

?>