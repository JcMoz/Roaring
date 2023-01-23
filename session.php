<?php
if (!empty($_POST['correo']) and !empty($_POST['password'])) {
    $usuario=$_POST['correo'];
    $clave=$_POST['password'];
    //conectar a la base de datos 
    $conexion=mysqli_connect("localhost", "root", "", "roaring");
   // $conexion=mysqli_connect("localhost", "k240819_roaring", "adminroaring", "k240819_roaring");
    
    
    //mysqli_query($conexion, "INSERT INTO usuario(name,con) VALUES ('Mario','$clave')");
    //$consulta="SELECT * FROM usuario WHERE name = '$usuario'";
    $consulta = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo='$usuario' and tipo='cl'");
    
    if ($row = mysqli_fetch_array($consulta)) {
        $contra=$row['con'];
        if (password_verify($clave, $contra)) {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION["userId"]    = $row['id'];

            echo  $_SESSION["userId"];
    
            
           header("location:servicio_al_cliente.php?userId=".$row["id"]);  
        }else{
             
        }
    }else{
        header("location:index.php");  
    }
    
    }
?>