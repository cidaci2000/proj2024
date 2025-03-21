<?php
// Inclua o arquivo de configuração para a conexão com o banco de dados
include_once('config.php');

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Mensagens de erro/sucesso
$message = "";

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém e limpa os dados do formulário
    $data_saida = isset($_POST['data_saida']) ? htmlspecialchars(trim($_POST['data_saida'])) : null;
    $data_chegada = isset($_POST['data_chegada']) ? htmlspecialchars(trim($_POST['data_chegada'])) : null;
    $combustivel = isset($_POST['combustivel']) ? htmlspecialchars(trim($_POST['combustivel'])) : null;
    $pedagio = isset($_POST['pedagio']) ? htmlspecialchars(trim($_POST['pedagio'])) : null;
    $manutencao = isset($_POST['manutencao']) ? htmlspecialchars(trim($_POST['manutencao'])) : null;
    $lucro = isset($_POST['lucro']) ? htmlspecialchars(trim($_POST['lucro'])) : null;

    // Prepara a instrução SQL usando prepared statements
    $stmt = $conn->prepare("INSERT INTO viagens (data_saida, data_chegada, combustivel, pedagio, manutencao, lucro) VALUES (?, ?, ?, ?, ?, ?)");

    // Variáveis temporárias para bind
    $combustivel_param = $combustivel ?: null;
    $pedagio_param = $pedagio ?: null;
    $manutencao_param = $manutencao ?: null;
    $lucro_param = $lucro ?: null;

    // Bind dos parâmetros
    $stmt->bind_param("ssdddd", $data_saida, $data_chegada, $combustivel_param, $pedagio_param, $manutencao_param, $lucro_param);

    // Executa a query e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        $message = "Informações da viagem foram salvas com sucesso!";
    } else {
        $message = "Erro ao salvar as informações: " . $stmt->error;
    }
    
    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da Viagem</title>
    <link rel="stylesheet" href="inicio.css">
</head>
<body>

    <div class="container">
        <h1>Informações da Viagem</h1>

        <!-- Exibe a mensagem de erro ou sucesso -->
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="inicio.php" method="POST">
            <div class="info">
                <label for="data_saida">Data de Saída:</label>
                <input type="date" id="data_saida" name="data_saida">
            </div>

            <div class="info">
                <label for="combustivel">Gastos com Combustível (R$):</label>
                <input type="number" id="combustivel" name="combustivel" step="0.01" placeholder="Ex: 500.00">
            </div>

            <div class="info">
                <label for="pedagio">Gastos com Pedágios (R$):</label>
                <input type="number" id="pedagio" name="pedagio" step="0.01" placeholder="Ex: 120.00">
            </div>

            <div class="info">
                <label for="manutencao">Gastos com Manutenção (R$):</label>
                <input type="number" id="manutencao" name="manutencao" step="0.01" placeholder="Ex: 150.00">
            </div>

            <div class="info">
                <label for="lucro">Lucro (R$):</label>
                <input type="number" id="lucro" name="lucro" step="0.01" placeholder="Ex: 1000.00">
            </div>

            <div class="info">
                <label for="data_chegada">Data de Chegada:</label>
                <input type="date" id="data_chegada" name="data_chegada">
            </div>

            <button type="submit" class="btn">Salvar Informações</button>
        </form>
<br>
        <!-- Botão para visualizar as viagens registradas -->
        <a href="visualiza_viagens.php" class="btn">Visualizar Viagens</a>
        
<br><br>
        <a href="busca_viagem.php" class="btn">Visualizar Calculos</a>
    </div>

</body>
</html>
