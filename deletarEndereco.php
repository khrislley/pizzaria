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

    $deletou = 0;
    
    if (isset($_REQUEST["codiEndereco"])) {
        $codiEndereco = $_REQUEST["codiEndereco"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.ENDERECO WHERE CODI_ENDERECO = $codiEndereco;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE ENDERECOS</h1>
    </header>

    <?php
    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM ENDERECO E
    INNER JOIN CLIENTE C ON C.CODI_CLIENTE = E.CODI_CLIENTE");

    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarEndereco.php">
                <label for='codiEndereco'>Endereço: </label>
                <select name='codiEndereco' id='codiEndereco'>
                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM ENDERECO";
                    $resultadoEndereco = mysqli_query($conexao, $query);

                    while ($umEndereco = $resultadoEndereco->fetch_array()) {
                        echo "<option value='" . $umEndereco["CODI_ENDERECO"] . "'>" . $umEndereco["LOGRADOURO_ENDERECO"] . ', nº' . $umEndereco["NUMERO_ENDERECO"] . ' ' . $umEndereco["COMPLEMENTO_ENDERECO"] . ', ' . $umEndereco["BAIRRO_ENDERECO"] . ', ' . $umEndereco["CEP_ENDERECO"] . ', ' . $umEndereco["CIDADE_ENDERECO"] . ', ' . $umEndereco["ESTADO_ENDERECO"] . "</option>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Endereço excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>