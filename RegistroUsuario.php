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
            <h2 class="section-heading text-uppercase">Welcome thank you for signing up to Roaring ForkCleaning Service</h2>
            
            <h3 class="section-subheading text-muted">Fill in the fields</h3>
        </div>
        <div class="row text-center">
        <div class="col-md-4"></div>
            <div class="col-md-4">
               
            <form action="insertarUsuario.php" id="f1" method="POST">
                 <div class="row align-items-stretch mb-5">
                      <div class="col-md-10">
                      <div id="msg"></div>
 
                <!-- Mensajes de Verificación -->
                <div id="error"></div>
                      <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control"  name="name" type="text" placeholder="Your user name *"  />
                                              
                        </div>
                        <br>
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control"  name="correo" type="email" placeholder="Your email *"  />
                                              
                        </div>
                        <br>
                        <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="pass1"  name="password" type="password" placeholder="Your Password *"  />
                        </div>
                        <br>
                        <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="pass2" name="password2" type="password" placeholder="confirm password*"  />
                        </div>
                                                
                        </div>
                                           
                        </div>

                    <!-- Submit Button-->
                    <div class="text-center">
                         <input type="submit" name="g" class="btn btn-success text-uppercase" id="back"  value="Back"/>
                        <input type="submit" name="g" class="btn btn-primary text-uppercase" id="save"  value="Save"/>
                    </div>

            </form>
               
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
        document.getElementById('save').disabled = true;

        let $select = $('#error');
        $select.empty();

       

        $( "#pass2" ).keyup(function() {
            let clave1 = document.getElementById("pass1").value;
            let clave2 = document.getElementById("pass2").value;
        $select.empty();


            if (clave1 == clave2) {
                document.getElementById('save').disabled = false;
                
                $select.append('<div id="ok" class="alert alert-success" role="alert">Correct passwords </div>');
            
            } else {
                document.getElementById('save').disabled = true;
                $select.append('<div id="ok" class="alert alert-danger" role="alert"> Wrong passwords </div>');

            }
        


         
            });


        
    });

</script>

<?php
include_once "./Plantilla/fin.php"
?>