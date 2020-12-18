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

    <header>
        <h1>CADASTRO DE ENDEREÇOS</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirEndereco.php">

                <label for='codiCliente'>Cliente: </label>
                <select name='codiCliente' id='codiCliente'>
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umCliente = $resultadoCliente->fetch_array()) {
                        echo "<option value='" . $umCliente["CODI_CLIENTE"] . "'>" . $umCliente["NOME_CLIENTE"];
                    }
                    ?>
                </select><br><br>


                <!--<label for="logradouroEndereco">Logradouro: </label>--><input type="text" name="logradouroEndereco" id="logradouroEndereco" placeholder="Logradouro"> <br><br>
                <!--<label for="numeroEndereco">Número: </label>--><input type="text" name="numeroEndereco" id="numeroEndereco" placeholder="Número"> <br><br>
                <!--<label for="complementoEndereco">Complemento: </label>--><input type="text" name="complementoEndereco" id="complementoEndereco" placeholder="Complemento"> <br><br>
                <!--<label for="bairroEndereco">Bairro: </label>--><input type="text" name="bairroEndereco" id="bairroEndereco" placeholder="Bairro"> <br><br>
                <!--<label for="cidadeEndereco">Cidade: </label>--><input type="text" name="cidadeEndereco" id="cidadeEndereco" placeholder="Cidade"> <br><br>
                <!--<label for="estadoEndereco">Estado: </label>--><input type="text" name="estadoEndereco" id="estadoEndereco" placeholder="Estado"> <br><br>
                <!--<label for="cepEndereco">CEP: </label>--><input type="text" name="cepEndereco" id="cepEndereco" placeholder="CEP"> <br><br>

                <input type="submit" value="Cadastrar"> <br><br>
            </form>

            <?php
            if (isset($_REQUEST["logradouroEndereco"])) {
                $codiCliente = $_REQUEST["codiCliente"];
                $logradouroEndereco = $_REQUEST["logradouroEndereco"];
                $numeroEndereco = $_REQUEST["numeroEndereco"];
                $complementoEndereco = $_REQUEST["complementoEndereco"];
                $bairroEndereco = $_REQUEST["bairroEndereco"];
                $cidadeEndereco = $_REQUEST["cidadeEndereco"];
                $estadoEndereco = $_REQUEST["estadoEndereco"];
                $cepEndereco = $_REQUEST["cepEndereco"];

                $queryEndereco = $conexao->query("INSERT INTO ENDERECO (CODI_CLIENTE, LOGRADOURO_ENDERECO, NUMERO_ENDERECO, COMPLEMENTO_ENDERECO, BAIRRO_ENDERECO, CIDADE_ENDERECO, ESTADO_ENDERECO, CEP_ENDERECO) VALUES ('$codiCliente', '$logradouroEndereco', '$numeroEndereco', '$complementoEndereco', '$bairroEndereco', '$cidadeEndereco', '$estadoEndereco', '$cepEndereco');");
                echo "<br> Endereco cadastrado com sucesso!<br>";
            }

            ?>
        </div>

        <a href="menu.php">Página inicial</a>

    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>


</body>

</html>