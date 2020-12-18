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
        <h1>PESQUISAR ENDEREÇOS</h1>
    </header>

    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarEndereco.php">
                <select name="opcao">
                    <option value="1">Cliente</option>
                    <option value="2">Rua</option>
                    <option value="3">Bairro</option>
                    <option value="4">Cidade</option>
                    <option value="5">Estado</option>
                </select>
                <input type="text" name="busca" id="busca"><br><br>
                <input type="submit" value="Procurar">
            </form>
        </div>
        <?php

        if (isset($_REQUEST["busca"])) {
            $busca = $_REQUEST["busca"];
            $opcao = $_REQUEST["opcao"];

            if ($conexao->connect_errno) {
                echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
                exit;
            }

            if ($opcao == 1) {
                $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
            INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE
            WHERE NOME_CLIENTE LIKE '%$busca%';");
            } else if ($opcao == 2) {
                $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
            INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE
            WHERE LOGRADOURO_ENDERECO LIKE '%$busca%';");
            } else if ($opcao == 3) {
                $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
            INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE
            WHERE BAIRRO_ENDERECO LIKE '%$busca%';");
            } else if ($opcao == 4) {
                $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
            INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE
            WHERE CIDADE_ENDERECO LIKE '%$busca%';");
            } else if ($opcao == 5) {
                $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
            INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE
            WHERE ESTADO_ENDERECO LIKE '%$busca%';");
            }

        ?>

            <br><br><br>

            <table id="tabela" class="tabela">
                <tr>
                    <th> Código</th>
                    <th> Nome</th>
                    <th> Logradouro</th>
                    <th> Número</th>
                    <th> Complemento</th>
                    <th> Bairro</th>
                    <th> Cidade</th>
                    <th> Estado</th>

                <?php
                while ($umEndereco = $queryPesquisa->fetch_assoc()) {
                    echo "<tr><td>" . $umEndereco["CODI_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["NOME_CLIENTE"] . '</td>';
                    echo "<td>" . $umEndereco["LOGRADOURO_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["NUMERO_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["COMPLEMENTO_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["BAIRRO_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["CIDADE_ENDERECO"] . '</td>';
                    echo "<td>" . $umEndereco["ESTADO_ENDERECO"] . '</td></tr>';
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