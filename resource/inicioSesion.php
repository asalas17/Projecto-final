<?php
session_start();
$mensaje = '';
if (isset($_GET['registro']) && $_GET['registro'] == 'ok') {
    $mensaje = 'Registro realizado con exito! Ya puedes iniciar sesion.';
} elseif (isset($_GET['error'])) {
    $mensaje = htmlspecialchars($_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../app/css/inicioSesion.css">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <!-- Aquí uso auth-row, igual que en registro -->
        <div class="row w-100 justify-content-center auth-row">
            <!-- Esta columna controla el ancho responsivo -->
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">

                        <!-- Título e ícono -->
                        <h2 class="fw-bold text-success text-center mb-4">
                            <i class="bi bi-leaf"></i> Agronatura
                        </h2>

                        <!-- Mensaje de registro o error -->
                        <?php if ($mensaje): ?>
                            <div class="alert <?= isset($_GET['error']) ? 'alert-danger' : 'alert-success' ?> text-center">
                                <?= $mensaje ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario -->
                        <form action="../app/backend/procesar_login.php" method="POST">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control border-success"
                                    placeholder="Correo electrónico" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password" class="form-control border-success"
                                    placeholder="Contraseña" required>
                            </div>
                            <button type="submit"
                                class="btn btn-agronatura w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="#" class="small link-success-hover text-decoration-none">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                        <p class="text-center mt-4 text-muted small">
                            ¿No tenés cuenta?
                            <a href="registro.php" class="fw-bold link-success-hover text-decoration-none">
                                Registrate aquí
                            </a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include(__DIR__ . '/../templates/footer.php');
