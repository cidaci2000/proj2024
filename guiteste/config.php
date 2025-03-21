<?php
// Configurações do banco de dados
$host = 'localhost';  // Endereço do servidor do banco de dados
$user = 'root';       // Usuário do banco de dados
$password = '';       // Senha do banco de dados (deixe vazio se não houver)
$dbname = 'info_viagem'; // Nome do banco de dados

// Estabelece a conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
