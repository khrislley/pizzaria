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
    
    if (isset($_REQUEST["codiEntregador"])) {
        $codiEntregador = $_REQUEST["codiEntregador"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.ENTREGADOR WHERE CODI_ENTR = $codiEntregador;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE ENTREGADORES</h1>
    </header>

    <?php

    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM ENTREGADOR");

    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarEntregador.php">
                <label for='codiEntregador'>Entregador: </label>
                <select name='codiEntregador' id='codiEntregador'>
                    <option disabled selected>NOME / CPF / TELEFONE / EMAIL</option>
                    <?php

                    $query = "SELECT * FROM ENTREGADOR";
                    $resultadoEndereco = mysqli_query($conexao, $query);

                    while ($umEntregador = $resultadoEndereco->fetch_array()) {
                        echo "<option value='" . $umEntregador["CODI_ENTR"] . "'>" . $umEntregador["NOME_ENTR"] . " / " . $umEntregador["CPF_ENTR"] . " / " . $umEntregador["FONE_ENTR"] . " / " . $umEntregador["EMAIL_ENTR"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Entregador excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>