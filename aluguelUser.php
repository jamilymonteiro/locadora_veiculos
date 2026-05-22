<?php
include("includes/header.php");
include("includes/menu.php");
include("config/conexao.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Meus Aluguéis</h2>

        <hr>

        <form method="GET">

            <label>Digite seu CPF</label>

            <input
            type="text"
            name="cpf"
            class="form-control"
            required>

            <br>

            <button class="btn btn-primary">
                Buscar
            </button>

        </form>

    </div>

    <?php

    if(isset($_GET['cpf'])){

        $cpf = preg_replace('/[^0-9]/', '', $_GET['cpf']);

        $sql = "

        SELECT
        aluguel.*,
        cliente.nome AS cliente,
        veiculo.modelo AS veiculo,
        veiculo.valor_diaria,

        fn_calcular_total_aluguel(
        aluguel.data_inicio,
        aluguel.data_fim,
        veiculo.valor_diaria
        ) AS total,

        fn_quantidade_dias(
        aluguel.data_inicio,
        aluguel.data_fim
        ) AS dias

        FROM aluguel

        INNER JOIN cliente
        ON aluguel.id_cliente = cliente.id

        INNER JOIN veiculo
        ON aluguel.id_veiculo = veiculo.id

        WHERE REPLACE(REPLACE(cliente.cpf,'.',''),'-','') = '$cpf'

        ";

        $resultado = mysqli_query($conexao, $sql);

        if(!$resultado){
            die(mysqli_error($conexao));
        }

    ?>

    <div class="container-box">

        <table class="table">

            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Status</th>
                <th>Valor Diária</th>
                <th>Dias</th>
                <th>Total</th>
            </tr>

            <?php
            while($dados = mysqli_fetch_assoc($resultado)){
            ?>

            <tr>
                <td><?= $dados['id'] ?></td>
                <td><?= $dados['cliente'] ?></td>
                <td><?= $dados['veiculo'] ?></td>
                <td><?= $dados['data_inicio'] ?></td>
                <td><?= $dados['data_fim'] ?></td>
                <td><?= $dados['status'] ?></td>
                <td>R$ <?= $dados['valor_diaria'] ?></td>
                <td><?= $dados['dias'] ?> dias</td>
                <td>
                    R$ <?= number_format($dados['total'], 2, ',', '.') ?>
                </td>
                <td>

                <?php
                if($dados['status'] == 'ATIVO'){
                ?>

                <?php } ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

    <?php } ?>

</div>

<?php
include("includes/footer.php");
?>