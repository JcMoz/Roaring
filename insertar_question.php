<?php
session_start();
 include_once "./conexion.php";
 $name  = $_POST["name"];
 $correo  = $_POST["correo"];
 $message    = $_POST["message"];
 
 $sms= "INSERT INTO question (correo,question,name)
        VALUES ('$correo','$message','$name')";
 $resultado = $conexion->query($sms);



 if($resultado){

    require_once("./PHP-correo/PHPMailer/clsMailer.php");

    $mailSend = new clsMailer();

    $bodyHTML ='
    <h2>Hola '.$name.', you have asked a question in
    Roaring Fork Cleaning Service, the administrator will contact and respond via email</h2>
    <br>
    <br>
    <br>
    Thanks for writing us';


    $enviado = $mailSend->metEnviar("Question asked","Web page user",$correo,"Question asked",$bodyHTML);

    if($enviado){
        echo ("enviado");
    }else{
        echo ("No se puede enviar el correo");
    }

    
   
 }else{
   
 }


?>