<?php
session_start();
 include_once "./conexion.php";
 $fromUser  = $_POST["fromUser"];
 $toUser    = $_POST["toUser"];
 $message   = $_POST["message"];



 $sms= "INSERT INTO message (fromUser,toUser,message)
        VALUES ('$fromUser','$toUser','$message')";
 $resultado = $conexion->query($sms);

 $update = "UPDATE usuario set new='new' WHERE id='".$fromUser."'";
 $conexion->query($update);

 if($resultado){
    $output .="";
 }else{
    $output .=" Error. Please try Again.";
 }
 echo $output;

?>