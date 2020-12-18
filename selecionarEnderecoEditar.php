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
        <h1>Edição de endereços</h1>
    </header>

    <div class="conteudo">
        <div class="selecionarEnderecoEditar"><br><br>
        <form action="editarEndereco.php" name="codiEndereco">
            Endereço a ser editado<select name="codiEndereco">
                <option disabled selected>Selecione</option>
                <?php
                while ($umEndereco = $resultadoEndereco->fetch_array()) {
                    echo "<option value='" . $umEndereco["CODI_ENDERECO"] . "'>" . $umEndereco["LOGRADOURO_ENDERECO"] . ', nº' . $umEndereco["NUMERO_ENDERECO"] . ' ' . $umEndereco["COMPLEMENTO_ENDERECO"] . ', ' . $umEndereco["BAIRRO_ENDERECO"] . ', ' . $umEndereco["CEP_ENDERECO"] . ', ' . $umEndereco["CIDADE_ENDERECO"] . ', ' . $umEndereco["ESTADO_ENDERECO"] . "</option>";
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