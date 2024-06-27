<?php
// Incluindo o arquivo da conexão com o Banco de Dados
include('conexao.php'); 

if(isset($_POST['usuario']) || isset($_POST['senha'])) {

    // Verifica se o usuário ou a senha estão preenchidos
    if(strlen($_POST['usuario']) == 0){
        header("Location: index.php?msg=Preencha o nome de usuário!");
    } else if (strlen($_POST['senha']) == 0){
        header("Location: createac.php?msg=Preencha a sua senha!");
    } else {
        // Proteção (SQL Injection)
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
    
        // Código SQL
        $sql_code = "SELECT * FROM usuario WHERE nm_usuario = '$usuario ' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);

        // Verifica se a quantidade de resultados igual a zero
        $qtd = $sql_query->num_rows;

        if($qtd == 0){
            
            // Executa o insert da nova conta
            $sql_code =  "INSERT INTO usuario (nm_usuario, senha) VALUES ('$usuario', '$senha')";
            $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);

            $sql_code = "SELECT * FROM usuario WHERE nm_usuario = '$usuario ' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nm_usuario'] = $usuario['nm_usuario'];

            header("Location: painel.php");
            return;
        } else {
            header("Location: createac.php?msg=Usuário já existente");
        }

    } 

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="static\css\style.css" rel="stylesheet">
    <title>Criar conta</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="fundo d-flex align-items-center py-4">
    <?php
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container" id="login">
        <div class="row">
            <div class="box-login col-lg-4 offset-lg-4">
                <h1 class="text-center">Criar conta</h1>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha">
                    </div>
                    <button type="submit" class="btn btn-primary">Criar conta</button>
                    <a href="index.php">Já possuo conta</a>
                </form>
            </div>
        </div>
    </div>

    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>