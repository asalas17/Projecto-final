<?php
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<!-- Page Content -->
<div class="container px-4 px-lg-5">
    <!-- Heading Row -->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62732.63801983448!2d-85.27050207832029!3d10.6734116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f755c029f4b3dfb%3A0x81f096afc50be4e3!2sSalon%20Comunal%20de%20Fortuna!5e0!3m2!1ses!2scr!4v1752210073999!5m2!1ses!2scr"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <!-- <img class="img-fluid rounded mb-4 mb-lg-0" src="https://dummyimage.com/900x400/dee2e6/6c757d.jpg" alt="..." /> -->

        </div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">Feria #1 - La Fortuna</h1>
            <p>Asoc. De Productores Agrícolas San Carlos y Zarcero</p>
            <a class="btn btn-primary" href="#!">Inscribirse</a>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="card text-white bg-outline-secondary my-5 py-4 text-center">
        <div class="card-body">
            <h4 class="text-black m-0">En esta sección podrás ver los distintos productores que estarán en esta feria y sus productos.</h4>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Productor de café</h5>
                    <p class="card-text">Somos una familia productora de café originaria de La Fortuna, San Carlos. Aseguramos calidad y muchos productos de distintos precios y calidades. Ademas de postres en base a café que te van a sorprender!</p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary btn-sm" href="#!">Ver todos los productos</a>
                </div>
            </div>
        </div>  
    </div>
</div>



<?php
include(__DIR__ . '/../templates/footer.php');
?>