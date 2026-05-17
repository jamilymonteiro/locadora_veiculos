<?php

include("../config/conexao.php");

if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: listarMarca.php");
    exit;
}

$id = (int) $_POST['id'];
$nome = $_POST['nome'];

$sql = "UPDATE marca SET nome = '$nome' WHERE id = $id";

mysqli_query($conexao, $sql);

header("Location: listarMarca.php");
?>
