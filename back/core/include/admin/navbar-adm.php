<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {
  $nome =  $_SESSION['nome'];
}
// ob_start();
?>
<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../admin/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/product.php">Produtos</a>
        </li>
      </ul>
      <form class="d-flex align-items-center px-2" role="search">
        <div class="me-2">
          <?php
          echo $nome;
          ?>
        </div>
        <a href="../pages/logout.php" class="btn btn-primary mr-2 " type="submit">Sair</a>
      </form>
    </div>
  </div>
</nav>