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
        <h1>Edição de Sabores</h1>
    </header>

    <div class="conteudo">
        <div class="selecionarEditar"><br><br>
            <form action="editarSabor.php" name="codiSabor">
                Sabor a ser editado: <select name="codiSabor">
                    <option disabled selected>Selecione</option>
                    <?php
                    while ($umSabor = $resultadoSabor->fetch_array()) {
                        echo "<option value='" . $umSabor["CODI_SABOR"] . "'>" . $umSabor["NOME_SABOR"] . "</option>";
                    }
                    ?>

                </select><br><br>
                <input type="submit" value="Editar" />
            </form>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>