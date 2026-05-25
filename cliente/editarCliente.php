<?php

include("../config/conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listarCliente.php");
    exit;
}

$id = (int) $_GET['id'];

$resultado = mysqli_query($conexao,
    "SELECT * FROM cliente WHERE id = $id");

$cliente = mysqli_fetch_assoc($resultado);

if (!$cliente) {
    header("Location: listarCliente.php");
    exit;
}

include("../includes/header.php");
include("../includes/menu.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Editar Cliente</h2>

        <hr>

        <form
        action="salvarCliente.php"
        method="POST">

            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            value="<?= htmlspecialchars($cliente['nome'], ENT_QUOTES) ?>"
            required>

            <br>

            <label>CPF</label>

            <input
            type="text"
            name="cpf"
            class="form-control"
            value="<?= htmlspecialchars($cliente['cpf'], ENT_QUOTES) ?>"
            required>

            <br>

            <label>Telefone</label>

            <input
            type="text"
            name="telefone"
            class="form-control"
            value="<?= htmlspecialchars($cliente['telefone'], ENT_QUOTES) ?>">

            <br>

            <label>Email</label>

            <input
            type="email"
            name="email"
            class="form-control"
            value="<?= htmlspecialchars($cliente['email'], ENT_QUOTES) ?>">

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
