<?php

include("../config/conexao.php");

$id = $_GET['id'];

mysqli_query($conexao,
"DELETE FROM veiculo
WHERE id = $id");

header("Location: listarVeiculo.php");


?>