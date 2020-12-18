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
    $codiAdicional = $_REQUEST["codiAdicional"];
    $dadosAdicional = $conexao->query("SELECT * FROM ADICIONAL WHERE CODI_ADICIONAL = $codiAdicional;");
    $umAdicional = $dadosAdicional->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição do Adicional: <?php echo $umAdicional["NOME_ADICIONAL"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeAdicional"])) {
        $codiAdicional = $_REQUEST["codiAdicional"];
        $nomeAdicional = $_REQUEST["nomeAdicional"];
        $valorAdicional = $_REQUEST["valorAdicional"];

        $conexao->query("UPDATE ADICIONAL SET NOME_ADICIONAL='$nomeAdicional', VALOR_ADICIONAL = '$valorAdicional' WHERE CODI_ADICIONAL= $codiAdicional;");
        $alterou = 1;

        $dadosAdicional = $conexao->query("SELECT * FROM ADICIONAL WHERE CODI_ADICIONAL = $codiAdicional;");
        $umAdicional = $dadosAdicional->fetch_array();
    }
    ?>
    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarAdicional.php">
                <label for="nomeAdicional">Adicional: </label> <input type="text" name="nomeAdicional" id="nomeAdicional" value='<?php echo $umAdicional["NOME_ADICIONAL"]; ?>'><br><br>
                <label for="valorAdicional">Valor: </label> <input type="text" name="valorAdicional" id="valorAdicional" value='<?php echo $umAdicional["VALOR_ADICIONAL"]; ?>'><br><br>
                <input type="hidden" name="codiAdicional" value="<?php echo $codiAdicional; ?>">
                <input type="submit" value="Editar">
            </form>

            <form action="selecionarAdicionalEditar.php">
                <input type="submit" value="Voltar">
            </form>

            <?php if ($alterou == 1)
                echo "Adicional alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>