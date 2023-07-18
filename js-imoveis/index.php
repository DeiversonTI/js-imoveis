<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<?php
session_start();
ob_start();

require_once ".././back/conn/conn.php";
require "../back/links.php";

$query_banner =  "SELECT * FROM mani_banner LIMIT 1";
$query_banner_imo = $conn->prepare($query_banner);
$query_banner_imo->execute();
$result = $query_banner_imo->fetch(PDO::FETCH_ASSOC);


$query =  "SELECT imo.id, imo.valor, img.images, imo.endereco, imo.numero, imo.estado, imo.bairro, imo.dormitorio, imo.banheiro, imo.piscina, imo.churrasqueira, imo.descricao 
  FROM  imoveis As imo
  INNER JOIN images_imoveis_one As img
  ON imo.id  = img.fk_id_imoveis
  ORDER BY id DESC LIMIT 40";
$query_imo = $conn->prepare($query);
$query_imo->execute();
$retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);


require "../.././js-imoveis/back/core/include/app/header.php";
require "../.././js-imoveis/back/core/include/app/navbar.php";
?>

<div class="hero position-relative">
  <div class="hero-slide">
    <div class="img overlay" style="background-image: url('<?php echo URLBANNER . $result['images'] ?>')">
    </div>
  </div>

  <div class="container position-absolute top-50 start-50 translate-middle ">
    <div class="py-5 text-center d-flex flex-column">
      <span class="text-light h2 fw-bold">Venda de Imóvel no Rio de Janeiro</span>
      <span class="h4 text-light fw-light">Assessoria Imobiliária</span>
    </div>
    <div>
      <div class="text-center p-3 rounded" style=" background-color:rgba(255, 255, 255, .2) ;">
        <form action="" class="py-4 rounded" style=" background-color: rgba(255, 255, 255, 1);">

          <div class="content__search px-2" style="gap: 5px;">
            <div class="b1 ">
              <!-- <label class="form-label">Pesquisar</label> -->
              <input type="search" class=" inp_input" placeholder="Digite o nome da rua, bairro ou cidade" />
            </div>
            <div class="b2  ">
              <!-- <label class="form-label float-start">Pretensão</label> -->
              <select class="sel_input" name="tipo">
                <option value="">Pretensão</option>
                <option value="Alugar">Alugar</option>
                <option value="Comprar">Comprar</option>
              </select>
            </div>
            <div class="b2 ">
              <!-- <label class="form-label float-start">Pretensão</label> -->
              <select class="sel_input" name="tipo">
                <option value="">Tipo do Imóvel</option>
                <option value="Casa">Casa</option>
                <option value="Apartamento">Apartamento</option>
                <option value="Chácara">Chácara</option>
                <option value="Cobertura">Cobertura</option>
                <option value="Terreno">Terreno</option>
              </select>
            </div>
            <div class="b3">
              <input type="submit" class="inp_input btn_inp" value="Encontrar Imóveis" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row mb-5 align-items-center">
      <div class="col-lg-6">
        <h2 class="font-weight-bold text-primary heading">
          Imóveis Populares
        </h2>
      </div>
      <div class="col-lg-6 text-lg-end">
        <p>
          <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">Todos Imóveis</a>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="property-slider-wrap">
          <div class="property-slider">
            <?php
            foreach ($retorno as $resp) :

              extract($resp);

            ?>

              <div class="property-item">
                <a href="property-single.php" class="img">
                  <img src="<?php echo URLIMGONE . $images ?>" alt="Image" class="img-fluid" />
                </a>

                <div class="property-content">
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

<section class="features-1">
  <div class="container">
    <div class="row">
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="box-feature">
          <span class="flaticon-house"></span>
          <h3 class="mb-3">Our Properties</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Voluptates, accusamus.
          </p>
          <p><a href="#" class="learn-more">Learn More</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="box-feature">
          <span class="flaticon-building"></span>
          <h3 class="mb-3">Property for Sale</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Voluptates, accusamus.
          </p>
          <p><a href="#" class="learn-more">Learn More</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="box-feature">
          <span class="flaticon-house-3"></span>
          <h3 class="mb-3">Real Estate Agent</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Voluptates, accusamus.
          </p>
          <p><a href="#" class="learn-more">Learn More</a></p>
        </div>
      </div>
      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="box-feature">
          <span class="flaticon-house-1"></span>
          <h3 class="mb-3">House for Sale</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Voluptates, accusamus.
          </p>
          <p><a href="#" class="learn-more">Learn More</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <div class="section sec-testimonials">
  <div class="container">
    <div class="row mb-5 align-items-center">
      <div class="col-md-6">
        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
          Customer Says
        </h2>
      </div>
      <div class="col-md-6 text-md-end">
        <div id="testimonial-nav">
          <span class="prev" data-controls="prev">Prev</span>

          <span class="next" data-controls="next">Next</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4"></div>
    </div>
    <div class="testimonial-slider-wrap">
      <div class="testimonial-slider">
        <div class="item">
          <div class="testimonial">
            <img src="images/person_1-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">James Smith</h3>
            <blockquote>
              <p>
                &ldquo;Far far away, behind the word mountains, far from the
                countries Vokalia and Consonantia, there live the blind
                texts. Separated they live in Bookmarksgrove right at the
                coast of the Semantics, a large language ocean.&rdquo;
              </p>
            </blockquote>
            <p class="text-black-50">Designer, Co-founder</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="images/person_2-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Mike Houston</h3>
            <blockquote>
              <p>
                &ldquo;Far far away, behind the word mountains, far from the
                countries Vokalia and Consonantia, there live the blind
                texts. Separated they live in Bookmarksgrove right at the
                coast of the Semantics, a large language ocean.&rdquo;
              </p>
            </blockquote>
            <p class="text-black-50">Designer, Co-founder</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="images/person_3-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Cameron Webster</h3>
            <blockquote>
              <p>
                &ldquo;Far far away, behind the word mountains, far from the
                countries Vokalia and Consonantia, there live the blind
                texts. Separated they live in Bookmarksgrove right at the
                coast of the Semantics, a large language ocean.&rdquo;
              </p>
            </blockquote>
            <p class="text-black-50">Designer, Co-founder</p>
          </div>
        </div>

        <div class="item">
          <div class="testimonial">
            <img src="images/person_4-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
            <div class="rate">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>
            <h3 class="h5 text-primary mb-4">Dave Smith</h3>
            <blockquote>
              <p>
                &ldquo;Far far away, behind the word mountains, far from the
                countries Vokalia and Consonantia, there live the blind
                texts. Separated they live in Bookmarksgrove right at the
                coast of the Semantics, a large language ocean.&rdquo;
              </p>
            </blockquote>
            <p class="text-black-50">Designer, Co-founder</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section section-4 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-5">
        <h2 class="font-weight-bold heading text-primary mb-4">
          Let's find home that's perfect for you
        </h2>
        <p class="text-black-50">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
          enim pariatur similique debitis vel nisi qui reprehenderit.
        </p>
      </div>
    </div>
    <div class="row justify-content-between mb-5">
      <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
        <div class="img-about dots">
          <img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
        </div>
      </div>
      <div class="col-lg-4">
        <div class="d-flex feature-h">
          <span class="wrap-icon me-3">
            <span class="icon-home2"></span>
          </span>
          <div class="feature-text">
            <h3 class="heading">2M Properties</h3>
            <p class="text-black-50">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Nostrum iste.
            </p>
          </div>
        </div>

        <div class="d-flex feature-h">
          <span class="wrap-icon me-3">
            <span class="icon-person"></span>
          </span>
          <div class="feature-text">
            <h3 class="heading">Top Rated Agents</h3>
            <p class="text-black-50">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Nostrum iste.
            </p>
          </div>
        </div>

        <div class="d-flex feature-h">
          <span class="wrap-icon me-3">
            <span class="icon-security"></span>
          </span>
          <div class="feature-text">
            <h3 class="heading">Legit Properties</h3>
            <p class="text-black-50">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Nostrum iste.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row section-counter mt-5">
      <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number"><span class="countup text-primary">3298</span></span>
          <span class="caption text-black-50"># of Buy Properties</span>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number"><span class="countup text-primary">2181</span></span>
          <span class="caption text-black-50"># of Sell Properties</span>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number"><span class="countup text-primary">9316</span></span>
          <span class="caption text-black-50"># of All Properties</span>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number"><span class="countup text-primary">7191</span></span>
          <span class="caption text-black-50"># of Agents</span>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- <div class="section">
  <div class="row justify-content-center footer-cta" data-aos="fade-up">
    <div class="col-lg-7 mx-auto text-center">
      <h2 class="mb-4">Be a part of our growing real state agents</h2>
      <p>
        <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">Apply for Real Estate agent</a>
      </p>
    </div>    
  </div>  
</div> -->

<!-- 
<div class="section section-5 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-6 mb-5">
        <h2 class="font-weight-bold heading text-primary mb-4">
          Our Agents
        </h2>
        <p class="text-black-50">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
          enim pariatur similique debitis vel nisi qui reprehenderit totam?
          Quod maiores.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
        <div class="h-100 person">
          <img src="images/person_1-min.jpg" alt="Image" class="img-fluid" />

          <div class="person-contents">
            <h2 class="mb-0"><a href="#">James Doe</a></h2>
            <span class="meta d-block mb-3">Real Estate Agent</span>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Facere officiis inventore cumque tenetur laboriosam, minus
              culpa doloremque odio, neque molestias?
            </p>

            <ul class="social list-unstyled list-inline dark-hover">
              <li class="list-inline-item">
                <a href="#"><span class="icon-twitter"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-facebook"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-linkedin"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-instagram"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
        <div class="h-100 person">
          <img src="images/person_2-min.jpg" alt="Image" class="img-fluid" />

          <div class="person-contents">
            <h2 class="mb-0"><a href="#">Jean Smith</a></h2>
            <span class="meta d-block mb-3">Real Estate Agent</span>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Facere officiis inventore cumque tenetur laboriosam, minus
              culpa doloremque odio, neque molestias?
            </p>

            <ul class="social list-unstyled list-inline dark-hover">
              <li class="list-inline-item">
                <a href="#"><span class="icon-twitter"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-facebook"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-linkedin"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-instagram"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
        <div class="h-100 person">
          <img src="images/person_3-min.jpg" alt="Image" class="img-fluid" />

          <div class="person-contents">
            <h2 class="mb-0"><a href="#">Alicia Huston</a></h2>
            <span class="meta d-block mb-3">Real Estate Agent</span>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Facere officiis inventore cumque tenetur laboriosam, minus
              culpa doloremque odio, neque molestias?
            </p>

            <ul class="social list-unstyled list-inline dark-hover">
              <li class="list-inline-item">
                <a href="#"><span class="icon-twitter"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-facebook"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-linkedin"></span></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><span class="icon-instagram"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="widget">
          <h3>Contact</h3>
          <address>43 Raymouth Rd. Baltemoer, London 3910</address>
          <ul class="list-unstyled links">
            <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
            <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
            <li>
              <a href="mailto:info@mydomain.com">info@mydomain.com</a>
            </li>
          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="widget">
          <h3>Sources</h3>
          <ul class="list-unstyled float-start links">
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Vision</a></li>
            <li><a href="#">Mission</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy</a></li>
          </ul>
          <ul class="list-unstyled float-start links">
            <li><a href="#">Partners</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Creative</a></li>
          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="widget">
          <h3>Links</h3>
          <ul class="list-unstyled links">
            <li><a href="#">Our Vision</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact us</a></li>
          </ul>

          <ul class="list-unstyled social">
            <li>
              <a href="#"><span class="icon-instagram"></span></a>
            </li>
            <li>
              <a href="#"><span class="icon-twitter"></span></a>
            </li>
            <li>
              <a href="#"><span class="icon-facebook"></span></a>
            </li>
            <li>
              <a href="#"><span class="icon-linkedin"></span></a>
            </li>
            <li>
              <a href="#"><span class="icon-pinterest"></span></a>
            </li>
            <li>
              <a href="#"><span class="icon-dribbble"></span></a>
            </li>
          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

    <div class="row mt-5">
      <div class="col-12 text-center">
        <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

        <p>
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script>
          . All Rights Reserved. &mdash; Designed with love by
          <a href="https://untree.co">Untree.co</a>
          <!-- License information: https://untree.co/license/ -->
        </p>
        <div>
          Distributed by
          <a href="https://themewagon.com/" target="_blank">themewagon</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container -->
</div>
<!-- /.site-footer -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<?php require "../.././js-imoveis/back/core/include/app/footer.php" ?>