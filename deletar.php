<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM alunos WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo '<div id="success-message" class="alert alert-success fade show" role="alert">Aluno deletado com sucesso!</div>';
} else {
    echo "Erro ao excluir aluno: " . $conn->error;
}

header("Location: /gerenciamento_alunos/index.php");
exit();
?>
