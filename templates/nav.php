<?php
$activePage = $activePage ?? 'inicio';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container-fluid">
        <a class="navbar-brand ps-2" href="#">Logo</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage == 'inicio') ? 'active' : '' ?>"
                        href="..\resource\inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage == 'acerca') ? 'active' : '' ?>"
                        href="..\resource\acerca.php">Acerca de nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage == 'ferias') ? 'active' : '' ?>" href="..\resource\ferias.php">Próximas ferias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage == 'sedes') ? 'active' : '' ?>" href="..\resource\sedes.php">Sedes oficiales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage == 'inscribirse') ? 'active' : '' ?>" href="..\resource\inscribirse.php">Inscribirse</a>
                </li>
            </ul>

            <div class="d-flex pe-2">
                <a href="..\resource\inicioSesion.php" class="btn btn-outline-primary me-2">Iniciar Sesión</a>
                <a href="..\resource\registro.php" class="btn btn-primary">Registrarse</a>
            </div>
        </div>
    </div>
</nav>