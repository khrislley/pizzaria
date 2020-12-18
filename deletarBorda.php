<?php
include_once("db.php");
include_once("funcoes.php");
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
    
    if (isset($_REQUEST["codiBorda"])) {
        $codiBorda = $_REQUEST["codiBorda"];

        if ($conexao->connect_errno) {
            echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
            exit;
        } else {

            $queryAdicional = $conexao->query("DELETE FROM PIZZARIA.BORDA WHERE CODI_BORDA = $codiBorda;");
            $deletou = 1;
        }
    }
    ?>

    <header>
        <h1>EXCLUSÃO DE BORDAS</h1>
    </header>

    <?php
    if ($conexao->connect_errno) {
        echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
        exit;
    }

    $queryPesquisa = $conexao->query("SELECT * FROM BORDA");

    ?>

    <div class="conteudo">
        <div class="excluir"><br><br>
            <form action="deletarBorda.php">
                <label for='codiBorda'>Bordas: </label>
                <select name='codiBorda' id='codiBorda'>
                    <option disabled selected>Selecione</option>
                    <?php
                    $query = "SELECT * FROM BORDA";
                    $resultadoBorda = mysqli_query($conexao, $query);
                    while ($umaBorda = $resultadoBorda->fetch_array()) {
                        echo "<option value='" . $umaBorda["CODI_BORDA"] . "'>" . $umaBorda["NOME_BORDA"] . "<br>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Excluir">
            </form>

            <?php if ($deletou == 1)
                echo "Borda excluído com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>