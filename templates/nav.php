<nav class="navbar navbar-expand-lg navbar-agronatura py-3">
  <div class="container-fluid">
    <a class="navbar-brand navbar-brand-agronatura ps-2" href="inicio.php">
      <i class="bi bi-leaf"></i> Agronatura
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'inicio') ? 'active' : '' ?>" href="inicio.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'ferias') ? 'active' : '' ?>" href="ferias.php">Próximas ferias</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'inscribirse') ? 'active' : '' ?>" href="inscribirse.php">Inscribirse</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'sedes') ? 'active' : '' ?>" href="agriOficiales.php">Agricultores oficiales</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'acerca') ? 'active' : '' ?>" href="acerca.php">Acerca de nosotros</a>
        </li>
      </ul>

      <div class="d-flex pe-2">
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="../app/backend/procesar_logout.php" class="btn btn-agronatura-outline me-2">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
          </a>
        <?php else: ?>
          <a href="inicioSesion.php" class="btn btn-agronatura-outline me-2">
            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>