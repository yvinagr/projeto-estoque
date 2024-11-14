<?php

// Inclui o arquivo de configuração para conectar ao banco de dados
include 'config.php';


// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];



     // Cria a consulta SQL para inserir um novo produto na tabela 'produtos'
    $sql = "INSERT INTO produtos (produto, fabricante, valor, quantidade, descricao) VALUES ('$produto', '$fabricante', '$valor', '$quantidade', '$descricao')";
    
    // Executa a consulta SQL e verifica se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {

        // Redireciona para a página inicial se a inserção foi bem-sucedida
        header('Location: index.php');
       
        exit(); // Encerra o script após o redirecionamento
    } else {

        // Exibe uma mensagem de erro se a inserção falhar
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
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
        <h2>Adicionar Novo Produto</h2>
        <form method="post" action="">
            <label for="produto">Produto:</label><br>
            <input type="text" name="produto" required><br><br>
            <label for="fabricante">Fabricante:</label><br>
            <input type="text" name="fabricante" required><br><br>
            <label for="valor">Valor:</label><br>
            <input type="text" name="valor" required><br><br>
            <label for="quantidade">Quantidade:</label><br>
            <input type="number" name="quantidade" required><br><br>
            <label for="descricao">Descrição:</label><br>
            <textarea name="descricao"></textarea><br><br>
            <input type="submit" value="Adicionar Produto"><br>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Sistema de Estoque de Produtos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>