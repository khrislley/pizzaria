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
        <h1>CADASTRO DE SABORES</h1>
    </header>

    <div class="conteudo">
        <div class="cadastrar"><br><br>
            <form action="inserirSabor.php">
                <label for="nomeSabor">Sabor:  </label><input type="text" name="nomeSabor" id="nomeSabor"> <br><br>
                <input type="submit" value="Cadastrar"> <br><br>
            </form>


            <?php
            if (isset($_REQUEST["nomeSabor"])) {
                $nomeSabor = $_REQUEST["nomeSabor"];

                $querySabor = $conexao->query("INSERT INTO SABOR(NOME_SABOR, PRECO_TAM_P, PRECO_TAM_M, PRECO_TAM_G, PRECO_TAM_GG) VALUES ('$nomeSabor', 25, 35, 45, 55)");

                echo "<br> Sabor cadastrado com sucesso! <br>";
            }
            ?>
        </div>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>


</body>

</html>