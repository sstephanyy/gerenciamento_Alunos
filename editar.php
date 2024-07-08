<?php
include 'config.php'; 

$aluno = null;

// Check if ID is provided via GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch aluno data from database
    $sql = "SELECT * FROM alunos WHERE id=$id";
    $result = $conn->query($sql);
    
    // Check if aluno exists
    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
    } else {
        echo '<div id="error-message" class="alert alert-danger" role="alert">Aluno não encontrado.</div>';
    }
}

// Handle POST request to update aluno
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensalidade = $_POST['mensalidade'];
    $observacao = $_POST['observacao'];
    $situacao = isset($_POST['ativo']) ? 1 : 0; // Se o checkbox estiver marcado, situacao é 1 (ativo); caso contrário, é 0 (inativo)
    
    // Validate required fields
    if (empty($nome) || empty($telefone) || empty($mensalidade)) {
        echo '<div id="error-message" class="alert alert-warning text-warning" role="alert">Nome, Telefone e Mensalidade são campos obrigatórios.</div>';
    } else {
        // Escape user inputs for security
        $nome = mysqli_real_escape_string($conn, $nome);
        $email = mysqli_real_escape_string($conn, $email);
        $telefone = mysqli_real_escape_string($conn, $telefone);
        $mensalidade = mysqli_real_escape_string($conn, $mensalidade);
        $observacao = mysqli_real_escape_string($conn, $observacao);
        
        // Update aluno record in database
        $sql = "UPDATE alunos SET nome='$nome', email='$email', telefone='$telefone', mensalidade='$mensalidade', observacao='$observacao', situacao=IF('$situacao'=1, 'ativo', 'inativo') WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo '<div id="success-message" class="alert alert-success fade show" role="alert">Aluno atualizado com sucesso!</div>';
            header("refresh:3;url=/gerenciamento_alunos/index.php");
            exit();
        } else {
            echo '<div id="error-message" class="alert alert-danger" role="alert">Erro ao atualizar aluno: ' . $conn->error . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header btn-primary text-white">
                    <h2 class="card-title">Editar Aluno</h2>
                </div>
                <div class="card-body">
                    <?php if ($aluno): ?>
                    <form method="post" action="editar.php">
                        <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label text-black">Nome:</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $aluno['nome']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-black">Email:</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $aluno['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-black">Telefone:</label>
                            <input type="tel" name="telefone" class="form-control" value="<?php echo $aluno['telefone']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-black">Valor Mensalidade:</label>
                            <input type="text" name="mensalidade" class="form-control" value="<?php echo $aluno['mensalidade']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-black">Observação:</label>
                            <textarea name="observacao" class="form-control"><?php echo $aluno['observacao']; ?></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" <?php echo ($aluno['situacao'] == 'ativo') ? 'checked' : ''; ?>>
                            <label class="form-check-label text-black" for="ativo">Ativar aluno</label>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                        <a href="/gerenciamento_alunos/index.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                    <?php else: ?>
                    <p class="text-danger">Aluno não encontrado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
