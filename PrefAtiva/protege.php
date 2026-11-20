<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// não logado ou sessão expirada
if (!isset($_SESSION["usu_id"]) || time() > ($_SESSION["tempo_secao"] ?? 0)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// renova o tempo a cada página visitada
$_SESSION["tempo_secao"] = time() + 1800; // 30 minutos