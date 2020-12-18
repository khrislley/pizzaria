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
        <h1>PESQUISAR CLIENTES</h1>
    </header>

    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarCliente.php">
                <select name="opcao">
                    <option value="1">Nome</option>
                    <option value="2">CPF</option>
                    <option value="3">Telefone</option>
                    <option value="4">E-mail</option>

                </select>
                <input type="text" name="busca" id="busca"><br><br>
                <input type="submit" value="Procurar">
            </form>
        </div>
        <?php

        if (isset($_REQUEST["busca"])) {

            $opcao = $_REQUEST["opcao"];
            $busca = $_REQUEST["busca"];

            if ($conexao->connect_errno) {
                echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
                exit;
            }

            if ($opcao == 1) {
                $queryPesquisa = $conexao->query("SELECT * FROM CLIENTE WHERE NOME_CLIENTE LIKE '%$busca%';");
            } else if ($opcao == 2) {
                $queryPesquisa = $conexao->query("SELECT * FROM CLIENTE WHERE CPF_CLIENTE LIKE '%$busca%';");
            } else if ($opcao == 3) {
                $queryPesquisa = $conexao->query("SELECT * FROM CLIENTE WHERE FONE_CLIENTE LIKE '%$busca%';");
            } else if ($opcao == 4) {
                $queryPesquisa = $conexao->query("SELECT * FROM CLIENTE WHERE EMAIL_CLIENTE LIKE '%$busca%';");
            }
        ?>

            <br><br>

            <table id="tabela" class="tabela">
                <tr>
                    <th> Código</th>
                    <th> Nome</th>
                    <th> Telefone</th>
                    <th> Email</th>
                    <th> CPF</th>

                <?php
                while ($umCliente = $queryPesquisa->fetch_assoc()) {
                    echo "<tr><td>" . $umCliente["CODI_CLIENTE"] . '</td>';
                    echo "<td>" . $umCliente["NOME_CLIENTE"] . '</td>';
                    echo "<td>" . $umCliente["FONE_CLIENTE"] . '</td>';
                    echo "<td>" . $umCliente["EMAIL_CLIENTE"] . '</td>';
                    echo "<td>" . $umCliente["CPF_CLIENTE"] . '</td></tr>';
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