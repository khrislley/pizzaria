<?php
    include_once("db.php");



    session_start();
    if(!isset($_SESSION['login'])){
        echo "ERRO! O usuário não está logado!";
        exit();
    }

    if (isset($_REQUEST["codiCliente"])) {
        $codiCliente = $_REQUEST["codiCliente"];
        $codiSabor = $_REQUEST["codiSabor"];
        $codiSabor2 = $_REQUEST["codiSabor2"];
        $codiTamanho = $_REQUEST["codiTamanho"];
        $codiAdicional = $_REQUEST["codiAdicional"];
        $codiBorda = $_REQUEST["codiBorda"];
        $codiEndereco = $_REQUEST["codiEndereco"];
        $codiPedido = $_REQUEST["codiPedido"];
        $codiEntregador = $_REQUEST["codiEntregador"];

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

        if (isset($_REQUEST["codiPedido"])) {

            if($codiSabor2 == "Selecione"){
                $conexao->query("INSERT INTO ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiBorda', '$codiTamanho', '$valorItem');");
                $codiPizza = $conexao->insert_id;
                foreach ($codiAdicional as $umAdicional) {
                    $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
                }
            }else{


                
                $conexao->query("INSERT INTO ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_SABOR2, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiSabor2', '$codiBorda', '$codiTamanho', '$valorItem');");
                $codiPizza = $conexao->insert_id;         
                foreach ($codiAdicional as $umAdicional) {
                    $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
                }
            }  

            
        } else {

            $conexao->query("INSERT INTO PEDIDO (CODI_CLIENTE, CODI_ENDERECO, CODI_ENTREGADOR, SITU_PED, HORARIO_PED, PREVISAO_ENTREGA, VERIFICA_STATUS) VALUES ('$codiCliente','$codiEndereco', '$codiEntregador', '1', CURRENT_TIMESTAMP(), ADDTIME(current_timestamp(), '1:00:00'), 0);");
            $codiPedido = $conexao->insert_id;

            if($codiSabor2 == "Selecione"){
                $conexao->query("INSERT INTO ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiBorda', '$codiTamanho', '$valorItem');");
                $codiPizza = $conexao->insert_id;
                foreach ($codiAdicional as $umAdicional) {
                    $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
                }

            }else{
                $conexao->query("INSERT INTO ITENS_PEDIDO(CODI_PEDIDO, CODI_SABOR, CODI_SABOR2, CODI_BORDA, CODI_TAMANHO, VALOR_ITEM) VALUES ('$codiPedido', '$codiSabor', '$codiSabor2', '$codiBorda', '$codiTamanho', '$valorItem');");
                $codiPizza = $conexao->insert_id;
                foreach ($codiAdicional as $umAdicional) {
                    $conexao->query("INSERT INTO AUX_ADICIONAL(CODI_PIZZA, CODI_PEDIDO, CODI_ADICIONAL) VALUES ('$codiPizza', '$codiPedido', '$umAdicional');");
                }
            } 

        }
        header("location:inserirPedido.php?codiPedido=$codiPedido");        
    
    }
