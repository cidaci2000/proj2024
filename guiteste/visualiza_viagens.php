<?php
// Inclua o arquivo de configuração para a conexão com o banco de dados
include_once('config.php');

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Prepara a consulta SQL
$sql = "SELECT * FROM viagens";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização das Viagens</title>
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
        <h1>Informações das Viagens</h1>

        <a href="inicio.php" style="display: inline-block; margin: 20px 0; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar</a>


        <?php
        if ($result->num_rows > 0) {
            // Início da tabela
            echo "<table>";
            echo "<tr>
                    <th>Data de Saída</th>
                    <th>Data de Chegada</th>
                    <th>Gastos com Combustível (R$)</th>
                    <th>Gastos com Pedágios (R$)</th>
                    <th>Gastos com Manutenção (R$)</th>
                    <th>Lucro (R$)</th>
                  </tr>";

            // Saída dos dados de cada linha
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['data_saida']}</td>
                        <td>{$row['data_chegada']}</td>
                        <td>{$row['combustivel']}</td>
                        <td>{$row['pedagio']}</td>
                        <td>{$row['manutencao']}</td>
                        <td>{$row['lucro']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhuma informação encontrada.";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>

</body>
</html>
