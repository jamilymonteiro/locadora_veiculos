<?php

include("../config/conexao.php");

$marcas = mysqli_query($conexao,
"SELECT * FROM marca");

$categorias = mysqli_query($conexao,
"SELECT * FROM categoria");

include("../includes/header.php");
include("../includes/menuAdmin.php");

?>

<div class="container">

    <div class="container-box">

        <h2>Novo Veículo</h2>

        <hr>

        <form
        action="salvarVeiculo.php"
        method="POST">

            <label>Modelo</label>

            <input
            type="text"
            name="modelo"
            class="form-control"
            required>

            <br>

            <label>Ano</label>

            <input
            type="number"
            name="ano_fabricacao"
            class="form-control"
            required>

            <br>

            <label>Placa</label>

            <input
            type="text"
            name="placa"
            class="form-control"
            required>

            <br>

            <label>Valor diária</label>

            <input
            type="number"
            step="0.01"
            name="valor_diaria"
            class="form-control"
            required>

            <br>

            <label>Marca</label>

            <select
            name="id_marca"
            class="form-control"
            required>

                <?php
                while($marca =
                mysqli_fetch_assoc($marcas)){
                ?>

                <option
                value="<?= $marca['id'] ?>">

                    <?= $marca['nome'] ?>

                </option>

                <?php } ?>

            </select>

            <br>

            <label>Categoria</label>

            <select
            name="id_categoria"
            class="form-control"
            required>

                <?php
                while($categoria =
                mysqli_fetch_assoc($categorias)){
                ?>

                <option
                value="<?= $categoria['id'] ?>">

                    <?= $categoria['nome'] ?>

                </option>

                <?php } ?>

            </select>

            <br>

            <button
            class="btn btn-primary">
                Salvar
            </button>
            <button
                type="button"
                class="btn btn-secondary"
                onclick="history.back()">
                Cancelar
            </button>

        </form>

    </div>

</div>

<?php
include("../includes/footer.php");
?>