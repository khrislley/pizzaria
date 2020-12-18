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
        <h1>CADASTRO DE CLIENTES</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirCliente.php">
                <!-- <label for="nomeCliente">Nome do cliente: </label>--><input type="text" name="nomeCliente" id="nomeCliente" placeholder="Nome"> <br><br> 
                <!-- label for="cpfCliente">CPF: </label>--><input type="text" name="cpfCliente" id="cpfCliente" placeholder="CPF"> <br><br>
                <!-- <label for="foneCliente">Telefone: </label>--><input type="text" name="foneCliente" id="foneCliente" placeholder="Telefone"> <br><br>
                <!-- <label for="emailCliente">E-mail: </label>--><input type="text" name="emailCliente" id="emailCliente" placeholder="E-mail"> <br><br>

                <input type="submit" value="Avançar"> <br><br>
            </form>

            <?php
            if (isset($_REQUEST["nomeCliente"])) {
                $nomeCliente = $_REQUEST["nomeCliente"];
                $cpfCliente = $_REQUEST["cpfCliente"];
                $foneCliente = $_REQUEST["foneCliente"];
                $emailCliente = $_REQUEST["emailCliente"];

                $queryClientes = $conexao->query("INSERT INTO CLIENTE (NOME_CLIENTE, CPF_CLIENTE, FONE_CLIENTE, EMAIL_CLIENTE) VALUES ('$nomeCliente', '$cpfCliente', '$foneCliente', '$emailCliente');");
                echo "<br><br>Cliente cadastrado com sucesso! <br>";
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