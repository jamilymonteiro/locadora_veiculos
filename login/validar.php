<?php

session_start();

include("../config/conexao.php");

$login = $_POST['login'];

$senha = $_POST['senha'];

$sql = "

SELECT *
FROM usuario

WHERE login = '$login'
AND senha = '$senha'

";

$resultado =
mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){

    $_SESSION['admin'] = true;

    header("Location: ../admin.php");

}else{

    echo "
    Login inválido
    ";

}
?>