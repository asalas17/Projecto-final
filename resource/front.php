<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css\front.css">
</head>

<body>
    <div class="welcome-box">
        <h1 class="mb-3">👋 Welcome!</h1>
        <p class="mb-4">Thank you for visiting. Please log in to access your account or register if you're new.</p>

        <div class="d-grid gap-2">
            <a href="resource\inicioSesion.php" class="btn btn-outline-primary">Log In</a>
            <a href="resource\registro.php" class="btn btn-primary">Register</a>
        </div>

        <p class="text-center mt-4 text-muted small">
                Continuar como
                <a href="resource\inicio.php" class="text-decoration-underline">invitado.</a>
            </p>
    </div>
</body>
<?php
include(__DIR__ . '/../templates/footer.php');
?>

</html>