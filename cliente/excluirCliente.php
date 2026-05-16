<?php

include("../config/conexao.php");

$id = $_GET['id'];

mysqli_query($conexao,
"DELETE FROM cliente
WHERE id = $id");

header("Location: listarCliente.php");
?>