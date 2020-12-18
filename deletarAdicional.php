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
    
    if (isset($_REQUEST["codiAdicional"])) {
        $codiAdicional = $_REQUEST["codiAdicional"];


        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.ADICIONAL WHERE CODI_ADICIONAL = $codiAdicional;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE ADICIONAIS</h1>
    </header>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM ADICIONAL");

    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarAdicional.php">
                <label for='codiAdicional'>Adicionais: </label>
                <select name='codiAdicional' id='codiAdicional'>

                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM ADICIONAL";
                    $resultadoAdicional = mysqli_query($conexao, $query);

                    while ($umAdicional = $resultadoAdicional->fetch_array()) {
                        echo "<option value='" . $umAdicional["CODI_ADICIONAL"] . "'>" . $umAdicional["NOME_ADICIONAL"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">


            </form>

            <?php if ($deletou == 1)
                echo "Adicional excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>