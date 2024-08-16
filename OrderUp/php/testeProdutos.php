<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário e faz sanitização básica
        $nome = $conn->real_escape_string(trim($_POST['nome']));
        $descricao = $conn->real_escape_string(trim($_POST['descricao']));
	    $preco = floatval(str_replace(',', '.', $_POST['preco']));
        $quantidade = $_POST['quantidade'];
        $categoria = $conn->real_escape_string(trim($_POST['categoria']));
    
        // Prepara e executa a consulta SQL para inserir os dados
        $sql = "INSERT INTO produtos (nome, descricao, precos, quantidade,categoria) VALUES (?, ?, ?, ?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssiis", $nome, $descricao, $preco, $quantidade,$categoria);
    
            if ($stmt->execute()) {
                echo "Produto inserido com sucesso!";
                echo '<br>';
                echo $preco;
            } else {
                echo "Erro ao inserir produto: " . $stmt->error;
            }
    
            // Fecha o statement
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    }
}
    // Fecha a conexão
    $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produto</title>
    
</head>
<body>
    <h1>Inserir Produto</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>
        
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Quantidade</label>
            <select name="quantidade" class="form-control" id="quantidade">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select><br><br>
        </div>
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="" disabled selected>Selecione uma categoria</option>
            <option value="salgados">salgados</option>
            <option value="bebidas">bebidas</option>
            <option value="almoço">almoço</option>
            <option value="combo">combo</option>
            <!-- Adicione outras opções conforme necessário -->
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>