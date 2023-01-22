<?php
session_start();
include_once "./conexion.php";

$query = "SELECT*FROM usuario WHERE id='".$_SESSION["userId"]."'";
$result = $conexion->query($query);
        $row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>RoaringForkCleaningService</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/roaring.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <p>hi <?php echo $row["name"];?></p>
                <input type="text" id="fromUser" value="<?php echo $row["id"];?>" hidden />
                <p>Send message to: </p>
                <ul>
                    <?php
                    include_once "./conexion.php";
                    $sms= "SELECT*FROM usuario";
                    $resultado = $conexion->query($sms);
                            while($msj = $resultado->fetch_assoc()){
                                echo '
                                <li><a href=?toUser='.$msj["id"].'>'.$msj["name"].'
                                </a>
                                </li>
                                ';
                            }
                    
                    ?>

                </ul>
                <a href="chat.php"><--- Back</a>

            </div>
            <div class="col-md-4">
                <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h4>
                                        <?php
                                        if(isset($_GET["toUser"])){
                                            $userName= "SELECT*FROM usuario WHERE id='".$_GET["toUser"]."'";
                                            $re = $conexion->query($userName);
                                            $uName = $re->fetch_assoc();
                                            echo '<input type="text" value='.$_GET["toUser"].' id="toUser" hidden/>' ;
                                            echo $uName["name"];        
                                        }else{
                                            $userName= "SELECT*FROM usuario";
                                            $re = $conexion->query($userName);
                                            $uName = $re->fetch_assoc();
                                            $_SESSION["toUser"]= $uName["id"];
                                            echo '<input type="text" value='.$_SESSION["toUser"].' id="toUser" hidden/>' ;
                                            echo $uName["name"];   

                                        }
                                        ?>

                                    </h4>
                            </div>
                            <div class="modal-body" id="msgBody" style="height: 400px; overflow-y: scroll; overflow-x: hidden;">
                            <?php
                            if(isset($_GET["toUser"]))
                            $chats= "SELECT*FROM message WHERE (fromUser='".$_SESSION["userId"]."' AND toUser = '".$_GET["toUser"]."') OR (fromUser='".$_GET["toUser"]."' AND toUser = '".$_SESSION["userId"]."')"; //$reChat = $conexion->query($chats);    
                            else
                            $chats= "SELECT*FROM message WHERE (fromUser='".$_SESSION["userId"]."' AND toUser = '".$_SESSION["toUser"]."') OR (fromUser='".$_SESSION["toUser"]."' AND toUser = '".$_SESSION["userId"]."')";
                            $reChat = $conexion->query($chats);
                                while($chat = $reChat->fetch_assoc()){
                                    if($chat["fromUser"] == $_SESSION["userId"])
                                    echo"<div style='text-align:right;'>
                                        <p style='background-color:lightblue; word-wrap:break-word; display:inline-block;
                                        padding: 5px; border-radius:10px; max width: 70px;'>
                                            ".$chat["message"]."
                                        </p>
                                    </div>";
                                    else
                                    echo"<div style='text-align:left;'>
                                    <p style='background-color:yellow; word-wrap:break-word; display:inline-block;
                                    padding: 5px; border-radius:10px; max width: 70px;'>
                                        ".$chat["message"]."
                                    </p>
                                    </div>";
                                }
                            ?>
                            </div>
                            <div class="modal-footer">
                                <textarea id="message" class="form-control" style="height: 60px;"></textarea>
                                <button id="send" class="btn btn-primary" style="height: 70%;">Send</button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">


            </div>
            
        </div>

    </div>
    
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $("#send").on("click",function(){
            $.ajax({
                url:"insertarMessage.php",
                method: "POST",
                data:{
                    fromUser: $("#fromUser").val(),
                    toUser: $("#toUser").val(),
                    message: $("#message").val()
                },
                dataType:"text",
                success:function(data){
                    $("#message").val("");
                }


            });

        });
        setInterval(function(){
            $.ajax({
                url:"realTimeChat.php",
                method:"POST",
                data:{
                    fromUser:$("#fromUser").val(),
                    toUser:$("#toUser").val()
                },
                dataType:"text",
                success:function(data){
                    $("#msgBody").html(data);
                }

            });

        });
    });

</script>
</html>