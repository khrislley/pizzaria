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
    $codiFunc = $_REQUEST["codiFunc"];
    $dadosFunc = $conexao->query("SELECT * FROM FUNCIONARIO WHERE CODI_FUNC = $codiFunc;");
    $umFunc = $dadosFunc->fetch_array();
    $alterou = 0;
    ?>

    <header>
        <h1>Edição do Funcionário: <?php echo $umFunc["NOME_FUNC"]; ?> </h1>
    </header>

    <?php
    if (isset($_REQUEST["nomeFunc"])) {

        $nomeFunc = $_REQUEST["nomeFunc"];
        $loginFunc = $_REQUEST["loginFunc"];
        $senhaFunc = $_REQUEST["senhaFunc"];

        if ($senhaFunc == "") {
            $conexao->query("UPDATE FUNCIONARIO SET NOME_FUNC='$nomeFunc',  LOGIN_FUNC='$loginFunc' WHERE CODI_FUNC = $codiFunc;");
            $alterou = 1;
        } else {
            $conexao->query("UPDATE FUNCIONARIO SET NOME_FUNC='$nomeFunc',  LOGIN_FUNC='$loginFunc', SENHA_FUNC= MD5('$senhaFunc') WHERE CODI_FUNC = $codiFunc;");
            $alterou = 1;
        }

        $dadosFunc = $conexao->query("SELECT * FROM FUNCIONARIO WHERE CODI_FUNC = $codiFunc;");
        $umFunc = $dadosFunc->fetch_array();
    }


    ?>

    <div class="conteudo">
        <div class="editar"><br><br>
            <form action="editarFuncionario.php">
                <label for="nomeFunc">Nome do Funcionário: </label><input type="text" name="nomeFunc" id="nomeFunc" value="<?php echo $umFunc["NOME_FUNC"]; ?>">
                <br><br>
                <label for="loginFunc">Login do Funcionário: </label><input type="text" name="loginFunc" id="loginFunc" value="<?php echo $umFunc["LOGIN_FUNC"]; ?>">
                <br><br>
                <label for="senhaFunc">Senha: </label><input type="password" name="senhaFunc" id="senhaFunc">
                <br><br>
                <!-- <input type="hidden" name="senhaFunc" value="<?php //echo $senhaFunc; 
                                                                    ?>"> -->
                <input type="hidden" name="codiFunc" value="<?php echo $codiFunc; ?>">
                <br><br>
                <input type="submit" value="Editar">
            </form>

            <form action="selecionarFuncionarioEditar.php">
                <input type="submit" value="Voltar">
            </form>

            <?php if ($alterou == 1)
                echo "Funcionário alterado com sucesso! <br><br> ";
            ?>
        </div><br>
        <a href="menu.php">Página inicial</a>
    </div>

    <footer id="footer" style="font-size: 16px">
        Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.
    </footer>

</body>

</html>