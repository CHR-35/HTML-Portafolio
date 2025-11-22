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

$sql = "SELECT id_usuario FROM comentarios WHERE id = ?";
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
    echo "❌ No puedes eliminar este comentario.";
    exit();
}

$sqlDel = "DELETE FROM comentarios WHERE id = ?";
$stmtDel = $conn->prepare($sqlDel);
$stmtDel->bind_param("i", $id);

if ($stmtDel->execute()) {
    header("Location: ../index.php#comentarios");
} else {
    echo "❌ Error al eliminar.";
}
