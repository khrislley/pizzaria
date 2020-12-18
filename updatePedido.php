<?php

include_once("db.php");

$codiPedido = $_REQUEST["codiPedido"];
$codiPizza = $_REQUEST["codiPizza"];
$codiItem = $_REQUEST["codiItem"];
$codiSabor = $_REQUEST["codiSabor"];
$codiSabor2 = $_REQUEST["codiSabor2"];
$codiAdicional = $_REQUEST["codiAdicional"];
$codiBorda = $_REQUEST["codiBorda"];
$codiTamanho = $_REQUEST["codiTamanho"];




$tamanho = $conexao->query("SELECT * FROM TAMANHO WHERE CODI_TAMANHO = '$codiTamanho'");
while ($umTamanho = $tamanho->fetch_array()) {
    $valorPizza = $umTamanho["VALOR_TAMANHO"];
}

$valorItem = 0.0;
$valorAdicional = 0.0;

foreach ($codiAdicional as $umAdicional) {
    $adicionais = $conexao->query("SELECT * FROM ADICIONAL WHERE CODI_ADICIONAL = $umAdicional");
    while ($umAdicionalPizza = $adicionais->fetch_array()) {
        $auxValorAdicional = $umAdicionalPizza["VALOR_ADICIONAL"];
        $valorAdicional += $auxValorAdicional;
    }
}

$valorPizzaAdicional = $valorPizza + $valorAdicional;
$valorItem = $valorItem + $valorPizzaAdicional;

foreach ($codiAdicional as $umAdicional) {
    $adicionais = $conexao->query("SELECT * FROM ADICIONAL WHERE CODI_ADICIONAL = $umAdicional");
    while ($umAdicionalPizza = $adicionais->fetch_array()) {
        $auxValorAdicional = $umAdicionalPizza["VALOR_ADICIONAL"];
        $valorAdicional += $auxValorAdicional;
    }
}

if (isset($_REQUEST["codiPedido"])) {

    if ($codiSabor2 == "Selecione") {
        $conexao->query("UPDATE ITENS_PEDIDO SET CODI_SABOR='$codiSabor', CODI_SABOR2 = NULL, CODI_BORDA='$codiBorda', CODI_TAMANHO='$codiTamanho', VALOR_ITEM='$valorItem' WHERE CODI_PEDIDO = $codiPedido;");
        
        $queryDeletarAdicionais = $conexao->query("DELETE FROM AUX_ADICIONAL WHERE CODI_PIZZA = $codiPizza");
        foreach ($codiAdicional as $umAdicional) {
            $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ITEM, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido','$codiItem', '$umAdicional');");
        }
    } else {
        $conexao->query("UPDATE ITENS_PEDIDO SET CODI_SABOR='$codiSabor', CODI_SABOR2='$codiSabor2' CODI_BORDA='$codiBorda', CODI_TAMANHO='$codiTamanho', VALOR_ITEM='$valorItem' WHERE CODI_PEDIDO = $codiPedido;");
        
        $queryDeletarAdicionais = $conexao->query("DELETE FROM AUX_ADICIONAL WHERE CODI_PIZZA = $codiPizza");
        foreach ($codiAdicional as $umAdicional) {
            $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ITEM, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido','$codiItem', '$umAdicional');");
        }
    }
}

$valorItens = $conexao->query("SELECT * FROM ITENS_PEDIDO WHERE CODI_PEDIDO = '$codiPedido'");
while ($umItem = $valorItens->fetch_array()) {
    $valorTotal += $umItem["VALOR_ITEM"];
}

$conexao->query("UPDATE PEDIDO SET VALOR_PED = '$valorTotal' WHERE CODI_PEDIDO='$codiPedido';");

header('location:selecionarItemPedido.php?codiPedido=' . $codiPedido);
