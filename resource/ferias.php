<?php
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>


<!-- Header -->
<header class="bg-dark py-5">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">
      <h1 class="display-4 fw-bolder">Próximas ferias</h1>
      <p class="lead fw-normal text-white-50 mb-0">Filtra por ubicación para ver las ferias que sucederán más cerca de
        ti</p>
    </div>
  </div>
</header>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Buscador con filtro por provincia</h2>

  <form class="row g-3 justify-content-center">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control" placeholder="Buscar feria por nombre, ubicación, fecha, etc." name="query">
    </div>

    <!-- Dropdown de provincia -->
    <div class="col-md-3">
      <select class="form-select" name="provincia">
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
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>
</div>

<!-- Section -->
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

      <!-- Product Card Example (repeat as needed) -->
      <div class="col mb-5">
        <div class="card h-100">
          <img class="card-img-top"
            src="https://scontent.fsyq10-1.fna.fbcdn.net/v/t39.30808-6/308678378_427927272660582_1117839623904657462_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=ZQi7DtyDSmoQ7kNvwEptaUi&_nc_oc=AdkotHdH78PqSKvYxn_n1F95LXRvbP8qh4PZcPef1Rl3gb8kCHd58gsrwsQoOZpxGLduYqrUlAzNirjgJp6Anv8N&_nc_zt=23&_nc_ht=scontent.fsyq10-1.fna&_nc_gid=kAiNrIylo0s0TADTjCZnlQ&oh=00_AfREQQV5IutfI9pYS2exlStk5VRRp0Vc9Co_b_TxEHvLPA&oe=68766541"
            alt="..." />
          <div class="card-body p-4 text-center">
            <h5 class="fw-bolder">Feria La Fortuna</h5>
            15 - Jul del 2025
          </div>
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
            <a class="btn btn-outline-dark mt-auto" href="feriaDetalle.php">Ver detalles</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
include(__DIR__ . '/../templates/footer.php');
?>