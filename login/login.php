<?php
include("../includes/header.php");
?>

<div class="container">

    <div class="container-box">

        <h2>
            Login Administrativo
        </h2>

        <hr>

        <form
        action="validar.php"
        method="POST">

            <label>Login</label>

            <input
            type="text"
            name="login"
            class="form-control"
            required>

            <br>

            <label>Senha</label>

            <input
            type="password"
            name="senha"
            class="form-control"
            required>

            <br>

            <button
            class="btn btn-primary">

                Entrar

            </button>

        </form>

    </div>

</div>

<?php
include("../includes/footer.php");
?>