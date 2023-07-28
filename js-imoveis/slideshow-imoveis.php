<?php

require_once "../back/conn/conn.php";
require "../back/Links.php";

$id = filter_input(INPUT_GET, 'id');



$query =  "SELECT images, fk_id_imoveis FROM  images_imoveis 
                        WHERE fk_id_imoveis LIKE :id 
                        ORDER BY id DESC LIMIT 40";
$query_imo = $conn->prepare($query);
$query_imo->bindParam(":id", $id);
$query_imo->execute();
$retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
// var_dump($retorno);

// require "../back/core/app/navbar.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeria de Imagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="bg-dark d-flex flex-column vh-100 justify-content-center align-items-center ">
    <div class="  d-flex w-50 justify-content-between align-items-center my-1 p-2">
        <div class="">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Gostou? Entre em Contato</button>
        </div>
        <div class="">
            <a class="btn btn-danger" href="property-single.php?id=<?php echo $id ?>">Voltar</a>
        </div>
    </div>
    <div class="container ">

        <div id="carouselExample" class="carousel">

            <div class="carousel-inner ">

                <div class="carousel-item active">

                    <img src="<?php echo URLIMOVEIS . $retorno[0]['fk_id_imoveis'] . "/" .  $retorno[0]['images']; ?>" class="mx-auto d-block" alt="..." style="max-width: 80%;">
                </div>
                <?php
                foreach ($retorno as $img_res) :
                    extract($img_res);
                ?>
                    <div class="carousel-item ">
                        <img src="<?php echo URLIMOVEIS . $fk_id_imoveis . "/" .  $images; ?>" class="mx-auto d-block" alt="..." style="max-width: 80%;">
                    </div>
                <?php
                endforeach;
                ?>

            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> -->
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Modal para trazer os dados do imóvel que está sendo visualizado, caso o cliente se interesse ele inviará uma mensagem ao corretor -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tenho Interesse neste imovel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="recipient-name1" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="recipient-name1">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name2" class="col-form-label">Telefone</label>
                            <input type="text" class="form-control" id="recipient-name2">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name3" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="recipient-name3">
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary">Entrar em Contato</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>