<?php
include('conexao.php');
include('protect.php');


if(isset($_POST["busca"])){
    $busca = $_POST["busca"];
    $sql_code = "SELECT * FROM tarefa WHERE id_usuario = ".$_SESSION['id_usuario']." AND titulo LIKE '%".$busca."%' 
    OR id_usuario = ".$_SESSION['id_usuario']." AND descricao LIKE '%".$busca."%'
    OR id_usuario = ".$_SESSION['id_usuario']." AND data_criacao LIKE '%".$busca."%'";
    
    $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);
} else {
    $sql_code = "SELECT id_tarefa, titulo, descricao, data_criacao FROM tarefa WHERE id_usuario = '".$_SESSION['id_usuario']."'";
    $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);
}

    $data ='<table class="table table-hover text-center" style="max-width: 100%;">
            <thead class="table-dark">
                <tr>
                    <b> <th scope="col">Título</th> </b>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de cricação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>';

while($row = mysqli_fetch_assoc($sql_query)){
    $data .= '
                    <tr>
                    <td>'.$row['titulo'].'</td>
                    <td>'.$row['descricao'].'</td>
                    <td>'.$row['data_criacao'].'</td>
                    <td>
                        <a href="edit.php?id_tarefa='.$row['id_tarefa'].'"
                            class="btn btn-primary btn-sm">Editar</a>
                        <a href="delete.php?id_tarefa='.$row['id_tarefa'].'"
                            class="btn btn-danger btn-sm">Deletar</a>
                    </td>
                </tr>
    ';

}
$data .= '</tbody></table>';

echo $data;
?>