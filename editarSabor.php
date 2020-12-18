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
    $codiSabor = $_REQUEST["codiSabor"];
    $dadosSabor = $conexao->query("SELECT * FROM SABOR WHERE CODI_SABOR = $codiSabor;");
    $umSabor = $dadosSabor->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição do Sabor: <?php echo $umSabor["NOME_SABOR"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeSabor"])) {

        $nomeSabor = $_REQUEST["nomeSabor"];
        $codiSabor = $_REQUEST["codiSabor"];

        $conexao->query("UPDATE SABOR SET NOME_SABOR='$nomeSabor' WHERE CODI_SABOR = $codiSabor;");
        $alterou = 1;

        $dadosSabor = $conexao->query("SELECT * FROM SABOR WHERE CODI_SABOR = $codiSabor;");
        $umSabor = $dadosSabor->fetch_array();
    }
    ?>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarSabor.php">
                <label for="nomeSabor">Sabor: </label><input type="text" name="nomeSabor" id="nomeSabor" value="<?php echo $umSabor["NOME_SABOR"]; ?>">
                <br><br>
                <input type="hidden" name="codiSabor" value="<?php echo $codiSabor; ?>">
                <input type="submit" value="Editar">
            </form>


            <form action="selecionarSaborEditar.php">
                <input type="submit" value="Voltar">
            </form>

            <?php if ($alterou == 1)
                echo "Sabor alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>