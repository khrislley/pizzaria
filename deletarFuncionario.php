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
    
    if (isset($_REQUEST["codiFunc"])) {
        $codiFunc = $_REQUEST["codiFunc"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.FUNCIONARIO WHERE CODI_FUNC = $codiFunc;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE FUNCIONÁRIOS</h1>
    </header>

    <?php
    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM FUNCIONARIO");
    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarFuncionario.php">
                <label for='codiFunc'>Funcionario: </label>
                <select name='codiFunc' id='codiFunc'>
                    <option disabled selected>Selecione</option>
                    <?php

                    $query = "SELECT * FROM FUNCIONARIO";
                    $resultadoFuncionario = mysqli_query($conexao, $query);

                    while ($umFuncionario = $resultadoFuncionario->fetch_array()) {
                        echo "<option value='" . $umFuncionario["CODI_FUNC"] . "'>" . $umFuncionario["NOME_FUNC"] . " / " . $umFuncionario["LOGIN_FUNC"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Funcionario excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>
    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>