<?php

session_start();
ob_start();


// require_once "../conn/conn.php";

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";

    // RECUPERAR A LOGO DO BANCO
    $sel_logo = "SELECT * FROM logo";
    $query_logo = $conn->prepare($sel_logo);
    $query_logo->execute();
    // conta quantas imagens tem no banco
    $count_logo = $query_logo->rowCount();

    $result = $query_logo->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);


    // RECUPERAR A TITLE DO BANCO
    $sel_five = "SELECT * FROM title";
    $query_five = $conn->prepare($sel_five);
    $query_five->execute();
    // conta quantas imagens tem no banco
    $count_logo_favicon = $query_five->rowCount();

    $res_favicon = $query_five->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);

    // RECUPERAR A BANNER DO BANCO
    $sel_banner = "SELECT * FROM img_banner";
    $query_banner = $conn->prepare($sel_banner);
    $query_banner->execute();
    // conta quantas imagens tem no banco
    $count_banner = $query_banner->rowCount();

    $res_banner = $query_banner->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);


?>
    <div>
        <div class="container">
            <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
            <div class="text-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2   ">
                    <div class="col p-3">
                        <!-- LOGO SITE -->
                        <div class="border border-1 mt-1 px-1 ">
                            <h5 class="text-start mr-2 px-3 py-2">Logo do Site</h5>
                            <?php
                            if (isset($_SESSION['img_logo'])) {
                                echo $_SESSION['img_logo'];
                                unset($_SESSION['img_logo']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 p-1">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong class="text-dark"><?php echo $count_logo; ?></strong> - Logo(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($result as $res_logo) :
                                            extract($res_logo);
                                        ?>
                                            <!-- LOGO -->
                                            <div class="col py-1">
                                                <div style="background-color: #cae9ef;" class="p-2 rounded d-flex justify-content-between align-items-center gap-3 shadow-sm ">
                                                    <div class="d-flex d-flex align-items-center gap-3">
                                                        <img src="<?php echo URLLOGO . $img_logo ?>" alt="" style="max-width: 60px; margin-right:10px;">
                                                        <span class="me-3"><?php echo $img_logo ?></span>
                                                    </div>
                                                    <div class="">

                                                        <!-- <a title="Selecionar a logo principal do site" class="btn btn-warning me-1 btn-sm" href="../pages/update_img_one.php?id=<?php echo $id; ?>">
                                                        <i style="color:#2890d2;" class="fa-solid fa-check"></i>
                                                    </a> -->
                                                        <a title="Deletar Imagem" class="btn btn-danger btn-sm" href="../pages/delete_img_logo.php?id=<?php echo $id; ?>">
                                                            <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIM LOGO SITE -->

                        <!-- INICIO LOGO FIVICON -->
                        <div class="border border-1 mt-1 px-1 ">
                            <h5 class="text-start mr-2 px-3 py-2">Logo do Favicon</h5>
                            <?php
                            if (isset($_SESSION['five'])) {
                                echo $_SESSION['five'];
                                unset($_SESSION['five']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 p-1">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong class="text-dark"><?php echo $count_logo_favicon; ?></strong> - Logo(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($res_favicon as $res_fav) :
                                            extract($res_fav);
                                        ?>
                                            <!-- FAVICON -->
                                            <div class="col py-1">
                                                <div style="background-color: #cae9ef;" class="p-2 rounded d-flex flex-column   shadow-sm ">
                                                    <div class="d-flex flex-column ">
                                                        <span>
                                                            <img src="<?php echo URLFAVICON . $img_fivecon ?>" alt="" style="max-width: 60px; margin-right:10px;">
                                                        </span>
                                                        <span class=""><?php echo $img_fivecon ?></span>
                                                        <span><b>Titulo do Site: </b> <?php echo $title_site ?></span>
                                                        <span><b>Palavras Chave: </b> <?php echo $keywords ?></span>
                                                        <span><b>Descrição: </b> <?php echo $descript ?></span>

                                                    </div>
                                                    <div class="row gap-3 justify-content-center mt-3">
                                                        <a title="Editar Imagem" class="col-5 btn btn-success btn-sm " href="../pages/editar_img_five.php?id=<?php echo $id; ?>">
                                                            <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                        </a>
                                                        <a title="Deletar Imagem" class="col-5 btn btn-danger btn-sm " href="../pages/delete_img_five.php?id=<?php echo $id; ?>">
                                                            <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>

                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIM FAVICON -->


                        <!-- INICIO BANNER -->
                        <div class="border border-1 mt-1 px-1 ">
                            <h5 class="text-start mr-2 px-3 py-2">Banner do Site</h5>
                            <?php
                            if (isset($_SESSION['img_one'])) {
                                echo $_SESSION['img_one'];
                                unset($_SESSION['img_one']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 p-1">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong class="text-dark"><?php echo $count_banner; ?></strong> - Banner(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($res_banner as $res_banner) :
                                            extract($res_banner);
                                        ?>
                                          
                                            <div class="col py-1">
                                                <div style="background-color: #cae9ef;" class="p-2 rounded d-flex justify-content-between align-items-center gap-3 shadow-sm ">
                                                    <div class="d-flex d-flex align-items-center gap-3">
                                                        <img src="<?php echo URLBANNER . $imag_banner ?>" alt="" style="max-width: 60px; margin-right:10px;">
                                                        <span class="me-3"><?php echo $imag_banner ?></span>
                                                    </div>
                                                    <div class="">

                                                        <a title="Selecionar a logo principal do site" class="btn btn-warning me-1 btn-sm" href="../pages/update_img_one.php?id=<?php echo $id; ?>">
                                                            <i style="color:#2890d2;" class="fa-solid fa-check"></i>
                                                        </a>
                                                        <a title="Deletar Imagem" class="btn btn-danger btn-sm" href="../pages/delete_img_one.php?id=<?php echo $id; ?>">
                                                            <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FIM BANNER -->

                    </div>



                </div>
            </div>
        </div>
    </div>
    </div>

<?php require "../core/admin/footer-adm.php";
} else {
    header("Location: ../.././js-imoveis/admin.php");
    exit;
}
?>