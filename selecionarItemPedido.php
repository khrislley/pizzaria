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

    if (isset($_REQUEST["codiPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];

        $queryPedido = $conexao->query("SELECT * FROM pizzaria.PEDIDO P WHERE P.CODI_PEDIDO = $codiPedido");

        $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.ITENS_PEDIDO IP
            INNER JOIN pizzaria.SABOR S ON S.CODI_SABOR = IP.CODI_SABOR
            INNER JOIN pizzaria.TAMANHO T ON T.CODI_TAMANHO = IP.CODI_TAMANHO
            WHERE IP.CODI_PEDIDO = $codiPedido;");
    }

    
        

    ?>

    <header>
        <h1>Edição do pedido: <?php echo $codiPedido; ?> </h1>
    </header>

    <div class="conteudo">
        <div class="editar"><br><br>
        <?php
        $umPedido = $queryPedido->fetch_array();

            if($umPedido['SITU_PED'] == 2){
                echo "O pedido já foi entregue e não pode ser alterado";
        ?>
                <form action='menu.php'>
                <table id="tabela" class="tabela">
                    <tr>
                        <th> Nº do item</th>
                        <th> Sabor</th>
                        <th> Tamanho</th>
                        <th> Valor</th>

                        <?php
                        while ($umItem = $queryPesquisa->fetch_assoc()) {

                            echo "<tr><td>" . $umItem["CODI_ITEM"] . '</td>';
                            echo "<td>" . $umItem["NOME_SABOR"] . '</td>';
                            echo "<td>" . $umItem["DESC_TAMANHO"] . '</td>';
                            echo "<td>" . ' R$ ' . $umItem["VALOR_ITEM"] . '</td>';
                        }
                        ?>
                </table><br>

                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type='submit' value='Finalizar'>
            </form>
           <?php 
            }else{

       ?>
            <form action='menu.php'>
                <table id="tabela" class="tabela">
                    <tr>
                        <th> Nº do item</th>
                        <th> Sabor</th>
                        <th> Tamanho</th>
                        <th> Valor</th>
                        <th> Editar</th>
                        <th> Excluir</th>


                        <?php
                        while ($umItem = $queryPesquisa->fetch_assoc()) {

                            echo "<tr><td>" . $umItem["CODI_ITEM"] . '</td>';
                            echo "<td>" . $umItem["NOME_SABOR"] . '</td>';
                            echo "<td>" . $umItem["DESC_TAMANHO"] . '</td>';
                            echo "<td>" . ' R$ ' . $umItem["VALOR_ITEM"] . '</td>';
                            echo "<td> <a href='editarItemPedido.php?codiPedido=" . $umItem["CODI_PEDIDO"] . "&codiPizza=" . $umItem["CODI_PIZZA"] . "&codiItem=" . $umItem["CODI_ITEM"] . "'>Editar</a></td>";
                            echo "<td> <a href='editarExcluirItemPedido.php?codiPedido=" . $umItem["CODI_PEDIDO"] . "&codiPizza=" . $umItem["CODI_PIZZA"] . "'>Excluir</a></td><tr>";
                        }

                        ?>
                </table><br>
                <a href='editarInserirPizza.php?codiPedido=<?php echo $codiPedido; ?>'>Inserir nova pizza</a><br><br>

                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type='submit' value='Finalizar'>
            </form>
                    <?php } ?>
            <form action='editarPedido.php'>
                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type='submit' value='Voltar'>
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
            Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>