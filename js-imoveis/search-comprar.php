<?php

session_start();

// require_once ".././back/conn/conn.php";

$search = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($search);
require "../back/core/app/header.php";
require "../back/core/app/navbar.php";

if (!empty($search['btnSearch'])) {
    // var_dump($search);

    $tipo = "%" . $search['tipo'] . "%";
    $sit = "%" . $search['situacao'] . "%";
    $nome = "%" . $search['nome'] . "%";

    // SISTEMA PESQUISAR(BUSCA PELA COLUNA DA TABELA ESPECIFICA)

    if ((!empty($search['nome'])) and (empty($search['situacao'])) and (empty($search['tipo']))) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        WHERE ende.endereco LIKE :nome    
        OR imo.cod_imovel LIKE :nome
        OR ende.valor_imovel LIKE :nome
        OR ende.bairro LIKE :nome
        OR ende.estado LIKE :nome

        ORDER BY imo.id DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":nome", $nome);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    } elseif ((empty($search['nome'])) and (!empty($search['situacao'])) and (empty($search['tipo']))) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        WHERE sit.situacao LIKE :situacao    

        ORDER BY imo.id DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":situacao", $sit);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    } elseif ((empty($search['nome'])) and (empty($search['situacao'])) and (!empty($search['tipo']))) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        WHERE sit.tipo_imovel LIKE :tipo     

        ORDER BY imo.id DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":tipo", $tipo);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    } elseif ((empty($search['nome'])) and (!empty($search['situacao'])) and (!empty($search['tipo']))) {

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
            

        ORDER BY imo.id DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":situacao", $sit);
        $query_imo->bindParam(":tipo", $tipo);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    } else {

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
        AND ende.endereco LIKE :nome
    
        ORDER BY imo.id DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":situacao", $sit);
        $query_imo->bindParam(":tipo", $tipo);
        $query_imo->bindParam(":nome", $nome);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    }
}

// SEARCH POR IMÓVEIS COM OS MAIORES VALORES, DADOS VINDO POR PAREMETRO NA URI
$dados = filter_input(INPUT_GET, "url", FILTER_DEFAULT);

if ($dados === "Maior_Valor") {

    if (!empty($dados)) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        ORDER BY ende.valor_imovel DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);

        $uid = $query_imo->rowCount();
    }
} else if ($dados === "Menor_Valor") {

    if (!empty($dados)) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        ORDER BY ende.valor_imovel ASC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);

        $uid = $query_imo->rowCount();
    }
} else if($dados === "Mais_Visto") {
    // CRIAR LINKS DE MAIS VISITADOS 

    if (!empty($dados)) {
        $query =  "SELECT count(cli.click) As clicks, imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        INNER JOIN imoveis_visitados As cli
        ON imo.id=cli.click

        GROUP BY 
        imo.id, imo.banheiro

        ORDER BY clicks DESC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($retorno);

        $uid = $query_imo->rowCount();
    }
    
} else if ($dados === "Imoveis_Alugar") {
    // CRIAR LINKS DE MAIS VISITADOS 
    $alugar = "Alugar";

    if (!empty($dados)) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        WHERE sit.situacao=:alugar

        ORDER BY sit.situacao ASC LIMIT 40";

        $query_imo = $conn->prepare($query);       
        $query_imo->bindParam(":alugar", $alugar);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);        

        $uid = $query_imo->rowCount();
    }
} else if ($dados === "Imoveis_Comprar") {
    // CRIAR LINKS DE MAIS VISITADOS 
    $comprar = "Comprar";

    if (!empty($dados)) {

        $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
        FROM  imoveis As imo

        INNER JOIN images_imoveis_one As img 
        ON imo.id  = img.fk_id_imoveis

        INNER JOIN enderecos As ende
        ON ende.fk_id_imoveis=imo.id

        INNER JOIN sit_imoveis As sit
        ON sit.fk_id_imoveis=imo.id

        WHERE sit.situacao=:comprar

        ORDER BY sit.situacao ASC LIMIT 40";

        $query_imo = $conn->prepare($query);
        $query_imo->bindParam(":comprar", $comprar);
        $query_imo->execute();
        $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);        

        $uid = $query_imo->rowCount();
    }
}

?>

<!-- <div class="section"> -->
<div class="container position-relative" style="margin-top: 115px;">
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
        <div class="col text-start mx-auto d-flex align-items-center  ">
            <h2 class="text-primary heading  " style="margin-right: 10px;">
                <strong>
                    <?php
                    if (isset($uid)) {
                        echo $uid;
                    }

                    ?>
                </strong>
                <!-- Imóveis à venda -->
            </h2>
            <span class="h5">
                <?php
                echo $dados === "Mais_Visto" ? " Imóveis (Mais Visitados)" : "";
                echo $dados === "Maior_Valor" ? " Imóveis (Maior Valores)" : "";
                echo $dados === "Menor_Valor" ? " Imóveis (Menor Valores)" : "";
                echo $dados === "Imoveis_Alugar" ? " Imóveis para Alugar" : "";
                echo $dados === "Imoveis_Comprar" ? " Imóveis para Comprar" : "";
                if (!isset($dados) and isset($uid)) {
                    echo "Imóveis Encontrados";
                }
                ?>
            </span>
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
<div class="container my-3 d-flex justify-content-end">
    <?php
    if (empty($retorno)) {
        $retorno = [];
        echo "<div class='text-center w-100'>Nenhum Imóvel Aqui!</div>";
    } else { ?>


        <details class="position-absolute ">
            <summary>Pesquisar</summary>
            <a href="search-comprar.php?url=Maior_Valor"><span>Maior Valor</span></a>
            <a href="search-comprar.php?url=Menor_Valor"><span>Menor Valor</span></a>
            <a href="search-comprar.php?url=Mais_Visto"><span>Mais Visto</span></a>
            <a href="search-comprar.php?url=Imoveis_Alugar"><span>Alugar</span></a>
            <a href="search-comprar.php?url=Imoveis_Comprar"><span>Comprar</span></a>
        </details>


        <!-- <div>
            <select class=" py-2" name="" id="" onchange="changeValuesSearch(value)">
                <option value="" selected>Pesquisar</option>
                <option value="Maior_Valor" id="Valor">Maior Valor</option>
                <option value="Menor_Valor" id="Valor">Menor Valor</option>
                <option value="Mais_Visto" id="Valor">Mais Visto</option>
                </select>
</div> -->
    <?php } ?>
</div>

<div class=" section-properties">

    <div class="container">
        <div class="row">
            <?php
            // if(empty($retorno)){
            //     $retorno = [];
            //     echo "vazio";                
            // }
            foreach ($retorno as $resp) :
                extract($resp);

                $valor = number_format($valor_imovel, 0, ".", ".");
            ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="property-item mb-30">
                        <div class="property-item">

                            <a href="property-single.php?id=<?php echo $id ?>" class="img">
                                <img src="<?php echo URLIMGONE . $images ?>" alt="Image" class="img-fluid" />
                            </a>

                            <div class="property-content">
                                <div>
                                    <span>
                                        Código Imóvel: <?php echo $cod_imovel; ?>
                                    </span>
                                </div>
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