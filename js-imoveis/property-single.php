<?php

session_start();
ob_start();

require "../back/core/app/header.php";
require "../back/core/app/navbar.php";

// require_once ".././back/conn/conn.php";
// require "../back/Links.php";

$dados = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

// GRAVA O ID NO BANCO DE QUANTOS CLICKS O IMÓVEL RECEBEU
$imov_query = "INSERT INTO imoveis_visitados (click, created) VALUES (:click, NOW())";
$imov_visitas = $conn->prepare($imov_query);
$imov_visitas->bindParam(":click", $dados);
$imov_visitas->execute();

// RECUPERANDO AS IMAGENS DO BANCO RELACIONADA AO ID DO USUÁRIO
$sel_imgs = "SELECT * FROM images_imoveis WHERE fk_id_imoveis=$dados";
$query_imgs = $conn->prepare($sel_imgs);
$query_imgs->execute();
$result_imgs = $query_imgs->fetchAll(PDO::FETCH_ASSOC);
// var_dump($res);

// RECUPERANDO A POSTAGEM DO USUÁRIO PELO ID
// $sel_img = "SELECT * FROM imoveis WHERE id=$dados LIMIT 1";
$query_imo =  "SELECT imo.id, imag.fk_id_imoveis, imo.cod_imovel, imo.area, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
FROM  imoveis As imo
INNER JOIN images_imoveis_one As img 
ON imo.id  = img.fk_id_imoveis
INNER JOIN enderecos As ende
ON ende.fk_id_imoveis=imo.id
INNER JOIN sit_imoveis As sit
ON sit.fk_id_imoveis=imo.id
INNER JOIN images_imoveis As imag
ON imag.fk_id_imoveis=imo.id
WHERE imo.id=$dados LIMIT 1";

$query_img = $conn->prepare($query_imo);
$query_img->execute();
$result = $query_img->fetch(PDO::FETCH_ASSOC);

$valor = number_format($result["valor_imovel"], 0, ".", ".");
// var_dump($result);


?>
<div class="">
  <div>
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-9 text-center">
          <!-- <h1 class="heading" data-aos="fade-up">
                5232 California AVE. 21BC
          </h1> -->

          <nav class="mt-5" aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">
                <a href="properties.php">Properties</a>
              </li>
              <li class="breadcrumb-item active text-white-50" aria-current="page">
                5232 California AVE. 21BC
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7">
          <div class="img-property-slide-wrap">
            <div class="img-property-slide">
              <?php
              foreach ($result_imgs as $imgs) :
                extract($imgs);
                
              ?>
              <a href="slideshow-imoveis?id=<?php echo $fk_id_imoveis; ?>">
                <img src="<?php echo URLIMOVEIS . $fk_id_imoveis . "/" . $images; ?>" alt="Image" class="img-fluid" />
              </a>
              <?php
              endforeach;
              ?>

            </div>
          </div>         
        </div>
        <div class="col-lg-4">
          <p class="meta">Código do Imóvel: <?php echo $result['cod_imovel']; ?></p>
          <h1 class="bg-light  py-3 px-1">Valor: <?php echo $valor ?></h1>
          <h2 class="heading text-primary"><?php echo $result['endereco'] . ", " . $result['num_casa']; ?></h2>
          <p class="meta"><?php echo $result['bairro'] . " - " . $result['estado']; ?></p>
          <div class="mb-4">
            <h6 class="heading text-primary">Carecterísticas</h6>
            <div class="d-flex mb-2 p-2 bg-light">
              <div class="d-flex flex-column me-3 ">
                <span class="me-2"><i class="fas fa-swimmer fa-xl"></i></span>
                <span class="caption_adm me-2">Piscina - <?php echo $result['piscina'] ?> </span>
              </div>
              <div class="d-flex flex-column me-3 ">
                <span class="me-2"><i class="fas fa-utensils fa-xl"></i></span>
                <span class="caption_adm me-2">Churrasqueira - <?php echo $result['churrasqueira'] ?> </span>
              </div>
              <div class="d-flex flex-column ">
                <span class="me-2"><i class="fa-solid fa-bath fa-xl"></i></span>
                <span class="caption_adm me-2"><?php echo $result['suite'] ?> Suíte(s)</span>
              </div>
            </div>
            <div class="d-flex  p-2 bg-light">
              <div class="d-flex justify-content-center flex-column me-5 ">
                <span class="me-2"><i class="fa-solid fa-bed fa-xl"></i></span>
                <span class="caption_adm me-2"><?php echo $result['dormitorio'] ?> Dormitório</span>
              </div>
              <div class="d-flex flex-column me-5 ">
                <span class="me-2"><i class="fa-solid fa-shower fa-xl"></i></span>
                <span class="caption_adm me-2"><?php echo $result['banheiro'] ?> Banheiro</span>
              </div>
              <div class="d-flex flex-column ">
                <span class="me-2"><i class="fa-solid fa-car fa-xl"></i></span>
                <span class="caption_adm me-2"><?php echo $result['vagas'] ?> Vagas(s)</span>
              </div>
            </div>
            <div class="d-flex p-2 bg-light">
              <div class="d-flex justify-content-center flex-column me-5 ">
                <span class="me-2"><i class="fa-solid fa-ruler-combined fa-xl"></i></span>
                <span class="caption_adm me-2">Área Total <?php echo $result['area'] ?></span>
              </div>
             
            </div>


          </div>
          <h6 class="heading text-primary">Sobre o Imóvel</h6>
          <p class="text-black-50"><?php echo $result['descricao']; ?></p>
          <!-- <p class="text-black-50">
            Perferendis eligendi reprehenderit, assumenda molestias nisi eius
            iste reiciendis porro tenetur in, repudiandae amet libero.
            Doloremque, reprehenderit cupiditate error laudantium qui, esse
            quam debitis, eum cumque perferendis, illum harum expedita.
          </p> -->

          <div class="d-block agent-box p-5 mb-5">
            <div class="img mb-4">
              <img src="images/person_2-min.jpg" alt="Image" class="img-fluid" />
            </div>
            <div class="text">
              <h3 class="mb-0">Josias Pereira </h3>
              <div class="meta mb-3">Corretor</div>
              <p class="">
                Somos especialistas em Compra, Venda, Locação, Administração e Legalização de Documentação, em negócios imobiliários.
                Estamos aguardando seu contato.
              </p>
              <ul class="list-unstyled social dark-hover d-flex">
                <li class="me-1">
                  <a href="#"><span class="icon-instagram"></span></a>
                </li>
                <li class="me-1">
                  <a href="#"><span class="icon-twitter"></span></a>
                </li>
                <li class="me-1">
                  <a href="#"><span class="icon-facebook"></span></a>
                </li>
                <li class="me-1">
                  <a href="#"><span class="icon-linkedin"></span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 
<?php require "../back/core/app/footer.php" ?>