<?php
$activePage = 'acerca';
include(__DIR__ . '/../templates/header.php'); 
include(__DIR__ . '/../templates/nav.php'); 
?>

<!-- Header -->
<header class="bg-success py-5 text-white agronaturaHeader">
  <div class="container px-4 px-lg-5 my-4">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Acerca de Nosotros</h1>
      <p class="lead text-white-50 mb-0">Conectamos comunidades con el corazón agrícola de Costa Rica</p>
    </div>
  </div>
</header>

<!-- Contenido -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <!-- Sección Acerca -->
      <section class="mb-5">
        <h2 class="text-success fw-bold mb-3">
          <i class="bi bi-leaf"></i> ¿Qué es Agronatura?
        </h2>
        <p class="text-muted">
          Agronatura nace de la necesidad de conectar agricultores y consumidores a través de una plataforma sencilla que fortalece las ferias del agricultor. Promovemos la comercialización local, organizamos y difundimos eventos para incentivar el consumo de productos frescos y apoyar el desarrollo sostenible de las comunidades agrícolas de Costa Rica.

        </p>
      </section>

      <hr class="my-5">

      <!-- Sección Contacto -->
      <section class="mb-5">
        <h2 class="text-success fw-bold mb-3">
          <i class="bi bi-envelope"></i> Contacto
        </h2>
        <p class="text-muted">
          Para consultas o sugerencias podés escribirnos a: 
          <a href="mailto:contacto@agronatura.cr" class="link-success fw-bold">contacto@agronatura.cr</a>
        </p>
        <p class="text-muted">
          O llamarnos al: <strong class="text-success">+506 1234-5678</strong>
        </p>
      </section>

      <hr class="my-5">

      <!-- Sección Ayuda - Soporte -->
      <section class="mb-5">
        <h2 class="text-success fw-bold mb-3">
          <i class="bi bi-question-circle"></i> Ayuda y Soporte
        </h2>
        <p class="text-muted">
          Si necesitás ayuda con la plataforma o tenés algún problema, visitá nuestra sección de 
          <a href="#" class="link-success">Soporte</a> o escribinos a 
          <a href="mailto:soporte@agronatura.cr" class="link-success">soporte@agronatura.cr</a>.
        </p>
      </section>

      <hr class="my-5">

      <!-- Sección Términos y Condiciones --> 
      <section>
        <h2 class="text-success fw-bold mb-3">
          <i class="bi bi-file-earmark-text"></i> Términos y Condiciones
        </h2>
        <p class="text-muted">
          Para conocer nuestras políticas y términos de uso, por favor revisá la página de 
          <a href="#" class="link-success">Términos y Condiciones</a>.
        </p>
      </section>

    </div>
  </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php'); 
?>
