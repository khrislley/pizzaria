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

    $deletou = 0;
    
    if (isset($_REQUEST["codiCliente"])) {
        $codiCliente = $_REQUEST["codiCliente"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.CLIENTE WHERE CODI_CLIENTE = $codiCliente;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE CLIENTES</h1>
    </header>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM CLIENTE");

    ?>


    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarCliente.php">
                <label for='codiCliente'>Cliente: </label>
                <select name='codiCliente' id='codiCliente'>
                    <option disabled selected>NOME / CPF / TELEFONE / EMAIL</option>
                    <?php

                    $query = "SELECT * FROM CLIENTE";
                    $resultadoCliente = mysqli_query($conexao, $query);

                    while ($umCliente = $resultadoCliente->fetch_array()) {
                        echo "<option value='" . $umCliente["CODI_CLIENTE"] . "'>" . $umCliente["NOME_CLIENTE"] . " / " . $umCliente["CPF_CLIENTE"] . " / " . $umCliente["FONE_CLIENTE"] . " / " . $umCliente["EMAIL_CLIENTE"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Cliente excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>
    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>