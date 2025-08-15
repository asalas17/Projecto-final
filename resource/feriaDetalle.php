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
