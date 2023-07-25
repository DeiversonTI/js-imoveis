<?php
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
?>
<nav class="navbar navbar-expand-lg bg-primary-subtle" data-bs-theme="dark">
  <div class="container-fluid">
    <a href=".././pages/index.php" class="logo me-3 float-start">
      <img src="<?php echo $url; ?>" alt="" style="max-width: 70px;">
    </a>
    <!-- <a class="navbar-brand" href="#">Dashboard</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../pages/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Cadastrar Usuários</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Imóveis
          </a>
          <ul class="dropdown-menu" data-bs-theme="light">
            <li><a class="dropdown-item" href="../pages/cad_imoveis.php">Cadastrar Imóveis</a></li>
            <li><a class="dropdown-item" href="#">Cadastrar Proprietário</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Site
          </a>
          <ul class="dropdown-menu" data-bs-theme="light">
            <li><a class="dropdown-item" href="../pages/logo_site.php">Inserir Logo</a></li>
            <li><a class="dropdown-item" href="../pages/title_site.php">Inserir Favicon</a></li>
            <li><a class="dropdown-item" href="../pages/banner_site.php">Inserir Banner</a></li>
            <li><a class="dropdown-item" href="../pages/contact.php">Inserir Contato</a></li>
            <li><a class="dropdown-item" href="#">Inserir Email</a></li>
            <li><a class="dropdown-item" href="#">Inserir Sobre Nós</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex align-items-center gap-3  " role="search" >
        <div class="form-check form-switch " >
          <input class="form-check-input" type="checkbox" role="switch" onchange="selDark(event)" name="darkMode" id="darkMode">          
        </div>
        <div class="pb-1">
          <?php
          if (isset($_SESSION['id']) and (isset($_SESSION['nome']))) {
            echo "<span style='color:#eee;'>Bem Vindo - <span> " . $_SESSION['nome'];
          } else {
            echo "";
          }
          // echo $nome;
          ?>
        </div>
        <div>
           <a href="../pages/logout.php" class="btn btn-primary  " type="submit">Sair</a>
        </div>
       
      </form>
    </div>
  </div>
</nav>