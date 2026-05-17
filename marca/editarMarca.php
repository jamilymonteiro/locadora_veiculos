<?php

include("../includes/verificaAdmin.php");
include("../config/conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listarMarca.php");
    exit;
}

$id = (int) $_GET['id'];

$resultado = mysqli_query($conexao,
    "SELECT * FROM marca WHERE id = $id");

$marca = mysqli_fetch_assoc($resultado);

if (!$marca) {
    header("Location: listarMarca.php");
    exit;
}

include("../includes/header.php");
include("../includes/menuAdmin.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Editar Marca</h2>

        <hr>

        <form
        action="atualizarMarca.php"
        method="POST">

            <input type="hidden" name="id" value="<?= $marca['id'] ?>">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            value="<?= htmlspecialchars($marca['nome'], ENT_QUOTES) ?>"
            required>

            <br>

            <button
            class="btn btn-primary">

                Salvar alterações

            </button>

        </form>

    </div>

</div>

<?php
include("../includes/footer.php");
?>
