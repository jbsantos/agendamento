<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();// Starting Session
}

if (!isset($_SESSION['login_user'])) {
    header("location:login/index.php");
    exit(); // Certifique-se de sair após o redirecionamento para evitar que o restante do script seja executado
}
?>
