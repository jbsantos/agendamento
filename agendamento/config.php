<?php
function getConnection()
{
    $host = "localhost";
    $user = "usuario";
    $password = "senha";
    $dbname = "banco";

    // Cria a conexão
    $conn = mysqli_connect($host, $user, $password, $dbname);
    mysqli_set_charset($conn, "utf8");

    // Verifica se a conexão foi criada com sucesso
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    return $conn;
}
?>