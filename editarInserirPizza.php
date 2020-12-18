<?php
include_once("db.php");
?>

<html>

<head>
    <title>PIZZARIA</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./istilo.css">
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


    ?>
    <header>
        <h1>CADASTRO DE PEDIDOS</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="editarInserirItemPizza.php">



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

                <?php
                if (isset($_REQUEST["codiPedido"])) {
                    $codiPedido = $_REQUEST["codiPedido"]; ?>
                    <input type="hidden" name='codiPedido' value='<?php echo $codiPedido ?>'> <br>
                <?php } ?>
                <input type="submit" value="Adicionar"> <br>
            </form>

            <form action="selecionarItemPedido.php">
                <input type="hidden" name='codiPedido' value='<?php echo $codiPedido?>'>
                <input type="submit" value="Voltar"> <br>
            </form>

        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>


</body>

</html>