<?php

// require_once ".././back/conn/conn.php";
require "../back/core/app/header.php";
require "../back/core/app/navbar.php";

$tipo = "%comprar%";

//NOVO - O BUSCAR SÓ ESTA PESQUISANDO POR ENDEREÇO, PRECISO PESQUISAR POR MAIS OPÇÕES, EX. BAIRRO, ESTADO, VALOR..
$query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
  FROM  imoveis As imo

  INNER JOIN images_imoveis_one As img 
  ON imo.id  = img.fk_id_imoveis

  INNER JOIN enderecos As ende
  ON ende.fk_id_imoveis=imo.id

  INNER JOIN sit_imoveis As sit
  ON sit.fk_id_imoveis=imo.id 
  -- tras somente os imóveis compra
  WHERE sit.situacao LIKE :gerSit

  ORDER BY imo.id DESC LIMIT 40";

$query_imo = $conn->prepare($query);
$query_imo->bindParam(":gerSit", $tipo);
$query_imo->execute();
$retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);

$contador_imoveis = $query_imo->rowCount();

// var_dump($contador_imoveis);


?>

<div class="" >
  <div class="container" style="margin-top: 115px;">
    <div class="text-centerrounded" style="background-color: var(--bs-gray-200);">
        <nav aria-label="breadcrumb  ">
            <span class="breadcrumb text-center justify-content-center align-items-center py-2">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-white-300" aria-current="page">
                   Comprar Imóveis
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
        <h2 class="font-weight-bold text-primary heading float-start  ">
        <?php echo $contador_imoveis?> Imóveis para Comprar
        </h2>
      </div>
    </div>    
  </div>
</div>

<div class="section section-properties">
  <div class="container">
    <div class="row">
      <?php
      foreach ($retorno as $resp) :

        extract($resp);
        $valor_one = number_format($valor_imovel, 0, ".", ".");

      ?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <div class="property-item mb-30">
            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="<?php echo URLIMGONE . $images ?>" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div>Código do Imóvel: <?php echo $cod_imovel; ?></div>
                <div class="price mb-2"><span>R$ <?php echo $valor_one; ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"><?php echo $endereco; ?></span>
                  <span class="city d-block mb-3"><?php echo $bairro . ", " . $estado; ?></span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption"><?php echo $dormitorio; ?> Dormitório(s)</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption"><?php echo $banheiro ?> Banheiro(s)</span>
                    </span>
                  </div>

                  <a href="property-single.php?id=<?php echo $id; ?>" class="btn btn-primary py-2 px-3">Mais Detalhes</a>
                </div>
              </div>
            </div>
          </div>          
        </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="row align-items-center py-5">
      <div class="col-lg-3">Pagination (1 of 10)</div>
      <div class="col-lg-6 text-center">
        <div class="custom-pagination">
          <a href="#">1</a>
          <a href="#" class="active">2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require "../back/core/app/footer.php" ?>