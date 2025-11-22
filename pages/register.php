<?php
session_start();
include("../common/conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    if (empty($nombre) || empty($usuario) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $checkSql = "SELECT id FROM usuarios WHERE usuario = ? OR email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ss", $usuario, $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "El usuario o el correo electrónico ya están registrados.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombre, usuario, email, password, rol) VALUES (?, ?, ?, ?, 'user')";

            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssss", $nombre, $usuario, $email, $password_hash);

                if ($stmt->execute()) {

                    // auto-login
                    $new_user_id = $stmt->insert_id;
                    $_SESSION['user_id'] = $new_user_id;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['rol'] = 'user';

                    header("Location: ../index.php");
                    exit();
                } else {
                    $error = "Error al registrar: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Error en la consulta: " . $conn->error;
            }
        }
        $checkStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="icon" href="assets/img/letra-c.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <!-- header -->
    <nav class="navbar is-fixed-top site-header" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item logo" href="../index.php">CHR-35</a>
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <a href="../index.php" class="navbar-item nav-link has-text-white">
                        <span class="icon is-small mr-1"><i class="fas fa-chevron-left"></i></span> Volver al Portafolio
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- registro -->
    <div class="auth-body">
        <div class="card auth-card p-5" style="margin-top: 4rem;">
            <h1 class="title has-text-centered">Crear Cuenta</h1>

            <?php if (!empty($error)): ?>
                <div class="notification is-danger is-light">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST">

                <div class="field">
                    <label class="label">Nombre completo</label>
                    <div class="control">
                        <input class="input" type="text" name="nombre" required value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Usuario</label>
                    <div class="control">
                        <input class="input" type="text" name="usuario" required value="<?php echo isset($usuario) ? htmlspecialchars($usuario) : ''; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Correo Electrónico</label>
                    <div class="control">
                        <input class="input" type="email" name="email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" name="password" required>
                    </div>
                </div>

                <button type="submit" class="button is-danger is-fullwidth mt-3">Registrarme</button>
            </form>

            <p class="has-text-centered mt-4">
                ¿Ya tienes cuenta?
                <a href="login.php" class="accent">Inicia sesión</a>
            </p>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container has-text-centered">
            <p class="has-text-white-ter">
                &copy; 2025 CHR-35. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <!-- navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        });
    </script>

</body>

</html>