<?php
session_start();
include("../common/conexion.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: ../pages/login.php");
    exit();
}

if (!isset($_GET["id"])) {
    echo "ID inválido.";
    exit();
}

$id = intval($_GET["id"]);

$sql = "SELECT id_usuario, nota FROM comentarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "Comentario no encontrado.";
    exit();
}

$comentario = $res->fetch_assoc();

$esDueno = ($_SESSION["user_id"] == $comentario["id_usuario"]);
$esAdmin = (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin");

if (!$esDueno && !$esAdmin) {
    echo "❌ No tienes permiso para editar este comentario.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $notaEditada = trim($_POST["nota"]);

    if ($notaEditada === "") {
        echo "La nota no puede estar vacía.";
        exit();
    }

    $sqlUpdate = "UPDATE comentarios SET nota = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $notaEditada, $id);

    if ($stmtUpdate->execute()) {
        header("Location: ../index.php#comentarios");
    } else {
        echo "❌ Error al actualizar.";
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Comentario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="section" style="background-color: #000; min-height: 100vh;">

    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="box">
                    <h1 class="title has-text-centered has-text-white">Editar comentario</h1>

                    <form method="POST">
                        <div class="field">
                            <label class="label">Comentario</label>
                            <div class="control">
                                <textarea class="textarea" name="nota" required rows="4"><?= htmlspecialchars($comentario["nota"]) ?></textarea>
                            </div>
                        </div>

                        <div class="field is-grouped is-grouped-centered mt-5">
                            <div class="control">
                                <button class="button is-danger" type="submit">Guardar Cambios</button>
                            </div>
                            <div class="control">
                                <a href="../index.php#comentarios" class="button is-light">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>