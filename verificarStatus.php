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
    if(!isset($_SESSION['login'])){
        echo "ERRO! O usuário não está logado!";
        exit();
    }
    ?>

    <header>
        <h1>VERIFICAÇÃO DE STATUS DO PEDIDO</h1>
    </header>

    <?php
    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];

        $queryPedido = $conexao->query("SELECT * FROM PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
        while ($umPedido = $queryPedido->fetch_assoc()) {
            $previsaoEntrega = $umPedido['PREVISAO_ENTREGA'];
            $valor = $umPedido['VALOR_PED'];
            $verificaStatus = $umPedido['VERIFICA_STATUS'];
            $situPed = $umPedido['SITU_PED'];
        }


        $verificaTempo = $conexao->query("SELECT TIMEDIFF(current_timestamp(), '$previsaoEntrega') AS DIFERENCA;");
        while ($umTempo = $verificaTempo->fetch_assoc()) {
            $atraso = $umTempo['DIFERENCA'];
        }

        $atrasoString = converterHorarioEmString($atraso);

        if ($situPed == 2) {
            echo "<br><h3>O pedido " . $codiPedido . " já foi entregue<h3>";
        } else if ($atrasoString > "00:30:00") {
            if ($verificaStatus == 0) {
                echo "<br><h3>O pedido " . $codiPedido . " está atrasado em mais de 30 minutos, portanto pedido terá um desconto de 50%<h3>";
                $valorPedDesconto = $valor / 2;
                echo "O valor do pedido será de R$ " . $valorPedDesconto;
                $queryPedido = $conexao->query("UPDATE PEDIDO SET VALOR_PED = " . $valorPedDesconto . ", VERIFICA_STATUS = 1 WHERE CODI_PEDIDO = '$codiPedido'");
            } else {
                echo "<br><h3>O pedido " . $codiPedido . " está atrasado em mais de 30 minutos, e já recebeu o desconto de 50%<h3>";
            }
        } else if ($atrasoString < "00:30:00" && $atrasoString > "00:00:00") {
            echo "<br><h3>O pedido " . $codiPedido . " está com um atraso de " . $atrasoString . "minutos, caso ultrapasse 30 minutos o pedido terá um desconto de 50%<h3>";
        } else {
            echo "<br><h3>O pedido " . $codiPedido . " ainda está dentro do prazo de entrega";
        }
    }

    ?>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }
    ?>

    <div class="conteudo">
        <div class="status"><br><br>
            <form action="verificarStatus.php">
                <label for='codiPedido'>Pedido: </label>
                <select name='codiPedido' id='codiPedido'>
                    <option disabled selected>Selecione</option>
                    <?php

                    $query = "SELECT * FROM PEDIDO";
                    $resultadoPedido = mysqli_query($conexao, $query);

                    while ($umPedido = $resultadoPedido->fetch_array()) {
                        echo "<option value='" . $umPedido["CODI_PEDIDO"] . "'>" . $umPedido["CODI_PEDIDO"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Verificar">
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>