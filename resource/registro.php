<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="..\css\registro.css">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row bg-white shadow rounded-3 overflow-hidden w-100" style="max-width: 1000px;">

            <div class="col-lg-6 p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-success">
                        <i class="bi bi-leaf"></i> Agronatura
                    </h2>
                </div>

                <h2 class="text-center fw-bold mb-4 text-success">Registrate</h2>
                <div class="text-center mb-4">
                    <span class="text-muted">Usá tu correo de preferencia para registrarte</span>
                </div>

                <form action="procesar_registro.php" method="POST">
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
                        <i class="bi bi-person-plus-fill"></i> Registrarse
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="inicioSesion.php" class="small link-success-hover text-decoration-none">¿Ya tenés una
                        cuenta?</a>
                </div>

                <p class="text-center mt-4 text-muted small">
                    Al registrarte, aceptás nuestros
                    <a href="#" class="link-success-hover text-decoration-none fw-bold">términos y condiciones</a>.
                </p>
            </div>

            <div class="col-lg-6 d-none d-lg-block bg-auth-image"></div>
        </div>
    </div>

    <?php
    include(__DIR__ . '/../templates/footer.php');
    ?>
</body>