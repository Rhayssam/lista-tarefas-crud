<?php
include('conexao.php');
include('protect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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

    <!-- Alerta de inserção de dados -->
    <div class="container">
        <?php
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

        <a href="create.php" class="btn btn-dark mb-3">Adicionar Tarefa</a>

        <p class="text-muted">Pesquisar por tarefa</p>


        <form class="d-flex" role="search" method="post">
            <input class="form-control mb-3" type="search" id="searchtit" placeholder="Pesquisar" aria-label="Search">
        </form>


        <div id="pesquisa"></div>

    </div>

    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!--jquery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>

<script type="text/javascript">
function buscarRes(busca) {
    $.ajax({
        url: "search.php",
        method: "POST",
        data: {
            busca:busca
        },
        success: function(data) {
            $('#pesquisa').html(data);
        }
    });

}

$(document).ready(function() {
    buscarRes();

    $('#searchtit').keyup(function() {
        var busca = $(this).val();
        if (busca != '') {
            buscarRes(busca);
        } else {
            buscarRes();
        }
    });
});
</script>