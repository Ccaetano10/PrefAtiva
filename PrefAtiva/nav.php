<?php
if (session_status() === PHP_SESSION_NONE) session_start();
    $logado = isset($_SESSION['usu_id']);
    $pagina = basename($_SERVER['PHP_SELF']);   
?>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<nav>
  <h1>PrefAtiva</h1>
  <ul>
    <li><a href="index.php" class="<?= $pagina == 'index.php' ? 'ativo' : '' ?>">Home</a></li>
    <li><a href="sobre.php" class="<?= $pagina == 'sobre.php' ? 'ativo' : '' ?>">Sobre</a></li>
    <li><a href="contatos.php" class="<?= $pagina == 'contatos.php' ? 'ativo' : '' ?>">Contato</a></li>

    <?php if ($logado): ?>
      <li><a href="minhas_denuncias.php" class="<?= $pagina == 'minhas_denuncias.php' ? 'ativo' : '' ?>">Minhas denúncias</a></li>
      <li><a href="logout.php" class="btn-nav">Sair</a></li>
    <?php else: ?>
      <li><a href="login.php" class="btn-nav">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>