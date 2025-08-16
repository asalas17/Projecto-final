<?php
$activePage = 'inicio';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<!-- Header -->
<header class="bg-success py-5 agronaturaHeader">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-3">Agronatura: Tu guía de ferias agrícolas en Costa
                        Rica</h1>
                    <p class="lead text-white-50 mb-4">
                        Conecta con productores locales, descubre nuevas ferias y apoya la agricultura costarricense.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-light btn-lg px-4 me-sm-3" href="#features">Conoce más</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#contact">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features section -->
<section id="features" class="py-5 border-bottom">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-success text-white rounded-3 mb-3"><i class="bi bi-map"></i></div>
                <h2 class="h4 fw-bolder">Mapa de ferias</h2>
                <p>Encuentra ferias agrícolas cerca de tu comunidad con horarios, ubicación y productos destacados.</p>
                <a class="text-decoration-none" href="ferias.php?map=1">Explorar <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-success text-white rounded-3 mb-3"><i class="bi bi-basket"></i></div>
                <h2 class="h4 fw-bolder">Productos frescos y locales</h2>
                <p>Conoce qué productos están en temporada y apoya directamente a los agricultores nacionales.</p>
                <a class="text-decoration-none" href="agriOficiales.php?productos=1">Ver productos <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="col-lg-4">
                <div class="feature bg-success text-white rounded-3 mb-3"><i class="bi bi-megaphone"></i></div>
                <h2 class="h4 fw-bolder">Conoce a los agricultores</h2>
                <p>Date un paseo por el catalogo e historia de los encargados de llevar la frescura hasta tu hogar.</p>
                <a class="text-decoration-none" href="agriOficiales.php?productos=0">Listado de agricultores <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Beneficios de comprar local -->
<section class="bg-light py-5 border-bottom">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">¿Por qué comprar en ferias agrícolas?</h2>
            <p class="lead mb-0">Apoyar lo local es apoyar a Costa Rica</p>
        </div>
        <div class="row gx-5 text-center">
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <div class="card-body p-4">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i
                                class="bi bi-emoji-smile"></i></div>
                        <h5 class="card-title fw-bold">Frescura garantizada</h5>
                        <p class="card-text">Productos cosechados localmente, sin intermediarios y con el sabor
                            auténtico del campo.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <div class="card-body p-4">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i
                                class="bi bi-people"></i></div>
                        <h5 class="card-title fw-bold">Apoyo a pequeños productores</h5>
                        <p class="card-text">Cada compra beneficia directamente a familias agricultoras de nuestra
                            región.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <div class="card-body p-4">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i class="bi bi-bag-heart"></i>
                        </div>
                        <h5 class="card-title fw-bold">Consumo sostenible</h5>
                        <p class="card-text">Reduce tu huella ecológica comprando productos de temporada y de cercanía.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galería de experiencias -->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Así se vive una feria agrícola</h2>
            <p class="lead mb-0">Un espacio lleno de vida, comunidad y tradición</p>
        </div>
        <div class="row gx-4 gy-4">
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://www.orlandosentinel.com/wp-content/uploads/migration/2020/06/02/LUMG42IUDJBRXJTM3WMDJUAD5A.jpg"
                    alt="Feria agrícola 1">
            </div>
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://www.sensorialsunsets.com/wp-content/uploads/2022/07/IMG_2714-1024x768-1.jpg"
                    alt="Feria agrícola 2">
            </div>
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://www.nacion.com/resizer/VIW6Q5bRjpE3G5s5MLdK0cts0gM=/1440x0/filters:format(jpg):quality(70)/cloudfront-us-east-1.images.arcpublishing.com/gruponacion/TFJ3UPIZMNEINLWIAECC6SXSUU.jpg"
                    alt="Feria agrícola 3">
            </div>
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://www.maga.gob.gt/wp-content/uploads/2025/04/Feria-del-Agricultor-dinamiza-la-economia-de-los-hogares-de-Sanarate1.jpeg"
                    alt="Feria agrícola 4">
            </div>
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://images.ctfassets.net/wv75stsetqy3/4Brq4fe7Qlef2aTq0hZh5N/b7637316467ee1f53b15e807f17e5072/The_weekly_feria_has_also_become_a_social_scene.jpg?q=60&fit=fill&fm=webp"
                    alt="Feria agrícola 5">
            </div>
            <div class="col-lg-4 col-md-6">
                <img class="img-fluid rounded shadow-sm"
                    src="https://www.nacion.com/resizer/J4R6tGYXGYBD9SEv2HuBbxqFdr0=/1440x0/filters:format(jpg):quality(70)/arc-anglerfish-arc2-prod-gruponacion.s3.amazonaws.com/public/2QAWKJGVBNE3VMASFOHPQCSWYQ.JPG"
                    alt="Feria agrícola 6">
            </div>
        </div>
    </div>
</section>

<!-- Sección de contacto personalizada -->
<section id="contact" class="bg-success bg-opacity-10 py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <div class="feature bg-success bg-gradient text-white rounded-3 mb-3 mx-auto"
                style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-envelope fs-3"></i>
            </div>
            <h2 class="fw-bolder">¿Querés ponerte en contacto?</h2>
            <p class="lead mb-0">Escribinos si necesitas ayuda, deseas enviar una sugerencia o conocer más sobre
                Agronatura.</p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <form id="contactForm" method="post" action="procesar_contacto.php">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Tu nombre completo"
                            required />
                        <label for="name">Nombre completo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" type="email"
                            placeholder="nombre@ejemplo.com" required />
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="motivo" name="motivo" required>
                            <option value="" disabled selected>Seleccioná una opción</option>
                            <option value="ayuda">Ayuda</option>
                            <option value="consulta">Consulta general</option>
                            <option value="sugerencia">Enviar sugerencia</option>
                        </select>
                        <label for="motivo">Motivo del contacto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="mensaje" name="mensaje"
                            placeholder="Escribí tu mensaje aquí..." style="height: 10rem;" required></textarea>
                        <label for="mensaje">Mensaje</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-success btn-lg" type="submit">Enviar mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>




<?php
include(__DIR__ . '/../templates/footer.php');
?>