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
    $codiEndereco = $_REQUEST["codiEndereco"];
    $dadosEndereco = $conexao->query("SELECT * FROM ENDERECO WHERE CODI_ENDERECO = $codiEndereco;");
    $umEndereco = $dadosEndereco->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição de Endereço</h1>
    </header>

    <?php
    if (isset($_REQUEST["logradouroEndereco"])) {
        $codiEndereco = $_REQUEST["codiEndereco"];
        $codiCliente = $_REQUEST["codiCliente"];
        $logradouroEndereco = $_REQUEST["logradouroEndereco"];
        $numeroEndereco = $_REQUEST["numeroEndereco"];
        $complementoEndereco = $_REQUEST["complementoEndereco"];
        $bairroEndereco = $_REQUEST["bairroEndereco"];
        $cidadeEndereco = $_REQUEST["cidadeEndereco"];
        $estadoEndereco = $_REQUEST["estadoEndereco"];
        $cepEndereco = $_REQUEST["cepEndereco"];

        $conexao->query("UPDATE ENDERECO SET CODI_CLIENTE='$codiCliente', LOGRADOURO_ENDERECO='$logradouroEndereco',  NUMERO_ENDERECO='$numeroEndereco', COMPLEMENTO_ENDERECO='$complementoEndereco', BAIRRO_ENDERECO='$bairroEndereco', CIDADE_ENDERECO='$cidadeEndereco', ESTADO_ENDERECO='$estadoEndereco', CEP_ENDERECO='$cepEndereco' WHERE CODI_ENDERECO = $codiEndereco;");
        $alterou = 1;

        $dadosEndereco = $conexao->query("SELECT * FROM ENDERECO WHERE CODI_ENDERECO = $codiEndereco;");
        $umEndereco = $dadosEndereco->fetch_array();
    }
    ?>

    <div class="conteudo">
        <div class="editarEndereco"><br><br>
            <form action="editarEndereco.php">
                <label for="codiCliente">Cliente: </label>
                <select name="codiCliente">
                    <?php

                    $query = "SELECT * FROM CLIENTE";
                    $resultadoCliente = mysqli_query($conexao, $query);

                    while ($umCliente = $resultadoCliente->fetch_array()) {
                        $selecionado = "";
                        if ($umCliente["CODI_CLIENTE"] == $umEndereco["CODI_CLIENTE"])
                            $selecionado = "selected";
                        echo "<option value='" . $umCliente["CODI_CLIENTE"] . "'>" . $umCliente["NOME_CLIENTE"] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for="logradouroEndereco">Logradouro: </label><input type="text" name="logradouroEndereco" id="logradouroEndereco" value="<?php echo $umEndereco["LOGRADOURO_ENDERECO"]; ?>"><br><br>
                <label for="numeroEndereco">Número: </label><input type="text" name="numeroEndereco" id="numeroEndereco" value="<?php echo $umEndereco["NUMERO_ENDERECO"]; ?>"><br><br>
                <label for="complementoEndereco">Complemento: </label><input type="text" name="complementoEndereco" id="complementoEndereco" value="<?php echo $umEndereco["COMPLEMENTO_ENDERECO"]; ?>"><br><br>
                <label for="bairroEndereco">Bairro: </label><input type="text" name="bairroEndereco" id="bairroEndereco" value="<?php echo $umEndereco["BAIRRO_ENDERECO"]; ?>"><br><br>
                <label for="cepEndereco">CEP: </label><input type="text" name="cepEndereco" id="cepEndereco" value="<?php echo $umEndereco["CEP_ENDERECO"]; ?>"><br><br>
                <label for="cidadeEndereco">Cidade: </label><input type="text" name="cidadeEndereco" id="cidadeEndereco" value="<?php echo $umEndereco["CIDADE_ENDERECO"]; ?>"><br><br>
                <label for="estadoEndereco">Estado: </label><input type="text" name="estadoEndereco" id="estadoEndereco" value="<?php echo $umEndereco["ESTADO_ENDERECO"]; ?>"><br><br>

                <input type="hidden" name="codiEndereco" value="<?php echo $codiEndereco; ?>"><br><br>
                <input type="submit" value="Editar"><br><br>
            </form>

            <form action="selecionarEnderecoEditar.php">
                <input type="submit" value="Voltar">
            </form>

            <?php if ($alterou == 1)
                echo "Endereço alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>