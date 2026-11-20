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

    header("Location: ./index.php?erro=tempo_sessao");
    exit();
}

$_SESSION["tempo_secao"] = time() + 120;
