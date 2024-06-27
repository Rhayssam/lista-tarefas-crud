<?php
include('conexao.php');
include('protect.php');
$id_tarefa = $_GET['id_tarefa'];

if(isset($_POST['submit'])){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $sql_code = "UPDATE tarefa SET titulo = '$titulo', descricao = '$descricao' WHERE id_tarefa = $id_tarefa";
    $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);


    if($sql_query){
        header("Location: painel.php?msg=Tarefa atualizada com sucesso!");
        return; 
    } else {
        echo "Falha";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="static\css\style.css" rel="stylesheet">
    <title>Editar tarefa</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary fs-3 mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lista de Tarefas de <?php echo $_SESSION['nm_usuario']; ?></a>
            <a href="logout.php">Sair</a>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Editar Tarefa</h3>
            <p class="text-muted">Clique em Atualizar depois de alterar as informações</p>
        </div>

        <?php
        $id_tarefa = $_GET['id_tarefa'];
        $sql_code = "SELECT * FROM tarefa WHERE id_tarefa = $id_tarefa";
        $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);
        $row = mysqli_fetch_assoc($sql_query);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row">
                    <div class="col">
                        <label class="form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo" value="<?php echo $row['titulo'];?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição:</label>
                    <textarea type="text" class="form-control" name="descricao"
                        rows="3"><?php echo $row['descricao'];?></textarea>

                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Atualizar</button>
                    <a href="painel.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>