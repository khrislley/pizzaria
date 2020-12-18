<?php
include_once("db.php");
?>

<html>

<head>
    <title>OFICINA</title>
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

    if (isset($_REQUEST["codiPedido"]) && isset($_REQUEST["situPedido"])) {
        $codiPedido = $_REQUEST["codiPedido"];
        $situPedido = $_REQUEST["situPedido"];
        $codiCliente = $_REQUEST["codiCliente"];
        $codiEndereco = $_REQUEST["codiEndereco"];
        $codiEntregador = $_REQUEST["codiEntregador"];

        $queryUpdatePedido = $conexao->query("UPDATE PEDIDO SET CODI_CLIENTE = $codiCliente, CODI_ENDERECO = $codiEndereco, SITU_PED = $situPedido, CODI_ENTREGADOR = $codiEntregador WHERE CODI_PEDIDO = $codiPedido;");
    }

    $codiPedido = $_REQUEST["codiPedido"];
    $dadosPedido = $conexao->query("SELECT * FROM PEDIDO WHERE CODI_PEDIDO = $codiPedido;");
    $umPedido = $dadosPedido->fetch_array();
    ?>

    <header>
        <h1>Edição do pedido: <?php echo $umPedido["CODI_PEDIDO"];?> </h1>
    </header>

    <div class="conteudo">
        <div class="editar"><br><br>
        <?php 
            if($umPedido["SITU_PED"] == 2)
                echo "O pedido já foi entregue e não pode ser alterado";  
            else{
        ?>
                <form action="editarPedido.php">
                    <label for="situPedido">Situação do orçamento: </label>
                    <select name="situPedido">
                        <?php
                        while ($umaSituacao = $resultadoSituacao->fetch_array()) {
                            $selecionado = "";
                            if ($umaSituacao["CODI_SITU"] == $umPedido["SITU_PED"])
                                $selecionado = "selected";
                            echo "<option value='" . $umaSituacao["CODI_SITU"] . "'$selecionado>" . $umaSituacao["NOME_SITU"] . "</option>";
                        }
                        ?>
                    </select> <br><br>

                    <label for='codiCliente'>Cliente: </label>
                    <select name='codiCliente' id='codiCliente'>
                        <?php
                        while ($umCliente = $resultadoCliente->fetch_array()) {
                            $selecionado = "";
                            if ($umCliente["CODI_CLIENTE"] == $umPedido["CODI_CLIENTE"])
                                $selecionado = "selected";
                            echo "<option value='" . $umCliente["CODI_CLIENTE"] . "'$selecionado>" . $umCliente["NOME_CLIENTE"] . "</option>";
                        }
                        ?>
                    </select><br><br>

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
                    
                    <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                    <br><br>
                    <input type="submit" value="Salvar">
            </form>
            <?php }?>          
            <form action='selecionarItemPedido.php'>
                <input type="hidden" name="codiPedido" value="<?php echo $codiPedido; ?>">
                <input type='submit' value='Avançar'>
            </form>

            <form action='selecionarPedidoEditar.php'>
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