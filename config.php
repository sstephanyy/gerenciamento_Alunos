<?php
$servername = "localhost";
$username = "root";
$password = "stephany123#YT";
$dbname = "gerenciamento_alunos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
