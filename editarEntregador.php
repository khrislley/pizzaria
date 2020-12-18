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
    $codiEntr = $_REQUEST["codiEntr"];
    $dadosEntr = $conexao->query("SELECT * FROM ENTREGADOR WHERE CODI_ENTR = $codiEntr;");
    $umEntr = $dadosEntr->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição do Entregador: <?php echo $umEntr["NOME_ENTR"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeEntr"])) {

        $nomeEntr = $_REQUEST["nomeEntr"];
        $cpfEntr = $_REQUEST["cpfEntr"];
        $foneEntr = $_REQUEST["foneEntr"];
        $emailEntr = $_REQUEST["emailEntr"];

        $conexao->query("UPDATE ENTREGADOR SET NOME_ENTR='$nomeEntr',  CPF_ENTR='$cpfEntr', FONE_ENTR='$foneEntr', EMAIL_ENTR='$emailEntr' WHERE CODI_ENTR = $codiEntr;");
        $alterou = 1;

        $dadosEntr = $conexao->query("SELECT * FROM ENTREGADOR WHERE CODI_ENTR = $codiEntr;");
        $umEntr = $dadosEntr->fetch_array();
    }
    ?>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarEntregador.php">
                <label for="nomeEntr">Nome: </label><input type="text" name="nomeEntr" id="nomeEntr" value="<?php echo $umEntr["NOME_ENTR"]; ?>"><br><br>
                <label for="cpfEntr">CPF: </label><input type="text" name="cpfEntr" id="cpfEntr" value="<?php echo $umEntr["CPF_ENTR"]; ?>"><br><br>
                <label for="foneEntr">Telefone: </label><input type="text" name="foneEntr" id="foneEntr" value="<?php echo $umEntr["FONE_ENTR"]; ?>"><br><br>
                <label for="emailEntr">E-mail: </label><input type="text" name="emailEntr" id="emailEntr" value="<?php echo $umEntr["EMAIL_ENTR"]; ?>"><br><br>
                <input type="hidden" name="codiEntr" value="<?php echo $codiEntr; ?>"><br><br>

                <input type="submit" value="Editar">
            </form>

            <form action="selecionarEntregadorEditar.php">
                <input type="submit" value="Voltar">
            </form>


            <?php if ($alterou == 1)
                echo "Entregador alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>

    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>