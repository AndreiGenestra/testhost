<?php
require_once('bd.php');

// 1) obter dados: primeiro tenta $_POST, se vazio tenta ler raw body
$data = $_POST;
if (empty($data)) {
    $raw = file_get_contents('php://input');
    parse_str($raw, $data); // converte "a=1&b=2" em array
}
// Debug para verificar
var_dump($data);

$mysql = new BancodeDados();
$mysql -> conecta();    
$sqlstring = "INSERT INTO pontos (id_usuario, pontos) VALUES (?, ?) ON DUPLICATE KEY UPDATE pontos = pontos + ?";
$stmt = $mysql->conn->prepare($sqlstring);
$stmt->bind_param("iii", $data['id_usuario'], $data['pontos'], $data['pontos']);
$stmt->execute();
?>