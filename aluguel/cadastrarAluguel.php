<?php

include("../config/conexao.php");

$clientes = mysqli_query($conexao,
"SELECT * FROM cliente");

$veiculos = mysqli_query($conexao,
"SELECT * FROM veiculo
WHERE status = true");

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <h2>Novo Aluguel</h2>

        <hr>

        <form
        action="salvarAluguel.php"
        method="POST">

            <label>Cliente</label>

            <select
            name="id_cliente"
            class="form-control"
            required>

                <?php
                while($cliente =
                mysqli_fetch_assoc($clientes)){
                ?>

                <option
                value="<?= $cliente['id'] ?>">

                    <?= $cliente['nome'] ?>

                </option>

                <?php } ?>

            </select>

            <br>

            <label>Veículo</label>

            <select
            name="id_veiculo"
            class="form-control"
            required>

                <?php
                while($veiculo =
                mysqli_fetch_assoc($veiculos)){
                ?>

                <option
                value="<?= $veiculo['id'] ?>">

                    <?= $veiculo['modelo'] ?>

                </option>

                <?php } ?>

            </select>

            <br>

            <label>Data início</label>

            <input
            type="date"
            name="data_inicio"
            class="form-control"
            required>

            <br>

            <label>Data fim</label>

            <input
            type="date"
            name="data_fim"
            class="form-control"
            required>

            <br>

            <label>Forma pagamento</label>

            <select
            name="pagamento_tipo"
            class="form-control">

                <option>PIX</option>
                <option>CARTAO</option>
                <option>DINHEIRO</option>

            </select>

            <br>

            <button
            class="btn btn-primary">
                Finalizar aluguel
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