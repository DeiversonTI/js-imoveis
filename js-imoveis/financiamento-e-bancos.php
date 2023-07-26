<?php

require "../back/core/app/header.php";
require "../back/core/app/navbar.php";

?>

<div class="">
  <div class="container" style="margin-top: 115px;">
    <div class="text-centerrounded" style="background-color: var(--bs-gray-200);">
      <nav aria-label="breadcrumb  ">
        <span class="breadcrumb text-center justify-content-center align-items-center py-2">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active text-white-300" aria-current="page">
            Financiamento e Bancos
          </li>
        </span>
      </nav>
    </div>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row  align-items-center">
      <div class="col-lg-6 text-center mx-auto w-100">
        <h2 class="font-weight-bold text-primary heading float-start  "> Financiamento e Bancos</h2>
      </div>

    </div>
  </div>
</div>

<div class="container mb-5 p-3 rounded" style="background-color: rgb(233,236,239);">
  <span class="">Escolha um banco e faça a sua simulação:</span>
  <div class="row row-cols-auto row-cols-sm-auto row-cols-md-auto rounded g-2 mt-2">
    <!-- BANCOS E FINANCIAMENTOS -->
    <div class="col">
      <a href="https://credito-imobiliario.itau.com.br/" target="_blank">
        <img src="https://cdn1.valuegaia.com.br/gaiasite/templates/banks/itau.jpg" alt="Itaú">
      </a>
    </div>
    <div class="col">
      <a href="https://www.webcasas.com.br/webcasas/?headerandfooter/#/dados-pessoais" target="_blank">
        <img src="https://cdn1.valuegaia.com.br/gaiasite/templates/banks/santander.jpg" alt="Santander">
      </a>
    </div>
    <div class="col">
      <a href="https://www42.bb.com.br/portalbb/imobiliario/creditoimobiliario/simular,802,2250,2250.bbx?eni_gclid=Cj0KCQjwp86EBhD7ARIsAFkgakg39StNF0YBE3S5bgNiBlnuM-BMJd6hXU5ACfQtaweeFYraleQ5fqUaAlvvEALw_wcB&amp;pk_vid=e096ac2feeed30bf162033156524f1ab" target="_blank">
        <img src="https://cdn1.valuegaia.com.br/gaiasite/templates/banks/banco-brasil.jpg" alt="Banco do Brasil">
      </a>
    </div>
    <div class="col">
      <a href="https://banco.bradesco/html/classic/produtos-servicos/emprestimo-e-financiamento/encontre-seu-credito/simuladores-imoveis.shtm#box1-comprar" target="_blank">
        <img src="https://cdn1.valuegaia.com.br/gaiasite/templates/banks/bradesco.jpg" alt="Bradesco">
      </a>
    </div>
    <div class="col">
      <a href="http://www8.caixa.gov.br/siopiinternet/simulaOperacaoInternet.do?method=inicializarCasoUso" target="_blank">
        <img src="https://cdn1.valuegaia.com.br/gaiasite/templates/banks/caixa.jpg" alt="Caixa"></a>
    </div>

  </div>
</div>

<?php require "../back/core/app/footer.php" ?>