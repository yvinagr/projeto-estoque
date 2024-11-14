<?php
// Inclui o arquivo de configuração que deve conter as informações para conectar ao banco de dados.
include 'config.php';
session_start();

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Obter produtos - Define a consulta SQL para selecionar todos os produtos da tabela 'produtos'.
$sql = "SELECT * FROM produtos";

// Executa a consulta SQL no banco de dados e armazena o resultado na variável $result.
$result = $conn->query($sql); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <title>Sistema de Estoque de Produtos</title> 
    <link rel="stylesheet" href="styles.css"> 

    <script>
        function confirmDelete(id) {
            if (confirm("Deseja realmente excluir este arquivo?")) {
                window.location.href = "delete_product.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <h1>Sistema de Estoque de Produtos</h1> 
    </header>
    <nav>
        <a href="index.php">Home</a> 
        <a href="add_product.php">Cadastro de Produto</a> 
        <a href="pesquisa.php">Pesquisa</a> 
        <a href="logout.php">Sair</a> <!-- Botão de logout -->
    </nav>
    <!--Conteúdo -->
    <main>
        <h2>Lista de Produtos</h2> 
        <table>
            <tr>
                <!-- Cabeçalhos das colunas da tabela -->
                <th>ID</th> <!-- Cabeçalho da coluna para o ID do produto. -->
                <th>Produto</th> <!-- Cabeçalho da coluna para o nome do produto. -->
                <th>Fabricante</th> <!-- Cabeçalho da coluna para o fabricante do produto. -->
                <th>Valor</th> <!-- Cabeçalho da coluna para o valor do produto. -->
                <th>Quantidade</th> <!-- Cabeçalho da coluna para a quantidade em estoque do produto. -->
                <th>Descrição</th> <!-- Cabeçalho da coluna para a descrição do produto. -->
                <th>Ações</th> <!-- Cabeçalho da coluna para ações disponíveis (editar e excluir). -->
            </tr>
            <?php
            if ($result->num_rows > 0) { // Verifica se a consulta retornou algum resultado.
                while($row = $result->fetch_assoc()) { // Percorre cada linha do resultado da consulta.
                    // Cria uma linha da tabela para cada produto retornado pela consulta.
                    echo "<tr>
                        <td>{$row['id']}</td> <!-- Exibe o ID do produto. -->
                        <td>{$row['produto']}</td> <!-- Exibe o nome do produto. -->
                        <td>{$row['fabricante']}</td> <!-- Exibe o fabricante do produto. -->
                        <td>{$row['valor']}</td> <!-- Exibe o valor do produto. -->
                        <td>{$row['quantidade']}</td> <!-- Exibe a quantidade em estoque do produto. -->
                        <td>{$row['descricao']}</td> <!-- Exibe a descrição do produto. -->
                        <td>
                            <a href='edit_product.php?id={$row['id']}'>Editar</a> | <!-- Link para editar o produto, passando o ID como parâmetro. -->
                            <a href='#' onclick='confirmDelete({$row['id']})'>Excluir</a> <!-- Link para excluir o produto, passando o ID como parâmetro. -->
                        </td>
                    </tr>";
                }
            } else {
                // Se nenhum produto for encontrado, exibe uma mensagem na tabela.
                echo "<tr><td colspan='7'>Nenhum produto encontrado</td></tr>";
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Sistema de Estoque de Produtos. Todos os direitos reservados.</p> 
    </footer>
</body>
</html>

<?php $conn->close(); ?> <!-- Fecha a conexão com o banco de dados. -->