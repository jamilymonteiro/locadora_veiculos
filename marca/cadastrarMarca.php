<?php
include("../includes/header.php");
include("../includes/menu.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Nova Marca</h2>

        <hr>

        <form
        action="salvarMarca.php"
        method="POST">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            required>

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