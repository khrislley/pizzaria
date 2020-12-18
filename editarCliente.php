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
    $codiCliente = $_REQUEST["codiCliente"];
    $dadosCliente = $conexao->query("SELECT * FROM CLIENTE WHERE CODI_CLIENTE = $codiCliente;");
    $umCliente = $dadosCliente->fetch_array();

    $alterou = 0;
    ?>

    <header>
        <h1>Edição do Cliente: <?php echo $umCliente["NOME_CLIENTE"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeCliente"])) {

        $nomeCliente = $_REQUEST["nomeCliente"];
        $cpfCliente = $_REQUEST["cpfCliente"];
        $foneCliente = $_REQUEST["foneCliente"];
        $emailCliente = $_REQUEST["emailCliente"];

        $conexao->query("UPDATE CLIENTE SET NOME_CLIENTE='$nomeCliente',  CPF_CLIENTE='$cpfCliente', FONE_CLIENTE='$foneCliente', EMAIL_CLIENTE='$emailCliente' WHERE CODI_CLIENTE = $codiCliente;");
        $alterou = 1;

        $dadosCliente = $conexao->query("SELECT * FROM CLIENTE WHERE CODI_CLIENTE = $codiCliente;");
        $umCliente = $dadosCliente->fetch_array();
    }
    ?>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarCliente.php">
                <label for="nomeCliente">Nome: </label><input type="text" name="nomeCliente" id="nomeCliente" value="<?php echo $umCliente["NOME_CLIENTE"]; ?>"><br><br>
                <label for="cpfCliente">CPF: </label><input type="text" name="cpfCliente" id="cpfCliente" value="<?php echo $umCliente["CPF_CLIENTE"]; ?>"><br><br>
                <label for="foneCliente">Telefone: </label><input type="text" name="foneCliente" id="foneCliente" value="<?php echo $umCliente["FONE_CLIENTE"]; ?>"><br><br>
                <label for="emailCliente">E-mail: </label><input type="text" name="emailCliente" id="emailCliente" value="<?php echo $umCliente["EMAIL_CLIENTE"]; ?>"><br><br>
                <input type="hidden" name="codiCliente" value="<?php echo $codiCliente; ?>"><br>

                <input type="submit" value="Editar">
            </form>

            <form action="selecionarClienteEditar.php">
                <input type="submit" value="Voltar">
            </form>

            <?php if ($alterou == 1)
                echo "Cliente alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>