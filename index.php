<?php
include 'config.php'; 

// Verifica se houve uma solicitação para atualizar a situação do aluno
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['updated'])) {
}

// Lógica para filtrar por nome
if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $filtro_nome = $_GET['filter'];
    $sql = "SELECT * FROM alunos WHERE nome LIKE '%$filtro_nome%'";
} else {
    $sql = "SELECT * FROM alunos";
}

$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gerenciamento de Alunos</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Lista de Alunos</h1>
    <a class='btn btn-primary mb-4' href="/gerenciamento_alunos/aluno.php" role="button">Adicionar Aluno</a>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Filtrar por nome" name="filter" id="filterInput" value="<?php echo isset($_GET['filter']) ? $_GET['filter'] : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
        </div>
    </form>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Valor Mensalidade</th>
                    <th>Observação</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['telefone']; ?></td>
                    <td><?php echo $row['mensalidade']; ?></td>
                    <td><?php echo $row['observacao']; ?></td>
                    <td class="situacao">
                        <?php if ($row['situacao'] == 'ativo'): ?>
                            <div class="d-flex text-black">
                                <p class="text-black">Ativo</p>
                                <svg fill="#4bbb06" width="25" height="25" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M16.416 10.283A7.917 7.917 0 1 1 8.5 2.366a7.916 7.916 0 0 1 7.916 7.917zm-2.854-.455a5.154 5.154 0 0 0-.331-1.28 5.087 5.087 0 0 0-.68-1.194 5.008 5.008 0 0 0-.968-.97.792.792 0 0 0-.954 1.264 3.434 3.434 0 0 1 .663.666 3.498 3.498 0 0 1 .468.821 3.587 3.587 0 0 1 .23.887 3.507 3.507 0 0 1-.005.9 3.488 3.488 0 0 1-.687 1.659 3.558 3.558 0 0 1-1.487 1.132 3.653 3.653 0 0 1-.89.23 3.431 3.431 0 0 1-.895-.005 3.637 3.637 0 0 1-.874-.235 3.54 3.54 0 0 1-.793-.456 3.5 3.5 0 0 1-.668-.67 3.464 3.464 0 0 1-.463-.816 3.513 3.513 0 0 1-.22-1.785 3.51 3.51 0 0 1 .234-.87 3.578 3.578 0 0 1 .457-.795 3.472 3.472 0 0 1 .668-.665.792.792 0 0 0-.959-1.26 5.056 5.056 0 0 0-.972.97 5.158 5.158 0 0 0-.658 1.147 5.104 5.104 0 0 0-.022 3.843 5.035 5.035 0 0 0 .675 1.19 5.088 5.088 0 0 0 2.121 1.632 5.23 5.23 0 0 0 1.256.338 5.01 5.01 0 0 0 1.31.009 5.23 5.23 0 0 0 1.277-.33 5.147 5.147 0 0 0 2.166-1.649 5.1 5.1 0 0 0 1-3.708zm-5.858-.223a.792.792 0 1 0 1.584 0V5.429a.792.792 0 1 0-1.584 0z"></path></g></svg>
                            </div>
                        <?php else: ?>
                            <div class="d-flex text-black">
                                <p class="text-black">Inativo</p>
                                <svg fill="#ff0000" width="25" height="25" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M16.416 10.283A7.917 7.917 0 1 1 8.5 2.366a7.916 7.916 0 0 1 7.916 7.917zm-2.854-.455a5.154 5.154 0 0 0-.331-1.28 5.087 5.087 0 0 0-.68-1.194 5.008 5.008 0 0 0-.968-.97.792.792 0 0 0-.954 1.264 3.434 3.434 0 0 1 .663.666 3.498 3.498 0 0 1 .468.821 3.587 3.587 0 0 1 .23.887 3.507 3.507 0 0 1-.005.9 3.488 3.488 0 0 1-.687 1.659 3.558 3.558 0 0 1-1.487 1.132 3.653 3.653 0 0 1-.89.23 3.431 3.431 0 0 1-.895-.005 3.637 3.637 0 0 1-.874-.235 3.54 3.54 0 0 1-.793-.456 3.5 3.5 0 0 1-.668-.67 3.464 3.464 0 0 1-.463-.816 3.513 3.513 0 0 1-.22-1.785 3.51 3.51 0 0 1 .234-.87 3.578 3.578 0 0 1 .457-.795 3.472 3.472 0 0 1 .668-.665.792.792 0 0 0-.959-1.26 5.056 5.056 0 0 0-.972.97 5.158 5.158 0 0 0-.658 1.147 5.104 5.104 0 0 0-.022 3.843 5.035 5.035 0 0 0 .675 1.19 5.088 5.088 0 0 0 2.121 1.632 5.23 5.23 0 0 0 1.256.338 5.01 5.01 0 0 0 1.31.009 5.23 5.23 0 0 0 1.277-.33 5.147 5.147 0 0 0 2.166-1.649 5.1 5.1 0 0 0 1-3.708zm-5.858-.223a.792.792 0 1 0 1.584 0V5.429a.792.792 0 1 0-1.584 0z"></path></g></svg>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex justify-content-start gap-2">
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="deletar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle='modal' data-bs-target='#deleteModal' data-id="<?php echo $row['id']; ?>">Apagar</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-black">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
                Você tem certeza que deseja excluir este aluno?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="confirmDelete" href="#" class="btn btn-danger">Deletar</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; 
        var id = button.getAttribute('data-id'); 
        var confirmDelete = deleteModal.querySelector('#confirmDelete');
        confirmDelete.href = 'deletar.php?id=' + id; 
    });

    // Captura evento de digitação no input de filtro
    document.getElementById('filterInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var nome = row.getElementsByTagName('td')[0].innerText.toLowerCase(); // Coluna do nome
            if (nome.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
