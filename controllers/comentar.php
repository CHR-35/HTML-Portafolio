<?php
session_start();
include("../common/conexion.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nota = trim($_POST["nota"]);

    if ($nota === "") {
        header("Location: ../index.php?error=nota_vacia#comentarios");
        exit();
    }

    $usuario_id = $_SESSION["user_id"];
    $fecha = date("Y-m-d H:i:s");

    $sql = "INSERT INTO comentarios (id_usuario, nota, fechanota) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $nota, $fecha);

    if ($stmt->execute()) {
        header("Location: ../index.php#comentarios");
        exit();
    } else {
        echo "❌ Error al guardar el comentario.";
    }
}
