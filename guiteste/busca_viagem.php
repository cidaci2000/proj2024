<?php
// Inclua o arquivo de configuração para a conexão com o banco de dados
include_once('config.php');

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Inicializa variáveis
$data_saida = '';
$result = null;
$stmt = null; // Inicializa a variável

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém a data de saída a partir do formulário
    $data_saida = isset($_POST['data_saida']) ? htmlspecialchars(trim($_POST['data_saida'])) : null;

    // Prepara a consulta SQL para a viagem específica
    $sql = "SELECT * FROM viagens WHERE data_saida = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data_saida);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Viagem por Data de Saída</title>
    <link rel="stylesheet" href="inicio.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Buscar Viagem</h1>

        <form action="busca_viagem.php" method="POST">
            <div>
                <label for="data_saida">Data de Saída:</label>
                <input type="date" id="data_saida" name="data_saida" value="<?php echo htmlspecialchars($data_saida); ?>" required>
            </div>
            <button type="submit">Buscar</button>
        </form>

        <?php
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Cálculo dos gastos totais
            $gastos = $row['combustivel'] + $row['pedagio'] + $row['manutencao'];
            $lucro_final = $row['lucro'] - $gastos;

            // Formata as datas
            $data_saida_formatada = date("Y-m-d", strtotime($row['data_saida']));
            $data_chegada_formatada = date("Y-m-d", strtotime($row['data_chegada']));

            // Exibe os dados da viagem
            echo "<table>";
            echo "<tr>
                    <th>Data de Saída</th>
                    <th>Data de Chegada</th>
                    <th>Gastos com Combustível (R$)</th>
                    <th>Gastos com Pedágios (R$)</th>
                    <th>Gastos com Manutenção (R$)</th>
                    <th>Lucro (R$)</th>
                  </tr>";
            echo "<tr>
                    <td>{$data_saida_formatada}</td>
                    <td>{$data_chegada_formatada}</td>
                    <td>{$row['combustivel']}</td>
                    <td>{$row['pedagio']}</td>
                    <td>{$row['manutencao']}</td>
                    <td>{$row['lucro']}</td>
                  </tr>";
            echo "</table>";

            // Exibe o resumo financeiro
            echo "<h2>Resumo Financeiro</h2>";
            echo "Total de Gastos: R$ " . number_format($gastos, 2, ',', '.') . "<br>";
            echo "Lucro Final: R$ " . number_format($lucro_final, 2, ',', '.') . "<br>";

            // Verifica se o lucro final é negativo
            if ($lucro_final < 0) {
                echo "<p style='color: red;'>Você teve um prejuízo de R$ " . number_format(abs($lucro_final), 2, ',', '.') . ".</p>";
            } else {
                echo "<p style='color: green;'>Você teve um lucro de R$ " . number_format($lucro_final, 2, ',', '.') . ".</p>";
            }
        } elseif ($result) {
            echo "Nenhuma informação encontrada para essa data de saída.";
        }

        // Fecha a conexão com o banco de dados
        if ($stmt) {
            $stmt->close(); // Fecha apenas se $stmt estiver definido
        }
        $conn->close();
        ?>
    </div>

</body>
</html>
