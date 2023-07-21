<?php

session_start();
ob_start();


require_once "../conn/conn.php";
require "../links.php";
// require "./js-imoveis/admin.php"

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {
    
}else{
    header("Location: ../.././js-imoveis/admin.php");
    exit;
}

// // UPLOAD IMAGEM BANNER
if (array_key_exists('files', $_FILES)) {

    $banner = $_FILES['files'];
    $img = $banner['name'];
    $tmp = $banner['tmp_name'];

    $dest = "../img/banner/$img/";

    if (move_uploaded_file($tmp, $dest)) {
        $res = "INSERT INTO img_banner (imag_banner, created) VALUES (:imag_banner, NOW())";
        $result_db = $conn->prepare($res);
        $result_db->bindParam(':imag_banner', $img);
        $retorno = $result_db->execute();

        if ($result_db->rowCount()) {
            $_SESSION['msg_banner'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso!</div>";
        }
    }
}

// // UPLOAD LOGO 
if (array_key_exists('logo', $_FILES)) {

    $banner_logo = $_FILES['logo'];
    $img = $banner_logo['name'];
    $tmp = $banner_logo['tmp_name'];

    $dest = "../img/logo/$img/";

    if (move_uploaded_file($tmp, $dest)) {
        $res_logo = "INSERT INTO logo (img_logo, created) VALUES (:img_logo, NOW())";
        $result_db_logo = $conn->prepare($res_logo);
        $result_db_logo->bindParam(':img_logo', $img);
        $result = $result_db_logo->execute();

        if ($result_db_logo->rowCount()) {
            $_SESSION['img_logo'] = "<div class='alert alert-success' role='alert'>Logo Cadastrada com Sucesso!</div>";
        }
    }
}
// FIM UPLOAD IMAGEM BANNER

// RECUPERAR BANNER DO BANCO
$sel_img = "SELECT * FROM img_banner";
$query_img = $conn->prepare($sel_img);
$query_img->execute();
// conta quantas imagens tem no banco
$count = $query_img->rowCount();

$res = $query_img->fetchAll(PDO::FETCH_ASSOC);

// RECUPERAR A LOGO DO BANCO
$sel_logo = "SELECT * FROM logo";
$query_logo = $conn->prepare($sel_logo);
$query_logo->execute();
// conta quantas imagens tem no banco
$count_logo = $query_logo->rowCount();

$result = $query_logo->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);

require "../core/include/admin/header-adm.php";
require "../core/include/admin/navbar-adm.php";
?>

<div>
    <div class="container">
        <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="text-center">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2   ">
                <div class="col p-3">
                    <div class="border border-1 px-1  ">
                        <!-- UPLOAD DO BANNER -->
                        <h5 class="text-start mr-2 px-3 py-2">Upload Imagem Banner</h5>
                        <?php
                        if (isset($_SESSION['msg_banner'])) {
                            echo $_SESSION['msg_banner'];
                            unset($_SESSION['msg_banner']);
                        }
                        ?>

                        <form action="" method="post" class="p-2 " enctype="multipart/form-data">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">
                                <div class="col col-xl-7 mb-5">
                                    <input type="file" name="files" class="form-control" onchange="previewImage()" id="files"><br>
                                    <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarBanner" />
                                </div>
                                <div class="col col-xl-5 ">
                                    <div class="py-5 border border-1 rounded">
                                        <img id="preview" class="img_preview_banner">
                                    </div>
                                    <small style="font-size: .7em; font-weight: 200;" class="">Preview da Imagem</small>
                                </div>
                               
                            </div>
                        </form>

                    </div>
                    <!-- FIM UPLOAD DO BANNER -->

                    <!-- UPLOAD DO LOGO -->

                    <div class="border border-1 mt-1 px-1 ">
                        <h5 class="text-start mr-2 px-3 py-2">Upload da Logo e fivecon do Site</h5>
                        <?php
                        if (isset($_SESSION['img_logo'])) {
                            echo $_SESSION['img_logo'];
                            unset($_SESSION['img_logo']);
                        }
                        ?>
                        <form action="" method="post" class="  p-2 " enctype="multipart/form-data">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">

                                <div class="col col-xl-7 mb-5">

                                    <input type="file" name="logo" class="form-control" onchange="previewLogo()" id="logo"><br>
                                    <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarLogo" />
                                </div>
                                <div class="col col-xl-5 ">
                                    <div class="py-5 border border-1 rounded">
                                        <img id="preview_logo" class="img_preview_logo">
                                    </div>
                                    <small style="font-size: .7em; font-weight: 200;" class="">Preview da Imagem</small>
                                </div>

                            </div>

                        </form>
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

                </div>

                <div class="col p-3">
                    <div class="border border-1 px-3">

                        <div class="row row-cols-1 p-1">
                            <div class="mx-3 p-1" style="width: 95%;">
                                <span style="font-family: sans-serif;" class="float-start text-secondary"><strong class="text-dark"><?php echo $count; ?></strong> - Imagens Cadastradas</span>
                            </div>
                            <?php

                            if (isset($_SESSION['img_one'])) {
                                echo $_SESSION['img_one'];
                                unset($_SESSION['img_one']);
                            }

                            foreach ($res as $retorno) :
                                extract($retorno);
                            ?>
                                <!-- BANNER -->
                                <div class="col py-1">
                                    <div style="background-color: #cae9ef;" class="p-2 rounded d-flex justify-content-between align-items-center gap-3 shadow-sm ">
                                        <div class="d-flex d-flex align-items-center gap-3">
                                            <img src="<?php echo URLBANNER . $imag_banner ?>" alt="" style="max-width: 60px; margin-right:10px;">
                                            <span class="me-3"><?php echo $imag_banner ?></span>
                                        </div>
                                        <div class="">
                                            <a title="Selecionar a imagem do banner principal do site" class="btn btn-warning me-1 " href="../pages/update_img_one.php?id=<?php echo $id; ?>">
                                                <i style="color:#2890d2;" class="fa-solid fa-check"></i>
                                            </a>
                                            <a title="Deletar Imagem" class="btn btn-danger " href="../pages/delete_img_one.php?id=<?php echo $id; ?>">
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
        </div>
    </div>
</div>
</div>




<?php require "../core/include/admin/footer-adm.php" ?>