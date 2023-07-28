<?php

// require_once ".././back/conn/conn.php";
require "../back/core/app/header.php";
require "../back/core/app/navbar.php";

//NOVO - O BUSCAR SÓ ESTA PESQUISANDO POR ENDEREÇO, PRECISO PESQUISAR POR MAIS OPÇÕES, EX. BAIRRO, ESTADO, VALOR..
$query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
  FROM  imoveis As imo

  INNER JOIN images_imoveis_one As img 
  ON imo.id  = img.fk_id_imoveis

  INNER JOIN enderecos As ende
  ON ende.fk_id_imoveis=imo.id

  INNER JOIN sit_imoveis As sit
  ON sit.fk_id_imoveis=imo.id

  ORDER BY imo.id DESC LIMIT 40";

$query_imo = $conn->prepare($query);
$query_imo->execute();
$retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);


$contador_imoveis = $query_imo->rowCount();

// var_dump($contador_imoveis);


?>

<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center mt-5">
        <h1 class="heading" data-aos="fade-up">Imóveis</h1>

        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
          <ol class="breadcrumb text-center justify-content-center">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white-50" aria-current="page">
              Imóveis
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row mb-5 align-items-center">
      <div class="col-lg-6 text-center mx-auto">
        <h2 class="font-weight-bold text-primary heading">
          Propriedades em destaque
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="property-slider-wrap">
          <div class="property-slider">
            <?php
            foreach ($retorno as $resp) :

              extract($resp);
              $valor = number_format($valor_imovel, 0, ".", ".");

            ?>

              <div class="property-item">
                <a href="property-single.php?id=<?php echo $id; ?>" class="img">
                  <img src="<?php echo URLIMGONE . $images ?>" alt="Image" class="img-fluid" />
                </a>

                <div class="property-content">
                  <div>Código do Imóvel: <?php echo $cod_imovel; ?></div>
                  <div class="price mb-2"><span>R$ <?php echo $valor; ?></span></div>
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
            <?php
            endforeach;
            ?>

            <!-- <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
           

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
           

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
           

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
       

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
          

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_7.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
           

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_8.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
            

            <div class="property-item">
              <a href="property-single.php" class="img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
              </a>

              <div class="property-content">
                <div class="price mb-2"><span>$1,291,000</span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                  <span class="city d-block mb-3">California, USA</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div> -->

          </div>

          <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
          </div>
        </div>
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
              <a href="property-single.php?id=<?php echo $id; ?>" class="img">
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

      <!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
       
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
       
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
       
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
        
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_7.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_8.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
      
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <div class="property-item mb-30">
          <a href="property-single.php" class="img">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
          </a>

          <div class="property-content">
            <div class="price mb-2"><span>$1,291,000</span></div>
            <div>
              <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
              <span class="city d-block mb-3">California, USA</span>

              <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                  <span class="icon-bed me-2"></span>
                  <span class="caption">2 beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                  <span class="icon-bath me-2"></span>
                  <span class="caption">2 baths</span>
                </span>
              </div>

              <a href="property-single.php" class="btn btn-primary py-2 px-3">See details</a>
            </div>
          </div>
        </div>
       
      </div> -->
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