<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portafolio de Chris | CHR-35</title>
    <link rel="icon" href="assets/img/letra-c.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php session_start(); ?>

    <!-- header -->
    <nav class="navbar is-fixed-top site-header" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item logo" href="index.php">
                    CHR-35
                </a>
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end is-align-items-center">
                    <a href="#inicio" class="navbar-item nav-link">
                        <span class="icon is-small mr-1"><i class="fas fa-home"></i></span> Inicio
                    </a>
                    <a href="#proyectos" class="navbar-item nav-link">
                        <span class="icon is-small mr-1"><i class="fas fa-code"></i></span> Proyectos
                    </a>

                    <span class="is-hidden-touch has-text-grey-dark mx-2">|</span>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="navbar-item buttons">
                            <a href="pages/login.php" class="button is-small is-text has-text-white decoration-none">Inicio de Sesión</a>
                            <a href="#contacto" class="button is-small btn-header is-rounded">
                                <span>Contacto</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link has-text-white" style="background: transparent;">
                                <span class="icon has-text-success mr-2"><i class="fas fa-user-circle"></i></span>
                                <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>
                            </a>
                            <div class="navbar-dropdown is-right has-background-black-bis">
                                <a href="controllers/logout.php" class="navbar-item has-text-danger">
                                    <span class="icon mr-2"><i class="fas fa-sign-out-alt"></i></span> Cerrar sesión
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- hero -->
    <section id="inicio" class="hero section is-medium">
        <div class="container">
            <div class="columns is-vcentered">

                <div class="column is-three-fifths">
                    <div class="hero-text animate-fade-up">
                        <p class="accent has-text-weight-bold is-uppercase mb-2">Desarrollador Full Stack</p>
                        <h1 class="title is-1 has-text-white" style="font-size: 3.5rem;">
                            Hola, soy <span class="accent">Chris</span>
                        </h1>
                        <p class="subtitle is-4 has-text-grey-light mt-4" style="max-width: 500px;">
                            Estudiante de Ingeniería en Sistemas en UNIMAR. Transformo ideas complejas en código limpio y funcional.
                        </p>

                        <div class="buttons mt-6">
                            <a href="#proyectos" class="button is-danger is-medium is-rounded shadow-lg">
                                Ver Proyectos
                            </a>
                            <a href="https://github.com/CHR-35" target="_blank" class=" button is-outlined is-danger is-medium is-rounded ml-3">
                                <span class="icon"><i class="fab fa-github"></i></span>
                                <span>GitHub</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="column is-two-fifths has-text-centered is-hidden-mobile">
                    <div class="hero-image is-inline-block floating-img">C</div>
                </div>
            </div>
        </div>
    </section>

    <!-- proyectos -->
    <section id="proyectos" class="section">
        <div class="container">
            <div class="has-text-centered mb-6">
                <h2 class="title is-2 has-text-white">Mis Proyectos</h2>
                <div class="is-divider" style="border-top: 3px solid #e50914; width: 60px; margin: 10px auto;"></div>
                <p class="subtitle has-text-grey">Una selección de mis trabajos recientes.</p>
            </div>

            <div class="columns is-multiline">

                <div class="column is-4-desktop is-6-tablet">
                    <div class="project-card">
                        <img src="assets/img/apixmon.png" alt="Apixmon">
                        <div class="project-content">
                            <div>
                                <h3 class="title is-5 has-text-white">Apixmon</h3>
                                <p class="content is-small has-text-grey">
                                    Aplicación móvil de Pokédex desarrollada con Flutter y consumiendo API REST.
                                </p>
                            </div>
                            <a href="pages/apixmon.html" class="button is-danger is-small is-fullwidth mt-4 is-rounded">Ver Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="column is-4-desktop is-6-tablet">
                    <div class="project-card">
                        <img src="assets/img/ventana.png" alt="Próximamente">
                        <div class="project-content">
                            <div>
                                <h3 class="title is-5 has-text-white">E-Commerce</h3>
                                <p class="content is-small has-text-grey">
                                    Plataforma de ventas en línea con pasarela de pagos (En desarrollo).
                                </p>
                            </div>
                            <a href="pages/coming_soon.html" class="button is-outlined is-danger is-small is-fullwidth mt-4 is-rounded">Próximamente</a>
                        </div>
                    </div>
                </div>

                <div class="column is-4-desktop is-6-tablet">
                    <div class="project-card">
                        <img src="assets/img/ventana.png" alt="Próximamente">
                        <div class="project-content">
                            <div>
                                <h3 class="title is-5 has-text-white">Gestor de Tareas</h3>
                                <p class="content is-small has-text-grey">
                                    Sistema web para gestión de productividad personal.
                                </p>
                            </div>
                            <a href="pages/coming_soon.html" class="button is-outlined is-danger is-small is-fullwidth mt-4 is-rounded">Próximamente</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- contacto -->
    <section id="contacto" class="section has-background-black-bis">
        <div class="container has-text-centered">
            <h2 class="title is-3 has-text-white mb-5">Conectemos</h2>
            <div class="columns is-centered is-mobile is-multiline">
                <div class="column is-narrow">
                    <a href="https://github.com/CHR-35" target="_blank" class="button is-dark is-medium is-rounded">
                        <span class="icon has-text-white"><i class="fab fa-github"></i></span>
                    </a>
                </div>
                <div class="column is-narrow">
                    <a href="#" class="button is-dark is-medium is-rounded">
                        <span class="icon has-text-info"><i class="fab fa-linkedin"></i></span>
                    </a>
                </div>
                <div class="column is-narrow">
                    <a href="#" class="button is-dark is-medium is-rounded">
                        <span class="icon has-text-danger"><i class="fab fa-instagram"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- comentarios -->
    <section id="comentarios" class="section">
        <div class="container is-max-desktop">

            <div class="box has-background-black-ter" style="border: 1px solid #333;">
                <h2 class="title is-4 has-text-white has-text-centered mb-5">
                    <span class="icon mr-2 has-text-danger"><i class="fas fa-comments"></i></span>
                    Muro de Comentarios
                </h2>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div class="notification is-warning is-light has-text-centered">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        Debes <a href="pages/login.php"><strong>iniciar sesión</strong></a> para dejar un comentario.
                    </div>
                <?php else: ?>
                    <form action="controllers/comentar.php" method="POST" class="mb-6">
                        <div class="field">
                            <div class="control">
                                <textarea name="nota" class="textarea has-background-dark has-text-white" rows="2" placeholder="Escribe algo genial..." style="border-color: #444;"></textarea>
                            </div>
                        </div>
                        <div class="has-text-right">
                            <button class="button is-danger is-rounded" type="submit">
                                Publicar <span class="icon ml-1"><i class="fas fa-paper-plane"></i></span>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>

                <hr class="has-background-grey-dark">

                <div class="comments-list">
                    <?php
                    include('common/conexion.php');
                    $sql = "SELECT c.id, c.nota, c.fechanota, u.id AS uid, u.usuario, u.rol 
                            FROM comentarios c 
                            JOIN usuarios u ON c.id_usuario = u.id 
                            ORDER BY c.id DESC LIMIT 10";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            $autor = htmlspecialchars($row['usuario']);
                            $nota = nl2br(htmlspecialchars($row['nota']));
                            $fecha = date("d M Y", strtotime($row['fechanota']));
                            $esAdmin = ($row['rol'] === 'admin');

                            // Permisos
                            $canDelete = false;
                            if (isset($_SESSION['user_id'])) {
                                if ($_SESSION['user_id'] == $row['uid'] || $_SESSION['rol'] == 'admin') $canDelete = true;
                            }
                    ?>

                            <article class="media mb-4" style="border-bottom: 1px solid #333; padding-bottom: 1rem;">
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img class="is-rounded" src="https://ui-avatars.com/api/?name=<?= $autor ?>&background=random" alt="<?= $autor ?>">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p class="has-text-grey-light">
                                            <strong class="has-text-white"><?= $autor ?></strong>
                                            <?php if ($esAdmin): ?>
                                                <span class="tag is-danger is-light is-rounded ml-2" style="font-size: 0.7rem;">Admin</span>
                                            <?php endif; ?>
                                            <small class="has-text-grey ml-2"><?= $fecha ?></small>
                                            <br>
                                            <?= $nota ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                if ($canDelete):
                                ?>
                                    <div class="media-right">
                                        <div class="dropdown is-right is-hoverable">
                                            <div class="dropdown-trigger">
                                                <button class="button is-small is-dark is-outlined" aria-haspopup="true" aria-controls="dropdown-menu-<?= $row['id'] ?>">
                                                    <span class="icon is-small"><i class="fas fa-ellipsis-v"></i></span>
                                                </button>
                                            </div>
                                            <div class="dropdown-menu" id="dropdown-menu-<?= $row['id'] ?>" role="menu">
                                                <div class="dropdown-content has-background-black-bis" style="border: 1px solid #333;">

                                                    <a href="controllers/editar_comentario.php?id=<?= $row['id'] ?>" class="dropdown-item has-text-warning-light">
                                                        <span class="icon mr-1"><i class="fas fa-edit"></i></span> Editar
                                                    </a>

                                                    <hr class="dropdown-divider has-background-grey-dark">

                                                    <a href="controllers/eliminar_comentario.php?id=<?= $row['id'] ?>" class="dropdown-item has-text-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este comentario?');">
                                                        <span class="icon mr-1"><i class="fas fa-trash"></i></span> Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </article>
                        <?php
                        endwhile;
                    else:
                        ?>
                        <p class="has-text-centered has-text-grey">Aún no hay comentarios. ¡Sé el primero!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer has-background-black pt-6 pb-6">
        <div class="content has-text-centered">
            <p class="has-text-grey">
                &copy; <?php echo date("Y"); ?> <strong class="has-text-white">CHR-35</strong>.
                Codeado con <span class="has-text-danger"><i class="fas fa-heart"></i></span> y PHP.
            </p>
        </div>
    </footer>

    <!-- navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });
    </script>
</body>

</html>