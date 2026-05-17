<?php

include("../includes/verificaAdmin.php");
include("../config/conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listarCategoria.php");
    exit;
}

$id = (int) $_GET['id'];

$resultado = mysqli_query($conexao,
    "SELECT * FROM categoria WHERE id = $id");

$categoria = mysqli_fetch_assoc($resultado);

if (!$categoria) {
    header("Location: listarCategoria.php");
    exit;
}

include("../includes/header.php");
include("../includes/menuAdmin.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Editar Categoria</h2>

        <hr>

        <form
        action="salvarCategoria.php"
        method="POST">

            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            value="<?= htmlspecialchars($categoria['nome'], ENT_QUOTES) ?>"
            required>

            <br>

            <label>Descrição</label>

            <textarea
            name="descricao"
            class="form-control"><?= htmlspecialchars($categoria['descricao'], ENT_QUOTES) ?></textarea>

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
