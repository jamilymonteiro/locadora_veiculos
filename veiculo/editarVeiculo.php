<?php

include("../includes/verificaAdmin.php");
include("../config/conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listarVeiculo.php");
    exit;
}

$id = (int) $_GET['id'];

$resultado = mysqli_query($conexao,
    "SELECT * FROM veiculo WHERE id = $id");

$veiculo = mysqli_fetch_assoc($resultado);

if (!$veiculo) {
    header("Location: listarVeiculo.php");
    exit;
}

$marcas = mysqli_query($conexao,
    "SELECT * FROM marca");

$categorias = mysqli_query($conexao,
    "SELECT * FROM categoria");

include("../includes/header.php");
include("../includes/menuAdmin.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Editar Veículo</h2>

        <hr>

        <form
        action="salvarVeiculo.php"
        method="POST">

            <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">

            <label>Modelo</label>

            <input
            type="text"
            name="modelo"
            class="form-control"
            value="<?= htmlspecialchars($veiculo['modelo'], ENT_QUOTES) ?>"
            required>

            <br>

            <label>Ano</label>

            <input
            type="number"
            name="ano_fabricacao"
            class="form-control"
            value="<?= $veiculo['ano_fabricacao'] ?>"
            required>

            <br>

            <label>Placa</label>

            <input
            type="text"
            name="placa"
            class="form-control"
            value="<?= htmlspecialchars($veiculo['placa'], ENT_QUOTES) ?>"
            required>

            <br>

            <label>Valor diária</label>

            <input
            type="number"
            step="0.01"
            name="valor_diaria"
            class="form-control"
            value="<?= $veiculo['valor_diaria'] ?>"
            required>

            <br>

            <label>Marca</label>

            <select
            name="id_marca"
            class="form-control"
            required>

                <?php while ($marca = mysqli_fetch_assoc($marcas)) { ?>

                <option value="<?= $marca['id'] ?>" <?= $marca['id'] == $veiculo['id_marca'] ? 'selected' : '' ?> >
                    <?= htmlspecialchars($marca['nome'], ENT_QUOTES) ?>
                </option>

                <?php } ?>

            </select>

            <br>

            <label>Categoria</label>

            <select
            name="id_categoria"
            class="form-control"
            required>

                <?php while ($categoria = mysqli_fetch_assoc($categorias)) { ?>

                <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $veiculo['id_categoria'] ? 'selected' : '' ?> >
                    <?= htmlspecialchars($categoria['nome'], ENT_QUOTES) ?>
                </option>

                <?php } ?>

            </select>

            <br>

            <button class="btn btn-primary">
                Salvar alterações
            </button>

        </form>

    </div>

</div>

<?php
include("../includes/footer.php");
?>
