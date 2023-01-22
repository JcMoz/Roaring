<?php
include_once './Plantilla/cabecera.php';
session_start();
include_once "./conexion.php";

if(isset($_GET["userId"])){
    $_SESSION["userId"]=$_GET["userId"];
    header("location: Servicio_al_cliente.php");
}

$query = "SELECT*FROM usuario WHERE id='".$_SESSION["userId"]."'";
$result = $conexion->query($query);
        $row = $result->fetch_assoc();
        //echo $_SESSION["userId"];

        
?>

<!-- Masthead-->
<header class="masthead" style="padding-top: 10px;">
    <div class="container">
        <!-- <div class="masthead-subheading">Welcome To!</div>-->
        <div class="masthead-heading">Welcome To!</div>

    </div>
</header>

<!-- Services-->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">welcome <?php echo $row["name"];?>  to customer service chat</h2>
            <input type="text" id="fromUser" value="<?php echo $row["id"];?>" hidden />
            <h3 class="section-subheading text-muted">Select an employee of our customer service</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <?php

                include_once './conexion.php';
                $query = "SELECT*FROM usuario WHERE tipo='ad'";
                $result = $conexion->query($query);
                while ($row = $result->fetch_assoc()) {
                ?>

                    <div class="col-md-4">
                        <div class="team-member2">
                            <img class="mx-auto rounded-circle" src="./assets/user.png" alt="">
                            <p class="text-muted"><a href="?toUser=".<?php $row["id"]?>> <?php echo $row['name'] ?></a></p>
                        </div>
                    </div>
                <?php } ?>
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
                                <textarea id="message" class="form-control" placeholder="Write your message" style="height: 60px;"></textarea>
                                <button id="regresar" class="btn btn-success" style="height: 70%;">Back</button>
                                <button id="send" class="btn btn-primary" style="height: 70%;">Send</button>
                                
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<hr>


<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase"></h2>
            <h3 class="section-subheading text-muted">Our incredible team, happy to serve you</h3>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle mediana" src="assets/img/team/mario.jpg" alt="..." />
                    <h4>Mario Orellana</h4>
                    <p class="text-muted">owner</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/profile.php?id=100087215981075&is_tour_completed=true" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/team/juan.png" alt="..." />
                    <h4>Juan Moz</h4>
                    <p class="text-muted">Collaborator</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/profile.php?id=100087215981075&is_tour_completed=true" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">A pleasure to serve you and provide you with our general cleaning services</p>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

</section>
<!-- Clients-->
<div class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-sm-6 my-3">
                <!--<a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>-->
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <!-- <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>-->
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="https://www.facebook.com/profile.php?id=100087215981075&is_tour_completed=true"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <!-- <a href="#!"><img class="img-fluid img-bra nd d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>-->
            </div>
        </div>
    </div>
</div>

<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Copyright &copy; Roaring Fork Cleaning Service 2022</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/profile.php?id=100087215981075&is_tour_completed=true" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>

            </div>
            <div class="col-lg-4 text-lg-end">

            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function(){
        $("#regresar").on("click",function(){
            window.location.href = "index.php";
            
        });

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


<?php
include_once "./Plantilla/fin.php"
?>