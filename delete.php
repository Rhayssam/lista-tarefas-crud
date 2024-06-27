<?php
// Incluindo o arquivo da conexão com o Banco de Dados
include('conexao.php');
include('protect.php');
// Execução do SQL de Delete
$id_tarefa = $_GET['id_tarefa'];
$sql_code = "DELETE FROM tarefa WHERE id_tarefa = $id_tarefa";
$sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: " . $mysqli->error);

if($sql_query){
    header("Location: painel.php?msg=Tarefa deletada com sucesso");
} else {
    
}

?>