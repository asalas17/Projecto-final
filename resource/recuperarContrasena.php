<?php
require_once __DIR__ . '/../config/env.php';
session_start();
require_once __DIR__ . '/../config/db_conn.php';

$step = 1;
$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: verify email
    if (isset($_POST['email']) && !isset($_POST['new_password'])) {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Correo inválido.';
        } else {
            $stmt = $connection->prepare('SELECT id FROM usuarios WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 0) {
                $error = 'No existe una cuenta con ese correo.';
            } else {
                $step = 2;
            }
            $stmt->close();
        }
    }
    // Step 2: set new password
    elseif (isset($_POST['email'], $_POST['new_password'])) {
        $email = trim($_POST['email']);
        $newPassword = $_POST['new_password'];
        if (strlen($newPassword) < 6) {
            $error = 'La contraseña debe tener al menos 6 caracteres.';
            $step = 2;
        } else {
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $connection->prepare('UPDATE usuarios SET password = ? WHERE email = ?');
            $stmt->bind_param('ss', $hash, $email);
            $stmt->execute();
            $stmt->close();
            header('Location: ' . BASE_PATH . '/resource/inicioSesion.php?reset=ok');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../app/css/inicioSesion.css">
</head>
<body>
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="row w-100 justify-content-center auth-row">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-success text-center mb-4">
                        <i class="bi bi-leaf"></i> Agronatura
                    </h2>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if ($step === 1): ?>
                        <form method="POST">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control border-success" placeholder="Correo electrónico" required>
                            </div>
                            <button type="submit" class="btn btn-agronatura w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-send"></i> Continuar
                            </button>
                        </form>
                    <?php else: ?>
                        <form method="POST">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                            <div class="mb-3">
                                <input type="password" name="new_password" class="form-control border-success" placeholder="Nueva contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-agronatura w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-key"></i> Guardar
                            </button>
                        </form>
                    <?php endif; ?>

                    <p class="text-center mt-4 text-muted small">
                        ¿Recordaste tu contraseña?
                        <a href="<?= BASE_PATH ?>/resource/inicioSesion.php" class="fw-bold link-success-hover text-decoration-none">Inicia sesión aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');