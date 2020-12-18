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

    $queryPesquisa = $conexao->query("SELECT * FROM pizzaria.PEDIDO P
            INNER JOIN pizzaria.CLIENTE C ON C.CODI_CLIENTE = P.CODI_CLIENTE;");
    ?>

    <header>
        <h1>Edição de pedidos</h1>
    </header>

    <div class="conteudo">
        <div class="selecionarEditar"><br><br>
            <form action="editarPedido.php" name="codiPedido">
                Pedido a ser editado: <select name="codiPedido">
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umPedido = $resultadoPedido->fetch_array()) {
                        echo "<option value='" . $umPedido["CODI_PEDIDO"] . "'>" . $umPedido["CODI_PEDIDO"] . "</option>";
                    }
                    ?>

                </select><br><br>
                <input type="submit" value="Editar" />
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>