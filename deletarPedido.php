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
    
    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryPedido = $conexao->query("DELETE FROM PIZZARIA.PEDIDO WHERE CODI_PEDIDO = $codiPedido;");
            $queryPedido = $conexao->query("DELETE FROM PIZZARIA.ITENS_PEDIDO WHERE CODI_PEDIDO = $codiPedido;");
            $queryPedido = $conexao->query("DELETE FROM PIZZARIA.AUX_ADICIONAL WHERE CODI_PEDIDO = $codiPedido;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE PEDIDOS</h1>
    </header>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }
    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarPedido.php">
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
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Pedido excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>
    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>