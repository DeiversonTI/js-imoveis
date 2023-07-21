<?php

require_once ".././back/conn/conn.php";

$search = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (!empty($search['btnSearch'])) {
    // var_dump($search);


    $tipo = "%" . $search['tipo'] . "%";
    $sit = "%" . $search['situacao'] . "%";
    $nome = "%" . $search['nome'] . "%";


    //NOVO - O BUSCAR SÓ ESTA PESQUISANDO POR ENDEREÇO, PRECISO PESQUISAR POR MAIS OPÇÕES, EX. BAIRRO, ESTADO, VALOR..
    $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
    FROM  imoveis As imo

    INNER JOIN images_imoveis_one As img 
    ON imo.id  = img.fk_id_imoveis

    INNER JOIN enderecos As ende
    ON ende.fk_id_imoveis=imo.id

    INNER JOIN sit_imoveis As sit
    ON sit.fk_id_imoveis=imo.id

    WHERE sit.situacao LIKE :situacao 
    AND sit.tipo_imovel LIKE :tipo   
    AND ende.endereco LIKE :nome_ende
    -- OR imo.cod_imovel LIKE :nome_est
    -- OR ende.valor_imovel LIKE :nome_val
    -- OR ende.bairro LIKE :nome_bai
    -- OR ende.estado LIKE :nome_est

    ORDER BY imo.id DESC LIMIT 40";


    $query_imo = $conn->prepare($query);
    $query_imo->bindParam(":situacao", $sit);
    $query_imo->bindParam(":tipo", $tipo);
    $query_imo->bindParam(":nome_ende", $nome);
    // $query_imo->bindParam(":nome_est", $nome);
    // $query_imo->bindParam(":nome_bai", $nome, PDO::PARAM_STR);
    // $query_imo->bindParam(":nome_val", $nome, PDO::PARAM_STR);
    $query_imo->execute();
    $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($retorno);

    $uid = $query_imo->rowCount();
}

require "../.././js-imoveis/back/core/include/app/header.php";
require "../.././js-imoveis/back/core/include/app/navbar.php";

?>

<!-- <div class="section"> -->
<div class="container " style="margin-top: 115px;">
    <div class="text-center mt-5 mb-5 rounded" style="background-color: var(--bs-gray-200);">
        <nav aria-label="breadcrumb  ">
            <span class="breadcrumb text-center justify-content-center align-items-center py-2">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-white-300" aria-current="page">
                    Buscar Imóveis
                </li>
            </span>
        </nav>
    </div>
    <div class="row mb-5 align-items-center">
        <div class="col text-start mx-auto">
            <h2 class="font-weight-bold text-primary heading">
                <strong>
                    <?php
                    if (isset($uid)) {
                        echo $uid;
                    }

                    ?>
                </strong> Imóveis à venda
            </h2>
        </div>
    </div>


    <!-- <div class="row">
            <div class="col-12">
                <div class="property-slider-wrap">
                    <div class="property-slider">
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
                        </div>
                       
                        <div class="property-item">
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
                        </div>
                       
                    </div>

                    <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                        <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                        <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                    </div>
                </div>                
            </div>
        </div> -->

</div>
<!-- </div> -->
<div class="container mx-auto my-3 ">
    <div class="text-end pl-1">
        <select class="py-2" name="" id="">
            <option value="Maior Valor">Maior Valor</option>
            <option value="Menor Valor">Menor Valor</option>
            <option value="Recente">Recente</option>
            <!-- <option value="Menor Valor">Menor Valor</option> -->
        </select>

    </div>
</div>

<div class=" section-properties">

    <div class="container">
        <div class="row">
            <?php
            foreach ($retorno as $resp) :
                extract($resp);
            ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="bg-info property-item mb-30">
                        <div class="property-item">

                            <a href="property-single.php" class="img">
                                <img src="<?php echo URLIMGONE . $images ?>" alt="Image" class="img-fluid" />
                            </a>

                            <div class="property-content">
                                <div>
                                    <span>
                                        Código Imóvel: <?php echo $cod_imovel; ?>
                                    </span>
                                </div>
                                <div class="price mb-2"><span>R$ <?php echo $valor_imovel; ?></span></div>
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
            </div> -->


            <!--<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
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