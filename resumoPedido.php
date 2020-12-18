<?php
include_once("db.php");
include_once("funcoes.php");
?>

<html>

<head>
    <title>Resumo do Pedido</title>
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
        <h1>Resumo do Pedido</h1>
    </header>

    <br><br>


    <?php
    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];

        $resultadoPedido = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE
            INNER JOIN pizzaria.SITUACAO S ON S.CODI_SITU = P.SITU_PED
            INNER JOIN pizzaria.ENDERECO E ON E.CODI_ENDERECO = P.CODI_ENDERECO 
            INNER JOIN pizzaria.ENTREGADOR ENTR ON ENTR.CODI_ENTR = P.CODI_ENTREGADOR 
            WHERE CODI_PEDIDO = $codiPedido");
    }
    ?>

    <div class="conteudo">
            <table id="tabela" class="tabela">
                <tr>
                    <th> Nº do pedido</th>
                    <th> Nome do Cliente</th>
                    <th> Situação</th>
                    <th> Valor</th>
                    <th> Previsão de entrega</th>
                    <th> Nome do entregador</th>
                    <th> Fone do entregador</th>
                    <th> Endereço de entrega</th>

                    <?php
                    while ($umPedido = $resultadoPedido->fetch_assoc()) {

                        $previsao = $umPedido["PREVISAO_ENTREGA"];
                        $previsaoConvertida = converterDataHora($previsao);

                        $endereco = $umPedido["LOGRADOURO_ENDERECO"] . ', nº' . $umPedido["NUMERO_ENDERECO"] . ' ' . $umPedido["COMPLEMENTO_ENDERECO"] . ', ' . $umPedido["BAIRRO_ENDERECO"];

                        echo "<tr><td>" . $umPedido["CODI_PEDIDO"] . '</td>';
                        echo "<td>" . $umPedido["NOME_CLIENTE"] . '</td>';
                        echo "<td>" . $umPedido["NOME_SITU"] . '</td>';
                        echo "<td>" . ' R$ ' . $umPedido["VALOR_PED"] . '</td>';
                        echo "<td>" . $previsaoConvertida . '</td>';
                        echo "<td>" . $umPedido["NOME_ENTR"] . '</td>';
                        echo "<td>" . $umPedido["FONE_ENTR"] . '</td>';
                        echo "<td>" . $endereco . '</td></tr>';
                    } ?>
            </table>
        </div>
        <a href='menu.php'>Página Inicial</a><br><br>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>