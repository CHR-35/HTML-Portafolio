<?php
session_start();
include("../common/conexion.php");

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {

                // Guardar datos en sesión
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["usuario"] = $user["usuario"]; 
                $_SESSION["rol"] = $user["rol"] ?? 'user'; 

                header("Location: ../index.php");
                exit();
            } else {
                $error = "La contraseña es incorrecta.";
            }
        } else {
            $error = "No existe una cuenta con este correo electrónico.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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

    <!-- login -->
    <div class="auth-body">
        <div class="card auth-card p-5">
            <h1 class="title has-text-centered has-text-dark">Iniciar Sesión</h1>

            <?php if (!empty($error)): ?>
                <div class="notification is-danger is-light">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">

                <div class="field">
                    <label class="label">Correo electrónico</label>
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

                <button type="submit" class="button is-danger is-fullwidth mt-3">Ingresar</button>
            </form>

            <p class="has-text-centered mt-4">
                ¿No tienes cuenta?
                <a href="register.php" class="accent">Regístrate aquí</a>
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