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
    $codiBorda = $_REQUEST["codiBorda"];
    $dadosBorda = $conexao->query("SELECT * FROM BORDA WHERE CODI_BORDA = $codiBorda;");
    $umaBorda = $dadosBorda->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição da Borda: <?php echo $umaBorda["NOME_BORDA"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeBorda"])) {

        $nomeBorda = $_REQUEST["nomeBorda"];
        $codiBorda = $_REQUEST["codiBorda"];

        $conexao->query("UPDATE BORDA SET NOME_BORDA='$nomeBorda' WHERE CODI_BORDA= $codiBorda;");
        $alterou = 1;

        $dadosBorda = $conexao->query("SELECT * FROM BORDA WHERE CODI_BORDA = $codiBorda;");
        $umaBorda = $dadosBorda->fetch_array();
    }
    ?>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarBorda.php">
                <label for="nomeBorda">Borda: </label> <input type="text" name="nomeBorda" id="nomeBorda" value='<?php echo $umaBorda["NOME_BORDA"]; ?>'><br><br>
                <input type="hidden" name="codiBorda" value="<?php echo $codiBorda; ?>">
                <input type="submit" value="Editar">
            </form>

            <form action="selecionarBordaEditar.php">
                <input type="submit" value="Voltar">
            </form>


            <?php if ($alterou == 1)
                echo "Borda alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>