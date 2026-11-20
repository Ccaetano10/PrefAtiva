<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    !isset($_SESSION["usu_id"]) ||
    !isset($_SESSION["tempo_secao"]) ||
    time() > $_SESSION["tempo_secao"]
) {
    session_unset();
    session_destroy();

    header("Location: /trabalho_roonie/index.php");
    exit();
}

$_SESSION["tempo_secao"] = time() + 120;
