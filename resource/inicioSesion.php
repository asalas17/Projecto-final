<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="..\css\inicioSesion.css">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row bg-white shadow rounded-3 overflow-hidden w-100" style="max-width: 1000px;">
            <!-- Form Area -->
            <div class="col-lg-6 p-5">
                <div class="text-center mb-4">
                    <!-- Logo -->
                    <h2 class="fw-bold text-success">
                        <i class="bi bi-leaf"></i> Agronatura
                    </h2>
                </div>

                <h2 class="text-center fw-bold mb-4 text-success">Iniciar sesión</h2>
                <div class="text-center mb-4">
                    <span class="text-muted">Accedé a tu cuenta para gestionar tu feria</span>
                </div>

                <form action="procesar_login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control border-success"
                            placeholder="Correo electrónico" required />
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" class="form-control border-success"
                            placeholder="Contraseña" required />
                    </div>
                    <button type="submit"
                        class="btn btn-agronatura w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="#" class="small link-success-hover text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>

                <p class="text-center mt-4 text-muted small">
                    ¿No tenés cuenta?
                    <a href="registro.php" class="link-success-hover text-decoration-none fw-bold">Registrate aquí</a>
                </p>
            </div>

            <!-- Image Area -->
            <div class="col-lg-6 d-none d-lg-block bg-auth-image"></div>
        </div>
    </div>

    <?php
    include(__DIR__ . '/../templates/footer.php');
    ?>