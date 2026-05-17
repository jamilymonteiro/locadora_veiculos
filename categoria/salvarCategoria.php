<?php

include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int) $_POST['id'];

    $sql = "UPDATE categoria
    SET nome = '$nome', descricao = '$descricao'
    WHERE id = $id";
} else {
    $sql = "INSERT INTO categoria
    (nome, descricao)

    VALUES
    ('$nome', '$descricao')";
}

mysqli_query($conexao, $sql);

header("Location: listarCategoria.php");

?>