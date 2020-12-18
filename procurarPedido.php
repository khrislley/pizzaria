<?php
include_once("db.php");
include_once("funcoes.php");
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
    if (isset($_SESSION['index'])) {
        echo "ERRO! O usuário não está logado!";
        exit();
    }
    ?>

    <header>
        <h1>PESQUISAR PEDIDOS</h1>
    </header>

    <div class="conteudo">
        <div class="procurar"><br><br>
            <form action="procurarPedido.php">
                <select name="opcao">
                    <option value="1">Número do pedido</option>
                    <option value="2">Nome Cliente</option>
                    <option value="3">Pedido aberto</option>
                    <option value="4">Pedido entregue</option>
                    <option value="5">Bairro</option>
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
                $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO
            WHERE P.CODI_PEDIDO LIKE '%$busca%';");
            } else if ($opcao == 2) {
                $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO
            WHERE C.NOME_CLIENTE LIKE '%$busca%';");
            } else if ($opcao == 3) {
                $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO
            WHERE S.CODI_SITU = 1");
            } else if ($opcao == 4) {
                $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO
            WHERE S.CODI_SITU = 2");
            } else if ($opcao == 5) {
                $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO
            WHERE E.BAIRRO_ENDERECO LIKE '%$busca%';");
            }

        ?>

            <br><br><br>
            <table id="tabela" class="tabela">
                <tr>
                    <th> Nº do pedido</th>
                    <th> Nome do Cliente</th>
                    <th> Situação</th>
                    <th> Valor</th>
                    <th> Data/Horário</th>
                    <th> Previsão de entrega</th>
                    <th> Verificar Status</th>

                <?php
                while ($umPedido = $queryPesquisa->fetch_assoc()) {
                    
                    $dataHora = $umPedido["HORARIO_PED"];
                    $dataHoraConvertida = converterDataHora($dataHora);

                    $previsaoEntrega = $umPedido["PREVISAO_ENTREGA"];
                    $previsaoEntregaConvertida = converterDataHora($previsaoEntrega);

                    echo "<tr><td>" . $umPedido["CODI_PEDIDO"] . '</td>';
                    echo "<td>" . $umPedido["NOME_CLIENTE"] . '</td>';
                    echo "<td>" . $umPedido["NOME_SITU"] . '</td>';
                    echo "<td>" . ' R$ ' . $umPedido["VALOR_PED"] . '</td>';
                    echo "<td>" . $dataHoraConvertida . '</td>';
                    echo "<td>" . $previsaoEntregaConvertida . '</td>';
                    echo "<td> <a href='verificarStatus.php?codiPedido=".$umPedido["CODI_PEDIDO"]. "'>Verificar Status</a> </td><tr>";
                }
            }
                ?>
            </table>
            <br>
            <a href="menu.php">Página inicial</a>
    </div>



</body>

</html>