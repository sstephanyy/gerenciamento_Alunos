<?php
include 'config.php';

$success = false;
$emailExists = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensalidade = $_POST['mensalidade'];
    $senha = $_POST['senha'];
    $observacao = $_POST['observacao'];

    // Determine situacao based on checkbox value
    $situacao = isset($_POST['ativo']) ? 'ativo' : 'inativo';

    // Check if email already exists
    $emailCheck = "SELECT * FROM alunos WHERE email = '$email'";
    $result = $conn->query($emailCheck);
    if ($result->num_rows > 0) {
        $emailExists = true;
    } else {
        $sql = "INSERT INTO alunos (nome, email, telefone, mensalidade, senha, situacao, observacao) 
                VALUES ('$nome', '$email', '$telefone', '$mensalidade', '$senha', '$situacao', '$observacao')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            echo "Erro ao adicionar aluno: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Adicionar Aluno</h1>
        <?php if ($success): ?>
            <div id="success-alert" class="alert alert-success">Aluno(a) criado com sucesso!</div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-alert').classList.add('fade-out');
                }, 3000);
            </script>
        <?php endif; ?>
        <?php if ($emailExists): ?>
            <div id="error-alert" class="alert alert-danger">Email já está em uso!</div>
            <script>
                setTimeout(function() {
                    document.getElementById('error-alert').classList.add('fade-out');
                }, 3000);
            </script>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" required>
            </div>
            <div class="mb-3">
                <label for="mensalidade" class="form-label">Valor Mensalidade</label>
                <input type="number" step="0.01" class="form-control" id="mensalidade" name="mensalidade" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <textarea class="form-control" id="observacao" name="observacao"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="ativo">
                <label class="form-check-label" for="ativo">Ativar aluno</label>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
