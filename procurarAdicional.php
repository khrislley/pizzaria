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
        <h1>PESQUISAR ADICIONAIS</h1>
    </header>

    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarAdicional.php">
                <label>Adicional: </label>
                <input type="text" name="busca" id="busca"><br><br>
                <input type="submit" value="Procurar">
            </form>
        </div>
        <?php

        if (isset($_REQUEST["busca"])) {
            $busca = $_REQUEST["busca"];

            if ($conexao->connect_errno) {
                echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
                exit;
            }

            $queryPesquisa = $conexao->query("SELECT * FROM ADICIONAL WHERE NOME_ADICIONAL LIKE '%$busca%';");

        ?>

            <br><br><br>

            <table border="5" id="tabela" class="tabela">
                <tr>
                    <th> Código</th>
                    <th> Adicional</th>
                    <th> Valor</th>
                <?php
                while ($umAdicional = $queryPesquisa->fetch_assoc()) {
                    echo "<tr><td>" . $umAdicional["CODI_ADICIONAL"] . '</td>';
                    echo "<td>" . $umAdicional["NOME_ADICIONAL"] . '</td>';
                    echo "<td>" ."R$ ".$umAdicional["VALOR_ADICIONAL"] . '</td></tr>';
                }
            }
                ?>

            </table><br>
            <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>