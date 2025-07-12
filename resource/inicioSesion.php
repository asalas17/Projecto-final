<?php
include(__DIR__ . '/../templates/header.php');
?>

<style>
    body {
        font-family: "Inter", sans-serif;
        background-color: #f7fafc;
    }

    .bg-auth-image {
        background: url("https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg") center center no-repeat;
        background-size: contain;
    }
</style>

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="row bg-white shadow rounded-3 overflow-hidden w-100" style="max-width: 1000px;">
        <!-- Form Area -->
        <div class="col-lg-6 p-5">
            <div class="text-center mb-4">
                <!-- Logo aquí -->
                <img src=""
                    class="img-fluid" style="width: 100px;" />
            </div>
            <h2 class="text-center fw-bold mb-4">Iniciar sesión</h2>

            <div class="text-center my-4">
                <span class="text-muted">Ingresa tus credenciales</span>
            </div>

            <form action="procesar_login.php" method="POST">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required />
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required />
                </div>
                <button type="submit"
                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    Iniciar sesión
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="#" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>

            <p class="text-center mt-4 text-muted small">
                ¿No tienes cuenta?
                <a href="registro.php" class="text-decoration-underline">Regístrate aquí</a>
            </p>
        </div>

        <!-- Image Area -->
        <div class="col-lg-6 d-none d-lg-block bg-auth-image"></div>
    </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
