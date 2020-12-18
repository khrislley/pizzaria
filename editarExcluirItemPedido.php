<?php

include_once("db.php");

$codiPedido = $_REQUEST["codiPedido"];
$codiPizza = $_REQUEST["codiPizza"];

$queryDeletarAdicionais = $conexao->query("DELETE FROM ITENS_PEDIDO WHERE CODI_PIZZA = $codiPizza");
$queryDeletarAdicionais = $conexao->query("DELETE FROM AUX_ADICIONAL WHERE CODI_PIZZA = $codiPizza");

header('location:selecionarItemPedido_.php?codiPedido=' . $codiPedido);