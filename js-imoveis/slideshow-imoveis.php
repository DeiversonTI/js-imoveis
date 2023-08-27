<?php

require_once "../back/conn/conn.php";
require "../back/Links.php";

$id = filter_input(INPUT_GET, 'id');



$query =  "SELECT img.images, img.fk_id_imoveis, ende.endereco, ende.num_casa, ende.estado, ende.bairro, ende.valor_imovel 
                        FROM  images_imoveis As img
                        INNER JOIN enderecos As ende
                        ON ende.fk_id_imoveis=img.fk_id_imoveis
                        WHERE img.fk_id_imoveis LIKE :id 
                        ORDER BY img.id DESC LIMIT 40";
$query_imo = $conn->prepare($query);
$query_imo->bindParam(":id", $id);
$query_imo->execute();
$retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
// var_dump($retorno);

$valorConv = number_format($retorno[0]['valor_imovel'], 0, ".", ".");

// $teste = json_decode(file_get_contents('php://input'));

// var_dump($teste);

// $dadosUser = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// if (!empty($dadosUser['btnCadImo'])) {

//     var_dump($dadosUser);

//     $res_title = "INSERT INTO imovel_interesse (nome, telefone, id_imovel, email, created) VALUES (:nome, :telefone, :id_imovel, :email, NOW())";
//     $result_db_title = $conn->prepare($res_title);
//     $result_db_title->bindParam(':nome', $dadosUser['nome']);
//     $result_db_title->bindParam(':telefone', $dadosUser['telefone']);
//     $result_db_title->bindParam(':id_imovel', $dadosUser['id_imovel']);
//     $result_db_title->bindParam(':email', $dadosUser['email']);
//     $result_db_title->execute();

//     if ($result_db_title->rowCount()) {
//         $_SESSION['cad_imo_new'] = "<div class='alert alert-success' role='alert'>Recebemos seu pedido! Entraremos em contato em breve!!</div>";

//         header("Location: slideshow-imoveis?id=$id");
//     }
// }

// require "../back/core/app/navbar.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeria de Imagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        dialog::backdrop {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .msg_interesse {
            display: none;
        }

        .msg_interesse2 {
            display: none;
        }
    </style>
</head>

<body class="bg-dark d-flex flex-column vh-100 justify-content-center align-items-center">
    <div class="  d-flex w-50 justify-content-between align-items-center my-1 p-2">
        <div class="">
            <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Gostou? Entre em Contato</button> -->
            <button type="button" id="abrir-dialog" class="btn btn-outline-primary">Gostou? Entre em Contato</button>
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
    <div class="w-50 position-absolute  start-50 translate-middle" style="z-index: 2000; top: 25%;">
        <dialog id="modal-dialog" class="border border-1 rounded w-50">
            <div class=" modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tenho Interesse neste imovel</h1>
                <button type="button" class="btn-close" id="fechar-dialog"></button>
            </div>

            <div class="p-2 d-flex align-items-center">
                <div class="px-1">
                    <img src="<?php echo URLIMOVEIS . $retorno[0]['fk_id_imoveis'] . "/" .  $retorno[0]['images'] ?>" alt="" style="max-width: 60px;">
                </div>
                <div>
                    <span><strong>Imóvel</strong> <?php echo $retorno[0]['endereco'] ?>, <?php echo $retorno[0]['num_casa'] ?>, <?php echo $retorno[0]['bairro'] ?> </span><br>
                    <span><strong>Valor: R$</strong> <?php echo $valorConv ?></span>
                </div>

            </div>
            <!-- <form action="search-alugar.php" > -->
            <form action="" method="post" id="form_submit">
                <div class="msg_interesse">
                    <div class="alert alert-success" role="alert">
                        Recebemos sua mensagem! Em breve nosso corretor entrará em contato!
                    </div>
                </div>
                <div class="msg_interesse2">
                    <div class="alert alert-danger" role="alert">
                        Precisa preencher os campos!
                    </div>
                </div>
                <input type="hidden" class="inpId" id="Uid" value="<?php echo $retorno[0]['fk_id_imoveis'] ?>" name="id_imovel">
                <div class="mb-3">
                    <label for="recipient-name1" class="col-form-label">Nome</label>
                    <input type="text" name="nome" class="form-control inpNome" id="nome">
                </div>
                <div class="mb-3">
                    <label for="recipient-name2" class="col-form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-control inpTel" id="tel">
                </div>
                <div class="mb-3">
                    <label for="recipient-name3" class="col-form-label">Email</label>
                    <input type="email" name="email" class="form-control inpEmail" id="email">
                </div>
                <div class="">
                    <input type="submit" class="btn btn-primary inpBtn" value="Entrar em Contato" id="btn" name="btnCadImo">
                </div>
            </form>

        </dialog>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const abrir = document.querySelector("#abrir-dialog");
        const fechar = document.querySelector("#fechar-dialog");
        const dialog = document.querySelector("dialog");

        abrir.addEventListener("click", (e) => {
            dialog.showModal()
        })

        fechar.addEventListener("click", () => {
            dialog.close()
        })


        // REQUISIÇÃO DE FORMULÁRIO PARA O PHP VIA FETCH 
        // recuper o a tag form do formulário
        const inpBtn = document.querySelector("form");

        // evento de submit e no form tb precisa ser submit
        inpBtn.addEventListener("submit", async (event) => {

            event.preventDefault();

            // adiciona a tab form para recuperar todos os valores digitados
            const fData = new FormData(inpBtn);

            const url = "search-alugar.php"

            const data = await fetch(url, {
                method: "post",
                mode: "cors",
                body: fData
            })
            const response = await data.json()
            // console.log(response.msg)
            if (response.msg) {
                document.querySelector('.msg_interesse').style.display = "block"
            } else {
                document.querySelector('.msg_interesse2').style.display = "block"
                setTimeout(() => {
                    document.querySelector('.msg_interesse2').style.display = "none"
                }, 2000)
            }


        })
    </script>
</body>

</html>