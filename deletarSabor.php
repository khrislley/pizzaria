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
    
    if (isset($_REQUEST["codiSabor"])) {
        $codiSabor = $_REQUEST["codiSabor"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.SABOR WHERE CODI_SABOR = $codiSabor;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE SABORES</h1>
    </header>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM SABOR");

    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarSabor.php">
                <label for='codiSabor'>Sabor: </label>
                <select name='codiSabor' id='codiSabor'>
                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM SABOR";
                    $resultadoSabor = mysqli_query($conexao, $query);
                    while ($umSabor = $resultadoSabor->fetch_array()) {
                        echo "<option value='" . $umSabor["CODI_SABOR"] . "'>" . $umSabor["NOME_SABOR"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Sabor excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>
    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>