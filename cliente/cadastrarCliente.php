<?php
include("../includes/header.php");
include("../includes/menu.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Novo Cliente</h2>

        <hr>

        <form
        action="salvarCliente.php"
        method="POST">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            required>

            <br>

            <label>CPF</label>

            <input
            type="text"
            name="cpf"
            class="form-control"
            required>

            <br>

            <label>Telefone</label>

            <input
            type="text"
            name="telefone"
            class="form-control">

            <br>

            <label>Email</label>

            <input
            type="email"
            name="email"
            class="form-control">

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