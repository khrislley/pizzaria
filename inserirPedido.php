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
    } else {
        $valorTotal = 0;
    }
    $codiItem = 0;
    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];


        $valorItens = $conexao->query("SELECT * FROM ITENS_PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
        while ($umItem = $valorItens->fetch_array()) {
            $valorTotal += $umItem["VALOR_ITEM"];
            $codiPizza = $umItem["CODI_PIZZA"];

            $codiItem +=1;
            $conexao->query("UPDATE ITENS_PEDIDO SET CODI_ITEM = $codiItem WHERE CODI_PIZZA='$codiPizza';");
        }

        $conexao->query("UPDATE PEDIDO SET VALOR_PED = '$valorTotal' WHERE CODI_PEDIDO='$codiPedido';");

        $aux = $conexao->query("SELECT * FROM ITENS_PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
        while ($umAux = $aux->fetch_array()) {
            $codiPizza = $umAux["CODI_PIZZA"];
            $codiItem = $umAux["CODI_ITEM"];

            $conexao->query("UPDATE AUX_ADICIONAL SET CODI_ITEM = $codiItem WHERE CODI_PIZZA='$codiPizza';");
        }

        $dadosPedido = $conexao->query("SELECT * FROM PEDIDO WHERE CODI_PEDIDO = '$codiPedido';");
        $umPedido = $dadosPedido->fetch_array();
    }


    ?>
    <header>
        <h1>CADASTRO DE PEDIDOS</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirItemPedido.php">

                <label for='codiCliente'>Cliente: </label>
                <select name='codiCliente' id='codiCliente'>
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umCliente = $resultadoCliente->fetch_array()) {
                        $selecionado = "";
                        if ($umCliente["CODI_CLIENTE"] == $umPedido["CODI_CLIENTE"])
                            $selecionado = "selected";
                        echo "<option value='" . $umCliente["CODI_CLIENTE"] . "'$selecionado>" . $umCliente["NOME_CLIENTE"] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for='codiTamanho'>Tamanho: </label>
                <select name='codiTamanho' id='codiTamanho'>
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umTamanho = $resultadoTamanho->fetch_array()) {
                        echo "<option value='" . $umTamanho["CODI_TAMANHO"] . "'>" . $umTamanho["DESC_TAMANHO"] . "</option>";
                    }
                    ?>

                </select><br><br>

                <label for='codiSabor'>1º Sabor: </label>
                <select name='codiSabor' id='codiSabor'>
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umSabor = $resultadoSabor->fetch_array()) {
                        echo "<option value='" . $umSabor["CODI_SABOR"] . "'>" . $umSabor["NOME_SABOR"] . "</option>";
                    }
                    ?>

                </select><br><br>

                <label for='codiSabor2'>2º Sabor(opcional): </label>
                <select name='codiSabor2' id='codiSabor2'>
                    <option>Selecione</option>
                    <?php
                    $query = "SELECT * FROM SABOR";
                    $resultSabor = mysqli_query($conexao, $query);
                    while ($umSabor = $resultSabor->fetch_array()) {
                        echo "<option value='" . $umSabor["CODI_SABOR"] . "'>" . $umSabor["NOME_SABOR"] . "</option>";
                    }
                    ?>

                </select><br><br>


                <label for='codiAdicional'>Adicionais: </label><br>
                <?php
                while ($umAdicional = $resultadoAdicional->fetch_array()) {
                    echo "<input type='checkbox' name='codiAdicional[]' id='codiAdicional' value='" . $umAdicional["CODI_ADICIONAL"] . "'>" . $umAdicional["NOME_ADICIONAL"];
                }
                ?><br><br>


                <label for='codiBorda'>Bordas: </label><br>
                <?php
                while ($umaBorda = $resultadoBorda->fetch_array()) {
                    echo "<input type='radio' name='codiBorda' id='codiBorda' value='" . $umaBorda["CODI_BORDA"] . "'>" . $umaBorda["NOME_BORDA"];
                }
                ?><br><br>

                <label for='codiEndereco'>Endereço: </label>
                <select name='codiEndereco' id='codiEndereco'>
                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM ENDERECO";
                    $resultadoEndereco = mysqli_query($conexao, $query);

                    while ($umEndereco = $resultadoEndereco->fetch_array()) {
                        $selecionado = "";
                        if ($umEndereco["CODI_ENDERECO"] == $umPedido["CODI_ENDERECO"])
                            $selecionado = "selected";
                        echo "<option value='" . $umEndereco["CODI_ENDERECO"] . "'$selecionado>" . $umEndereco["LOGRADOURO_ENDERECO"] . ', nº' . $umEndereco["NUMERO_ENDERECO"] . ' ' . $umEndereco["COMPLEMENTO_ENDERECO"] . ', ' . $umEndereco["BAIRRO_ENDERECO"] . ', ' . $umEndereco["CEP_ENDERECO"] . ', ' . $umEndereco["CIDADE_ENDERECO"] . ', ' . $umEndereco["ESTADO_ENDERECO"] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for='codiEntregador'>Entregador: </label>
                <select name='codiEntregador' id='codiEntregador'>
                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM ENTREGADOR";
                    $resultadoEntregador = mysqli_query($conexao, $query);

                    while ($umEntregador = $resultadoEntregador->fetch_array()) {
                        $selecionado = "";
                        if ($umEntregador["CODI_ENTR"] == $umPedido["CODI_ENTREGADOR"])
                            $selecionado = "selected";
                        echo "<option value='" . $umEntregador["CODI_ENTR"] . "'$selecionado>" . $umEntregador["NOME_ENTR"] . ', ' . $umEntregador["FONE_ENTR"] . "</option>";
                    }
                    ?>
                </select><br><br>

                <?php
                if (isset($_REQUEST["codiPedido"])) {
                    $codiPedido = $_REQUEST["codiPedido"]; ?>
                    <input type="hidden" name='codiPedido' value='<?php echo $codiPedido ?>'> <br>
                <?php } ?>

                <input type="submit" value="Adicionar"> <br>
            </form>

            <form action="resumoPedido.php">
                <input type="hidden" name='codiPedido' value='<?php echo $codiPedido ?>'>
                <input type="submit" value="Avançar"> <br>
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>