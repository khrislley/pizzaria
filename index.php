<?php
include_once("db.php");
?>

<html>

<head>
    <title>OFICINA</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>
        <h1>BEM VINDO A PIZZARIA</h1>
    </header><br><br>

    <div class='login'><br>
        <form action="index.php">
            Usuário: <input type="text" name="loginUser" id="loginUser" placeholder="Nome do usuário"><br><br>
            Senha: <input type="password" name="senhaUser" id="senhaUser" placeholder="Digite a senha"><br><br>
            <input type="hidden" name="jaDigitou" value="1">
            <input type="submit" value="Logar">
        </form>
    </div>


    <?php
    if (isset($_REQUEST["jaDigitou"])) {

        $loginUser = $_REQUEST["loginUser"];
        $senhaUser = $_REQUEST["senhaUser"];

        $resultadoLogin = $conexao->query("SELECT * FROM FUNCIONARIO WHERE LOGIN_FUNC = '$loginUser' AND SENHA_FUNC = MD5('$senhaUser')");

        if (mysqli_num_rows($resultadoLogin) != 0) {
            session_start();
            $_SESSION['login'] = $loginUser;
            $_SESSION['senha'] = $senhaUser;
            header("location: menu.php");
        } else {
            echo "Usuário e/ou senha inválidos.";
        }
    }

    ?>
    <br>

    <footer>Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.</footer>
</body>

</html>