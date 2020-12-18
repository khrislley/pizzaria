<?php
include_once("db.php");

session_start();
if (!isset($_SESSION['login'])) {
    echo "ERRO! O usuário não está logado!";
    exit();
}


if (isset($_REQUEST["codiPedido"])) {
    $codiPedido = $_REQUEST["codiPedido"];
    $codiCliente = $_REQUEST["codiCliente"];
    $codiSabor = $_REQUEST["codiSabor"];
    $codiSabor2 = $_REQUEST["codiSabor2"];
    $codiTamanho = $_REQUEST["codiTamanho"];
    $codiAdicional = $_REQUEST["codiAdicional"];
    $codiBorda = $_REQUEST["codiBorda"];
    $codiEndereco = $_REQUEST["codiEndereco"];
    $codiEntregador = $_REQUEST["codiEntregador"];

    $valorTotal = 0;

    $tamanho = $conexao->query("SELECT * FROM PIZZARIA.TAMANHO WHERE CODI_TAMANHO = '$codiTamanho'");
    while ($umTamanho = $tamanho->fetch_array()) {
        $valorPizza = $umTamanho["VALOR_TAMANHO"];
    }

    $valorItem = 0.0;
    $valorAdicional = 0.0;

    foreach ($codiAdicional as $umAdicional) {
        $adicionais = $conexao->query("SELECT * FROM PIZZARIA.ADICIONAL WHERE CODI_ADICIONAL = $umAdicional");
        while ($umAdicionalPizza = $adicionais->fetch_array()) {
            $auxValorAdicional = $umAdicionalPizza["VALOR_ADICIONAL"];
            $valorAdicional += $auxValorAdicional;
        }
    }

    $valorPizzaAdicional = $valorPizza + $valorAdicional;
    $valorItem = $valorItem + $valorPizzaAdicional;




    if ($codiSabor2 == "Selecione") {
        $conexao->query("INSERT INTO PIZZARIA.ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiBorda', '$codiTamanho', '$valorItem');");
        $codiPizza = $conexao->insert_id;
        foreach ($codiAdicional as $umAdicional) {
            $conexao->query("INSERT INTO PIZZARIA.AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
        }
    } else {
        $conexao->query("INSERT INTO PIZZARIA.ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_SABOR2, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiSabor2', '$codiBorda', '$codiTamanho', '$valorItem');");
        $codiPizza = $conexao->insert_id;
        foreach ($codiAdicional as $umAdicional) {
            $conexao->query("INSERT INTO PIZZARIA.AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
        }
    }




    $codiItem = 0;

    $valorItens = $conexao->query("SELECT * FROM PIZZARIA.ITENS_PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
    while ($umItem = $valorItens->fetch_array()) {
        $valorTotal += $umItem["VALOR_ITEM"];
        $codiPizza = $umItem["CODI_PIZZA"];

        $codiItem += 1;
        $conexao->query("UPDATE PIZZARIA.ITENS_PEDIDO SET CODI_ITEM = $codiItem WHERE CODI_PIZZA='$codiPizza';");
    }

    $conexao->query("UPDATE PIZZARIA.PEDIDO SET VALOR_PED = '$valorTotal' WHERE CODI_PEDIDO='$codiPedido';");

    $aux = $conexao->query("SELECT * FROM PIZZARIA.ITENS_PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
    while ($umAux = $aux->fetch_array()) {
        $codiPizza = $umAux["CODI_PIZZA"];
        $codiItem = $umAux["CODI_ITEM"];

        $conexao->query("UPDATE PIZZARIA.AUX_ADICIONAL SET CODI_ITEM = $codiItem WHERE CODI_PIZZA='$codiPizza';");
    }
}

header("location:selecionarItemPedido.php?codiPedido=" . $codiPedido);
