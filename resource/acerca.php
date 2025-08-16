<?php
$activePage = 'acerca';
include(__DIR__ . '/../templates/header.php'); 
include(__DIR__ . '/../templates/nav.php'); 
?>

<!-- Header -->
<header class="bg-success py-5 text-white agronaturaHeader position-relative" style="height: 500px;">
  <div class="container px-4 px-lg-5 my-4 text-center position-relative" style="z-index: 2;">
    <h1 class="display-4 fw-bold">Acerca de Nosotros</h1>
<p class="lead mb-0" style="color: rgba(255,255,255,0.9);">
      Conectamos comunidades con el corazón agrícola de Costa Rica</p>
    </div>

<!-- Agregando img al header -->
  <img src="/Projecto-final/img/farmers.jpg" alt=""
      alt="Decoración" 
      style="position: absolute; top: 0; left: 0; width: 100%; height:100%; object-fit: cover; opacity: 0.4; z-index: 1;">

</header>




<!-- Contenido -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <!-- Sección Acerca -->
      <section class="mb-5">
        <h2 class="text-success fw-bold mb-3">
          <img src="/Projecto-final/img/icon.png"       style="filter: invert(40%) sepia(80%) saturate(600%) hue-rotate(100deg) brightness(95%) contrast(90%);"
 alt="Agronatura" width="40" class="me-2"> ¿Qué es Agronatura?
        </h2>
        <p class="text-muted">
          Agronatura nace de la necesidad de conectar agricultores y consumidores a través de una plataforma sencilla que fortalece las ferias del agricultor. Promovemos la comercialización local, organizamos y difundimos eventos para incentivar el consumo de productos frescos y apoyar el desarrollo sostenible de las comunidades agrícolas de Costa Rica.

        </p>
      </section>

      <hr class="my-5">

      <!-- FAQ -->
<section class="mb-5">
  <h3 class="fw-bold mb-3" style="color: #6c2efa;">Preguntas Frecuentes (FAQ)</h3>
  <div class="accordion" id="faqAccordion">

    <!-- Pregunta 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading1">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1" style="background-color: #6c2efa; color: white;">
          ¿Cómo puedo registrarme como agricultor en la plataforma?
        </button>
      </h2>
      <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
        <div class="accordion-body" style="background-color: #f3eaff; color: #4a148c;">
          Para registrarte como agricultor, debes completar el formulario de registro proporcionando tu información personal y detalles de tus productos. Una vez aprobado, podrás gestionar tus productos y participar en ferias locales.
        </div>
      </div>
    </div>

    <!-- Pregunta 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2" style="background-color: #6c2efa; color: white;">
          ¿Qué tipo de productos puedo publicar?
        </button>
      </h2>
      <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
        <div class="accordion-body" style="background-color: #f3eaff; color: #4a148c;">
          Puedes publicar cualquier producto agrícola que cultives o produzcas, incluyendo frutas, verduras, plantas, semillas o productos procesados como mermeladas y conservas.
        </div>
      </div>
    </div>

    <!-- Pregunta 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeading3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3" style="background-color: #6c2efa; color: white;">
          ¿Qupe puedo hacer como usuario registrado?
        </button>
      </h2>
      <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
        <div class="accordion-body" style="background-color: #f3eaff; color: #4a148c;">
          Los usuarios registrados pueden navegar por las ferias y perfiles de los agricultores para así saber que próximas fechas y que productos habrán en las próximas ferias.
        </div>
      </div>
    </div>

    <!-- Pregunta 4 -->
    <div class="accordion-item">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4" style="background-color: #6c2efa; color: white;">
          ¿Puedo modificar la información de mis productos después de publicarlos?
        </button>
      </h2>
      <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
        <div class="accordion-body" style="background-color: #f3eaff; color: #4a148c;">
          Sí, los agricultores pueden actualizar la información de sus productos, como precio, cantidad disponible o descripción, en cualquier momento desde su panel de control.
        </div>
      </div>
    </div>

  </div>
</section>


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
