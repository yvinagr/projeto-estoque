<?php
include 'config.php';

// Inicializa as variáveis de pesquisa
$search = isset($_POST['search']) ? $_POST['search'] : '';
$searchType = isset($_POST['search_type']) ? $_POST['search_type'] : '';

// Define a consulta SQL com base na pesquisa
$sql = "SELECT * FROM produtos";

// Verifica se o botão "Mostrar Todos" foi clicado
if ($searchType === 'all') {
    $search = ''; // Reseta a pesquisa
    $searchType = ''; // Reseta o tipo de pesquisa
} elseif ($search !== '') {
    $search = $conn->real_escape_string($search); // Escapa o termo de pesquisa para segurança
    if ($searchType === 'id') {
        $sql .= " WHERE id = $search";
    } else {
        $sql .= " WHERE produto LIKE '%$search%'";
    }
}

// Executa a consulta SQL no banco de dados e armazena o resultado na variável $result.
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <title>Sistema de Estoque de Produtos</title> 
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <header>
        <h1>Sistema de Estoque de Produtos</h1> 
    </header>
    <nav>

        <a href="index.php">Home</a> 
        <a href="add_product.php">Cadastro de Produto</a> 
        <a href="pesquisa.php">Pesquisa</a> 
        <a href="logout.php">Sair</a> <!-- Botão de logout -->

    </nav>
    <main>
        <h2>Lista de Produtos</h2>

        <!-- Formulário de Pesquisa -->
        <form method="POST" action="">
            <select name="search_type">
                <option value="name" <?php echo $searchType === 'name' ? 'selected' : ''; ?>>Pesquisar por Nome</option>
                <option value="id" <?php echo $searchType === 'id' ? 'selected' : ''; ?>>Pesquisar por Código (ID)</option>
            </select>
            <input type="text" name="search" placeholder="Digite o valor da pesquisa" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Pesquisar</button>
            <button type="submit" name="search_type" value="all">Mostrar Todos</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Fabricante</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            <?php
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) { 
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['produto']}</td>
                        <td>{$row['fabricante']}</td>
                        <td>{$row['valor']}</td>
                        <td>{$row['quantidade']}</td>
                        <td>{$row['descricao']}</td>
                        <td>
                            <a href='edit_product.php?id={$row['id']}'>Editar</a> | 
                            <a href='#' onclick='confirmDelete({$row['id']})'>Excluir</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum produto encontrado</td></tr>";
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Sistema de Estoque de Produtos. Todos os direitos reservados.</p> 
    </footer>

    <script>
        function confirmDelete(id) {
            const userConfirmed = confirm("Deseja realmente excluir este arquivo?");
            if (userConfirmed) {
                window.location.href = "delete_product.php?id=" + id;
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>