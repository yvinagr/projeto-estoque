<?php
// Inclui o arquivo de configuração que contém a conexão com o banco de dados
include 'config.php';

// Obtém o ID do produto a ser editado a partir da URL
$id = $_GET['id'];

// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os valores do formulário enviados via POST
    $produto = $_POST['produto'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];

    // Cria a consulta SQL para atualizar os dados do produto
    $sql = "UPDATE produtos SET produto='$produto', fabricante='$fabricante', valor='$valor', quantidade='$quantidade', descricao='$descricao' WHERE id=$id";
    
    // Executa a consulta SQL e verifica se a atualização foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página inicial se a atualização foi bem-sucedida
        header('Location: index.php');
        exit(); // Encerra o script após o redirecionamento
    } else {
        // Exibe uma mensagem de erro se a atualização falhar
        echo "Erro: " . $conn->error;
    }
}

// Cria a consulta SQL para selecionar os dados do produto a ser editado
$sql = "SELECT * FROM produtos WHERE id=$id";
// Executa a consulta SQL
$result = $conn->query($sql);
// Obtém os dados do produto como um array associativo
$produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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
    <h2>Editar Produto</h2>

    <!-- Formulário para edição do produto -->
    <form method="post" action="">
        <label for="produto">Produto:</label><br>
        <!-- Campo de texto para o nome do produto, preenchido com o valor atual -->
        <input type="text" name="produto" value="<?php echo $produto['produto']; ?>" required><br><br>
        <label for="fabricante">Fabricante:</label><br>
        <!-- Campo de texto para o fabricante, preenchido com o valor atual -->
        <input type="text" name="fabricante" value="<?php echo $produto['fabricante']; ?>" required><br><br>
        <label for="valor">Valor:</label><br>
        <!-- Campo de texto para o valor, preenchido com o valor atual -->
        <input type="text" name="valor" value="<?php echo $produto['valor']; ?>" required><br><br>
        <label for="quantidade">Quantidade:</label><br>
        <!-- Campo numérico para a quantidade, preenchido com o valor atual -->
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required><br><br>
        <label for="descricao">Descrição:</label><br>
        <!-- Área de texto para a descrição, preenchida com o valor atual -->
        <textarea name="descricao"><?php echo $produto['descricao']; ?></textarea><br><br>
        <!-- Botão de envio do formulário -->
        <input type="submit" value="Atualizar Produto"><br><br>
    </form>
</main>
<footer>
    <p>&copy; 2024 Sistema de Estoque de Produtos. Todos os direitos reservados.</p>
</footer>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>