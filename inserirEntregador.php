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
        <h1>CADASTRO DE ENTREGADORES</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirEntregador.php">
                <!-- <label for="nomeEntr">Nome do entregador: </label>--><input type="text" name="nomeEntr" id="nomeEntr" placeholder="Nome entregador"> <br><br>
                <!-- <label for="cpfEntr">CPF: </label>--><input type="text" name="cpfEntr" id="cpfEntr" placeholder="CPF"> <br><br>
                <!-- <label for="foneEntr">Telefone: </label>--><input type="text" name="foneEntr" id="foneEntr" placeholder="Telefone"> <br><br>
                <!-- <label for="emailEntr">E-mail: </label>--><input type="text" name="emailEntr" id="emailEntr" placeholder="E-mail"> <br><br>

                <input type="submit" value="Cadastrar"> <br><br>
            </form>


            <?php

            if (isset($_REQUEST["nomeEntr"])) {
                $nomeEntr = $_REQUEST["nomeEntr"];
                $cpfEntr = $_REQUEST["cpfEntr"];
                $foneEntr = $_REQUEST["foneEntr"];
                $emailEntr = $_REQUEST["emailEntr"];

                $queryEntregadores = $conexao->query("INSERT INTO ENTREGADOR(NOME_ENTR, CPF_ENTR, FONE_ENTR, EMAIL_ENTR) VALUES ('$nomeEntr', '$cpfEntr', '$foneEntr', '$emailEntr');");

                echo "<br> Entregador cadastrado com sucesso! <br><br><br>";
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