<?php

include("../config/conexao.php");

$id = $_GET['id'];

mysqli_query($conexao,
"DELETE FROM marca
WHERE id = $id");

header("Location: listarMarca.php");
?>