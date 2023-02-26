<?php
session_start();
include_once './Plantilla/cabecera.php';
include_once './Plantilla/menu.php';

?>

<!-- Masthead-->
<header class="slider">
    <img src="./carousel/img/colorado1.jpg">
    <img src="./carousel/img/colorado2.jpg">
    <img src="./carousel/img/colorado3.jpg">

    <img src="./carousel/img/puente.jpg">
    <img src="./carousel/img/jardin.jpg">
    <img src="./carousel//img/puente.jpg">

</header>
<style>
    .carousel-item {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;

    }
</style>

<!-- Services-->
<section class="page-section" id="services">
    <div class="row justify-content-md-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="container">
                    <div class="text-center">
                        <h2 class="section-heading text-uppercase">Our Service</h2>
                        <h3 class="section-subheading text-muted">These are the services we provide</h3>
                    </div>
                    <div class="row text-center">
                        <!--<div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa-solid fa-handshake fa-stack-1x fa-inverse"></i>

                </span>
                <h4 class="my-3">On Time Cleaning</h4>
                <p class="text-muted">Our service always on time and efficient!</p>
            </div>-->
                        <?php
                        include_once './conexion.php';
                        $query = "SELECT*FROM service WHERE estado='Activo'";
                        $result = $conexion->query($query);
                        while ($row = $result->fetch_assoc()) {
                        ?>

                            <div class="col-md-4">
                                <div class="team-member">
                                    <img class="mx-auto rounded-circle mediana" src="data:image/jpg;base64,<?php echo base64_encode($row['image']); ?>" alt="">

                                    <h4 class="my-3"><?php echo $row['name_service'] ?></h4>
                                    <p class="text-muted">Description: <?php echo $row['description'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                        <!--<div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa-solid fa-truck fa-stack-1x fa-inverse"></i>

                </span>
                <h4 class="my-3">Moving Cleaning</h4>
                <p class="text-muted">We come to the comfort of your home!</p>
            </div>-->
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<hr>

<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Services performed</h2>
            <h3 class="section-subheading text-muted">Services rendered to our clients!</h3>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-10 col-sm-12 mb-2">
                <div id="carouselExampleDark" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <?php
                        $query = "SELECT*,ROW_NUMBER() OVER(ORDER BY id ASC) AS fila FROM performed WHERE estado='Activo'";
                        $result = $conexion->query($query);
                        while ($ok = $result->fetch_assoc()) {
                            if ($ok['fila'] == 1) {
                        ?>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $ok['fila'] - 1 ?>" class="active" aria-current="true" aria-label="Slide <?php echo $ok['fila'] - 1 ?>"></button>
                            <?php } else { ?>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $ok['fila'] - 1 ?>" aria-label="Slide <?php echo $ok['fila'] - 1 ?>"></button>
                        <?php }
                        } ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $query = "SELECT p. descripcion, p.image, p.cliente,s.name_service,ROW_NUMBER() OVER(ORDER BY p.id ASC) AS fila FROM performed p INNER join service s on p.id_servicio=s.id WHERE p.estado='Activo'";
                        $result = $conexion->query($query);
                        while ($ok = $result->fetch_assoc()) {
                            if ($ok['fila'] == 1) {
                        ?>
                                <div class="carousel-item active" data-bs-interval="5000">
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($ok['image']); ?>" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Service name: <?php echo $ok['name_service'] ?></h5>
                                        <p>Description: <?php echo $ok['descripcion'] ?></p>
                                        <h5>Customer: <?php echo $ok['cliente'] ?></h5>

                                    </div>
                                </div>
                            <?php } else { ?>

                                <div class="carousel-item" data-bs-interval="2000">
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($ok['image']); ?>" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Service name: <?php echo $ok['name_service'] ?></h5>
                                        <p>Description: <?php echo $ok['descripcion'] ?></p>
                                        <h5>Customer: <?php echo $ok['cliente'] ?></h5>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>


        </div>
    </div>
</section>

<!--SECCION DE PREGUNTAS-->
<section class="page-section" id="questions">
    <div class="row justify-content-md-center">
        <div class="col-md-10 ">
            <div class="card">

                <div class="container mt-2">
                    <div class="text-center">

                        <h2 class="section-heading text-uppercase text-primary">Questions</h2>
                        <h3 class="section-subheading text-muted text-primary">You can ask your questions in this section or use our chat</h3>

                    </div>

                    <form id="">
                        <div class="row">
                            <div class="row align-items-stretch mb-5">
                                <div class="col-md-3"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- Name input-->
                                        <input class="form-control" id="name" type="text" placeholder="Your Name *" autocomplete="off" />

                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-stretch mb-5">
                                <div class="col-md-3"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- Name input-->
                                        <input class="form-control" id="correo-question" type="email" placeholder="Your email *" onkeyup="validarEmail(this)" autocomplete="off" />
                                        <p id="resultado"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-stretch mb-2">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-textarea mb-md-0">
                                        <!-- Message input-->
                                        <textarea class="form-control" id="message-question" placeholder="Your question *" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button-->
                            <div class="text-center mt-2">
                                <button class="btn btn-success" id="send_question" type="button">Send</button>
                            </div>

                        </div>

                    </form>
                    <!--BOTON DEL CHAT-->
                    <a data-bs-toggle="modal" href="#chat" class="btn-flotante"> <i class="fas fa-comments"></i></a>
                    <!--FIN BOTON DE CHAT-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--SECCION DE PREGUNTAS FIN-->

<hr>
<!-- About-->
<!--<section class="page-section" id="about">
                <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2015</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2020</h4>
                                <h4 class="subheading">Phase Two Expansion</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>-->
<!-- Team-->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
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
                <!-- <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>-->
            </div>
        </div>
    </div>
</div>
<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">

            <h2 class="section-heading text-uppercase text-primary">Appointment</h2>
            <h3 class="section-subheading text-muted text-primary">Book your appointment here!</h3>

        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                </div>
            </div>
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage">
                <div class="text-center text-danger mb-3">Error sending message!</div>
            </div>
            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send</button></div>
        </form>
        <!--BOTON DEL CHAT-->
        <a data-bs-toggle="modal" href="#chat" class="btn-flotante"> <i class="fas fa-comments"></i></a>
        <!--FIN BOTON DE CHAT-->
    </div>
</section>
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
<!-- Portfolio Modals-->
<!-- Portfolio item 1 modal popup-->
<div class="modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img style="width: 20px; float:right; margin-right: 10px; margin-top: 10px;" src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Pantry Cleaning</h2>
                            <p class="item-intro text-muted">Cleaning</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/pantry.jpg" alt="..." />
                            <p>cleaning carried out in the pantry of our clients</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>Client:</strong>
                                    Mario Orellana
                                </li>
                                <li>
                                    <strong>Category:</strong>
                                    Pantry Cleaning
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio item 2 modal popup-->
<div class="modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img style="width: 20px; float:right; margin-right: 10px; margin-top: 10px;" src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Office</h2>
                            <p class="item-intro text-muted">Cleaning</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/oficina.jpg" alt="..." />
                            <p>office cleaning done by our cleaning group!</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>Client:</strong>
                                    Mario Orellana
                                </li>
                                <li>
                                    <strong>Category:</strong>
                                    Office Cleaning
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Portfolio item 3 modal popup-->
<div class="modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img style="width: 20px; float:right; margin-right: 10px; margin-top: 10px;" src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Family Room</h2>
                            <p class="item-intro text-muted"></p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/family.jpg" alt="..." />
                            <p>family room cleaning!</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>Client:</strong>
                                    Mario Orellana
                                </li>
                                <li>
                                    <strong>Category:</strong>
                                    Family Room
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--MODAL CHAT -->
<div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img style="width: 20px; float:right; margin-right: 10px; margin-top: 10px;" src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <p><a href="RegistroUsuario.php">click if you still do not have a chat account</a></p>

                                </div>
                                <div class="col-lg-10">
                                    <form action="session.php" method="POST">
                                        <div class="row align-items-stretch mb-5">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <!-- Name input-->
                                                    <input class="form-control" name="correo" type="email" placeholder="Your email *" />

                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <!-- Email address input-->
                                                    <input class="form-control" name="password" type="password" placeholder="Your Password *" />
                                                </div>

                                            </div>

                                        </div>

                                        <!-- Submit Button-->
                                        <div class="text-center"><input type="submit" name="g" class="btn btn-primary text-uppercase" id="chatButton" value="Send" /></div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FIN MODAL CHAT-->

<script type="text/javascript">
    function validarEmail(elemento) {

        var texto = document.getElementById(elemento.id).value;
        var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if (!regex.test(texto)) {
            document.getElementById("resultado").innerHTML = "Correo invalido";
            $('#resultado').addClass('alert alert-danger');
            document.getElementById('send_question').disabled = true;

        } else {
            document.getElementById("resultado").innerHTML = "";
            $('#resultado').removeClass('alert alert-danger');
            document.getElementById('send_question').disabled = false;

        }

    }
    $(document).ready(function() {



        $("#send_question").on("click", function() {
            if (
                $("#name").val() == "" ||
                $("#correo-question").val() == "" ||
                $("#message-question").val() == ""

            ) {
                Swal.fire({
                    icon: "error",
                    title: "error",
                    text: "Empty fields",
                });
            } else {

                $.ajax({
                    url: "insertar_question.php",
                    method: "POST",
                    data: {
                        name: $("#name").val(),
                        correo: $("#correo-question").val(),
                        message: $("#message-question").val()
                    },
                    dataType: "text",
                    success: function(data) {
                        Swal.fire({
                            icon: "success",
                            title: "Question done correctly",
                            text: "Your answer will be sent to your email",
                        });
                        $("#correo-question").val("");
                        $("#message-question").val("");

                    }


                });
            }
        });


    });
</script>


<?php
include_once "./Plantilla/fin.php"
?>