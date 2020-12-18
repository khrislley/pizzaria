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

    <?php

    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];
        $codiPizza = $_REQUEST["codiPizza"];
        $codiItem = $_REQUEST["codiItem"];

        $dadosPedido = $conexao->query("SELECT * FROM PEDIDO WHERE CODI_PEDIDO = '$codiPedido';");
        $umPedido = $dadosPedido->fetch_array();

        $dadosItemPedido = $conexao->query("SELECT * FROM ITENS_PEDIDO WHERE CODI_PIZZA = '$codiPizza';");
        $umItem = $dadosItemPedido->fetch_array();

        $dadosAuxAdicional = $conexao->query("SELECT * FROM AUX_ADICIONAL WHERE CODI_PEDIDO = '$codiPedido' AND CODI_ITEM = $codiItem;");
        $umAuxAdicional = $dadosAuxAdicional->fetch_array();
    }
    ?>

    <header>
        <h1>Edição do pedido: <?php echo $umPedido["CODI_PEDIDO"]; ?> </h1>
    </header>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="updatePedido.php">

                <label for='codiTamanho'>Tamanho: </label>
                <select name='codiTamanho' id='codiTamanho'>
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umTamanho = $resultadoTamanho->fetch_array()) {
                        $selecionado = "";
                        if ($umTamanho["CODI_TAMANHO"] == $umItem["CODI_TAMANHO"])
                            $selecionado = "selected";
                        echo "<option value='" . $umTamanho["CODI_TAMANHO"] . "'$selecionado>" . $umTamanho["DESC_TAMANHO"] . "</option>";
                    }
                    ?>

                </select><br><br>

                <label for='codiSabor'>1º Sabor: </label>
                <select name='codiSabor' id='codiSabor'>
                    <?php
                    while ($umSabor = $resultadoSabor->fetch_array()) {
                        $selecionado = "";
                        if ($umSabor["CODI_SABOR"] == $umItem["CODI_SABOR"])
                            $selecionado = "selected";
                        echo "<option value='" . $umSabor["CODI_SABOR"] . "'$selecionado>" . $umSabor["NOME_SABOR"] . "</option>";
                    }
                    ?>

                </select><br><br>

                <label for='codiSabor2'>2º Sabor(opcional): </label>
                <select name='codiSabor2' id='codiSabor2'>
                    <option>Selecione</option>
                    <?php
                    $query = "SELECT * FROM SABOR";
                    $resultSabor = mysqli_query($conexao, $query);

                    while ($umSabor2 = $resultSabor->fetch_array()) {
                        $selecionado = "";
                        if ($umSabor2["CODI_SABOR"] == $umItem["CODI_SABOR2"])
                            $selecionado = "selected";
                        echo "<option value='" . $umSabor2["CODI_SABOR"] . "'$selecionado>" . $umSabor2["NOME_SABOR"] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for='codiAdicional'>Adicionais: </label><br>
                <?php
                while ($umAdicional = $resultadoAdicional->fetch_array()) {
                    $selecionado = "";
                    $verificaSelecionado = $conexao->query("SELECT * FROM AUX_ADICIONAL WHERE CODI_ADICIONAL='" . $umAdicional["CODI_ADICIONAL"] . "' AND CODI_PEDIDO='$codiPedido' AND CODI_PIZZA='$codiPizza'");
                    if ($verificaSelecionado->num_rows != 0)
                        $selecionado = "checked";
                    echo "<input type='checkbox' name='codiAdicional[]' id='codiAdicional' value='" . $umAdicional["CODI_ADICIONAL"] . "'$selecionado>" . $umAdicional["NOME_ADICIONAL"];
                }
                ?><br><br>

                <label for='codiBorda'>Bordas: </label><br>
                <?php
                while ($umaBorda = $resultadoBorda->fetch_array()) {
                    $selecionado = "";
                    if ($umaBorda["CODI_BORDA"] == $umItem["CODI_BORDA"])
                        $selecionado = "checked";
                    echo "<input type='radio' name='codiBorda' id='codiBorda' value='" . $umaBorda["CODI_BORDA"] . "'$selecionado>" . $umaBorda["NOME_BORDA"];
                }
                ?><br><br>


                <br><br>
                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type="hidden" name="codiItem" value="<?php echo $umItem["CODI_ITEM"]; ?>">
                <input type="hidden" name="codiPizza" value="<?php echo $umItem["CODI_PIZZA"]; ?>">
                <br><br>
                <input type="submit" value="Editar">
            </form>

            <form action='selecionarItemPedido.php'>
                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type='submit' value='Voltar'>
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>


    <footer id="footer" style="font-size: 16px">
        <div">
            Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
            </div>
    </footer>

</body>

</html>