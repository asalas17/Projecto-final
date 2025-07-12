<?php
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<!-- Page Content -->
<div class="container px-4 px-lg-5">

    <!-- Heading Row -->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="rounded shadow overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62732.63801983448!2d-85.27050207832029!3d10.6734116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f755c029f4b3dfb%3A0x81f096afc50be4e3!2sSalon%20Comunal%20de%20Fortuna!5e0!3m2!1ses!2scr!4v1752210073999!5m2!1ses!2scr"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div class="col-lg-5">
            <h1 class="fw-bold text-success mb-3">
                <i class="bi bi-shop"></i> Feria La Fortuna
            </h1>
            <p class="text-muted mb-4">
                Asoc. de Productores Agrícolas de San Carlos y Zarcero. Disfrutá de productos frescos, locales y de calidad excepcional en un ambiente familiar.
            </p>
            <a class="btn btn-success btn-lg" href="#!">
                <i class="bi bi-pencil-square"></i> Inscribirse
            </a>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="card bg-success bg-opacity-10 my-5 py-4 text-center border-0 shadow-sm">
        <div class="card-body">
            <h4 class="text-success m-0">
                <i class="bi bi-megaphone"></i> En esta sección podrás ver los productores participantes y sus productos destacados.
            </h4>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100 shadow border-0">
                <div class="card-body">
                    <h5 class="card-title text-success fw-bold">
                        <i class="bi bi-cup-hot"></i> Productor de café
                    </h5>
                    <p class="card-text text-muted">
                        Somos una familia productora de café en La Fortuna, San Carlos. Calidad garantizada y postres en base a café que te van a encantar.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a class="btn btn-outline-success btn-sm" href="#!">
                        <i class="bi bi-box-arrow-up-right"></i> Ver todos los productos
                    </a>
                </div>
            </div>
        </div>  
    </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
