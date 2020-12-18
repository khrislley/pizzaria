<?php
include_once("db.php");
?>

<html>

<head>
    <title>PIZZARIA</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <?php
    session_start();
    if(!isset($_SESSION['login'])){
        echo "ERRO! O usuário não está logado!";
        exit();
    }
    ?>

    <header>
        <h1>CADASTRO DE FUNCIONARIOS</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirFuncionario.php">
                <!-- <label for="nomeFunc">Nome do funcionário: </label> --><input type="text" name="nomeFunc" id="nomeFunc" placeholder="Nome"> <br><br>
                <!-- <label for="userFunc">Usuário: </label>--><input type="text" name="userFunc" id="userFunc" placeholder="Usuário"> <br><br>
                <!-- <label for="senhaFunc">Senha: </label>--><input type="password" name="senhaFunc" id="senhaFunc" placeholder="Senha"> <br><br>

                <input type="submit" value="Cadastrar"> <br><br>
            </form>


            <?php

            if (isset($_REQUEST["nomeFunc"])) {
                $nomeFunc = $_REQUEST["nomeFunc"];
                $userFunc = $_REQUEST["userFunc"];
                $senhaFunc = $_REQUEST["senhaFunc"];

                $queryFuncionarios = $conexao->query("INSERT INTO FUNCIONARIO(NOME_FUNC, LOGIN_FUNC, SENHA_FUNC) VALUES ('$nomeFunc', '$userFunc', MD5('$senhaFunc'))");

                echo "<br> Funcionário cadastrado com sucesso! <br>";
            }
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>


</body>

</html>