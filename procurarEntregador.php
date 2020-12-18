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
        <h1>PESQUISAR ENTREGADORES</h1>
    </header>

    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarEntregador.php" id="cont">
                <label>Nome do Entregador: </label>
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

            $queryPesquisa = $conexao->query("SELECT * FROM ENTREGADOR WHERE NOME_ENTR LIKE '%$busca%';");

        ?>

            <br><br><br>

            <table id="tabela" class="tabela">
                <tr>
                    <th> Código</th>
                    <th> Nome</th>
                    <th> Telefone</th>
                    <th> Email</th>
                    <th> CPF</th>

                <?php
                while ($umEntregador = $queryPesquisa->fetch_assoc()) {
                    echo "<tr><td>" . $umEntregador["CODI_ENTR"] . '</td>';
                    echo "<td>" . $umEntregador["NOME_ENTR"] . '</td>';
                    echo "<td>" . $umEntregador["FONE_ENTR"] . '</td>';
                    echo "<td>" . $umEntregador["EMAIL_ENTR"] . '</td>';
                    echo "<td>" . $umEntregador["CPF_ENTR"] . '</td></tr>';
                }
            }
                ?>

            </table>
            <br>
            <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>