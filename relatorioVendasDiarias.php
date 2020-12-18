<?php
include_once("db.php");
include_once("funcoes.php");
?>

<html>

<head>
    <title>Vendas Diárias</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
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
        <h1>Relatório de Vendas Diárias</h1>
    </header>

    <br><br>
    <form action='relatorioVendasDiarias.php'>
        <label for='dataVendas'>Data: </label><input type='date' name='dataVendas' id='dataVendas' /><br><br>
        <input type='submit' value='Pesquisar'>
    </form>

    <?php
    if (isset($_REQUEST["dataVendas"])) {
        $dataVendas = $_REQUEST["dataVendas"];

        $numVendas = 0;
        $valorTotal = 0;

        $resultadoPedido = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO 
            WHERE HORARIO_PED LIKE '%$dataVendas%'");

    ?>

        <table id="tabela" class="tabela">
            <tr>
                <th> Nº do pedido</th>
                <th> Nome do Cliente</th>
                <th> Situação</th>
                <th> Valor</th>
                <th> Data/Horário</th>

                <?php
                while ($umPedido = $resultadoPedido->fetch_assoc()) {

                    $numVendas++;
                    $valorTotal += $umPedido['VALOR_PED'];

                    $dataHora = $umPedido["HORARIO_PED"];
                    $dataHoraConvertida = converterDataHora($dataHora);

                    echo "<tr><td>" . $umPedido["CODI_PEDIDO"] . '</td>';
                    echo "<td>" . $umPedido["NOME_CLIENTE"] . '</td>';
                    echo "<td>" . $umPedido["NOME_SITU"] . '</td>';
                    echo "<td>" . ' R$ ' . $umPedido["VALOR_PED"] . '</td>';
                    echo "<td>" . $dataHoraConvertida . '</td><tr>';
                } ?>
        </table><br>
    <?php
        $data = converterDataHora($dataVendas);
        echo "No dia ". $data ." foi realizado ". $numVendas . " pedidos . No valor total de R$" . $valorTotal;
    }

    
    ?><br>
    <a href='menu.php'>Página Inicial</a><br><br>
</body>

</html>