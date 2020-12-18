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
        <h1>CADASTRO DE ADICIONAIS</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirAdicional.php">
                <!---<label for="nomeAdicional">Adicional: </label>---><input type="text" name="nomeAdicional" id="nomeAdicional" placeholder="Adicional"> <br><br>
                <!---<label for="valorAdicional">Valor: </label>---><input type="text" name="valorAdicional" id="valorAdicional" placeholder="Valor"> <br><br>
                <input type="submit" value="Cadastrar"> <br><br>
            </form>


            <?php
            if (isset($_REQUEST["nomeAdicional"])) {
                $nomeAdicional = $_REQUEST["nomeAdicional"];
                $valorAdicional = $_REQUEST["valorAdicional"];

                $queryAdicional = $conexao->query("INSERT INTO ADICIONAL(NOME_ADICIONAL, VALOR_ADICIONAL) VALUES ('$nomeAdicional', '$valorAdicional')");

                echo "<br> Adicional cadastrado com sucesso! <br>";
            }
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>


</body>

</html>