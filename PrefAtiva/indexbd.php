<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$descricao  = trim($_POST["descricao"] ?? "");
$endereco   = trim($_POST["endereco"] ?? "");
$numero     = trim($_POST["numero"] ?? "");
$referencia = trim($_POST["referencia"] ?? "");
$cat_id     = filter_input(INPUT_POST, "categoria", FILTER_VALIDATE_INT);
$cid_id     = filter_input(INPUT_POST, "cidade", FILTER_VALIDATE_INT);
$lat        = filter_input(INPUT_POST, "latitude", FILTER_VALIDATE_FLOAT);
$lng        = filter_input(INPUT_POST, "longitude", FILTER_VALIDATE_FLOAT);


if (!$cat_id || !$cid_id) {
    header("Location: index.php?erro=dados");
    exit();
}

if ($descricao === "" || $endereco === "") {
    header("Location: index.php?erro=dados");
    exit();
}

// limites das colunas do banco
if (mb_strlen($endereco) > 255 || mb_strlen($referencia) > 255 || mb_strlen($numero) > 10) {
    header("Location: index.php?erro=tamanho");
    exit();
}

// anônima por padrão; só é identificada se estiver logado e NÃO marcou o checkbox
$usu_id = null;
if (isset($_SESSION["usu_id"]) && empty($_POST["anonimo"])) {
    $usu_id = (int) $_SESSION["usu_id"];
}

try {
    require_once "./_conexao.php";

    $comandoSQL = $conexao->prepare("INSERT INTO problemas
        (pro_descricao, pro_status, pro_data_cadastro, pro_latitude, pro_longitude,
         pro_endereco, pro_numero, pro_referencia, usu_id, cat_id, cid_id)
        VALUES
        (:descricao, 'Enviada', NOW(), :lat, :lng,
         :endereco, :numero, :referencia, :usu_id, :cat_id, :cid_id)");

    $comandoSQL->execute([
        ":descricao"  => $descricao,
        ":lat"        => round($lat, 8),
        ":lng"        => round($lng, 8),
        ":endereco"   => $endereco,
        ":numero"     => $numero !== "" ? $numero : null,
        ":referencia" => $referencia !== "" ? $referencia : null,
        ":usu_id"     => $usu_id,
        ":cat_id"     => $cat_id,
        ":cid_id"     => $cid_id
    ]);

    header("Location: index.php?enviado=" . ($usu_id ? "1" : "anonimo"));
    exit();

} catch (PDOException $erro) {
    error_log($erro->getMessage());
    header("Location: index.php?erro=sistema");
    exit();
}