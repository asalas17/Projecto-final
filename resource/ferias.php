<?php
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<!-- Header -->
<header class="bg-success py-5 text-white agronaturaHeader">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Próximas ferias agrícolas</h1>
      <p class="lead fw-normal text-white-50 mb-0">Encontrá los eventos más cercanos y apoyá a los productores locales</p>
    </div>
  </div>
</header>

<!-- Buscador -->
<div class="container mt-5">
  <h2 class="mb-4 text-center text-success fw-bold">Buscador por provincia</h2>

  <form class="row g-3 justify-content-center">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control border-success" placeholder="Buscar por nombre, lugar, fecha, etc." name="query">
    </div>

    <!-- Dropdown de provincia -->
    <div class="col-md-3">
      <select class="form-select border-success" name="provincia">
        <option selected disabled>Seleccionar provincia</option>
        <option value="San José">San José</option>
        <option value="Alajuela">Alajuela</option>
        <option value="Cartago">Cartago</option>
        <option value="Heredia">Heredia</option>
        <option value="Guanacaste">Guanacaste</option>
        <option value="Puntarenas">Puntarenas</option>
        <option value="Limón">Limón</option>
      </select>
    </div>

    <!-- Botón -->
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">Buscar</button>
    </div>
  </form>
</div>

<!-- Tarjetas de ferias -->
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-4">
    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">

      <!-- Tarjeta de feria -->
      <div class="col mb-5">
        <div class="card h-100 shadow border-0">
          <img class="card-img-top" src="https://scontent.fsyq10-1.fna.fbcdn.net/v/t39.30808-6/308678378_427927272660582_1117839623904657462_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=ZQi7DtyDSmoQ7kNvwEptaUi&_nc_oc=AdkotHdH78PqSKvYxn_n1F95LXRvbP8qh4PZcPef1Rl3gb8kCHd58gsrwsQoOZpxGLduYqrUlAzNirjgJp6Anv8N&_nc_zt=23&_nc_ht=scontent.fsyq10-1.fna&_nc_gid=kAiNrIylo0s0TADTjCZnlQ&oh=00_AfREQQV5IutfI9pYS2exlStk5VRRp0Vc9Co_b_TxEHvLPA&oe=68766541" alt="Feria La Fortuna" />
          <div class="card-body text-center">
            <h5 class="fw-bold text-success">Feria La Fortuna</h5>
            <p class="mb-0 text-muted">15 de julio, 2025</p>
          </div>
          <div class="card-footer bg-transparent text-center border-0">
            <a class="btn btn-outline-success" href="feriaDetalle.php">Ver detalles</a>
          </div>
        </div>
      </div>

      <!-- Puedes duplicar esta tarjeta para otras ferias -->

    </div>
  </div>
</section>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
