<?php
include("../includes/header.php");
include("../includes/menuAdmin.php");

?>

<div class="container">

    <div class="container-box">

        <h2>Nova Categoria</h2>

        <hr>

        <form
        action="salvarCategoria.php"
        method="POST">

            <label>Nome</label>

            <input
            type="text"
            name="nome"
            class="form-control"
            required>

            <br>

            <label>Descrição</label>

            <textarea
            name="descricao"
            class="form-control"></textarea>

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