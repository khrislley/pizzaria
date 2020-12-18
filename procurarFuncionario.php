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
        <h1>PESQUISAR FUNCIONARIO</h1>
    </header>


    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarFuncionario.php">
                <label for="busca">Nome: </label>
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

            $queryPesquisa = $conexao->query("SELECT * FROM FUNCIONARIO F WHERE F.NOME_FUNC LIKE '%$busca%';");

        ?>
            <br><br><br>

            <table id="tabela" class="tabela">
                <tr>
                    <th> Código</th>
                    <th> Nome</th>
                    <th> Login</th>

                <?php
                while ($umFuncionario = $queryPesquisa->fetch_assoc()) {
                    echo "<tr><td>" . $umFuncionario["CODI_FUNC"] . '</td>';
                    echo "<td>" . $umFuncionario["NOME_FUNC"] . '</td>';
                    echo "<td>" . $umFuncionario["LOGIN_FUNC"] . '</td></tr>';
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