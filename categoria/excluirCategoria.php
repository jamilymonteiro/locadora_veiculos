<?php

include("../config/conexao.php");

$id = $_GET['id'];

mysqli_query($conexao,
"DELETE FROM categoria
WHERE id = $id");

header("Location: listarCategoria.php");

?>