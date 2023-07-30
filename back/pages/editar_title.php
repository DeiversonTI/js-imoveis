<?php
session_start();
ob_start();

require "../core/admin/header-adm.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query_title =  "SELECT * FROM title WHERE id=:id ORDER BY id DESC LIMIT 1";
$query_up_title = $conn->prepare($query_title);
$query_up_title->bindParam(":id", $id);
$query_up_title->execute();
$res = $query_up_title->fetch(PDO::FETCH_ASSOC);
// var_dump($res);

$dadosUser = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($dadosUser);
// // UPLOAD FIVICON 
if (array_key_exists('files', $_FILES)) {

    $banner_logo = $_FILES['files'];
    // var_dump($banner_logo);
    $img = $banner_logo['name'];
    $tmp = $banner_logo['tmp_name'];

    $dest = "../img/favicon/$img/";

    if (move_uploaded_file($tmp, $dest)) {

        $res_title_img = "UPDATE title SET img_fivecon=:img_fivecon, modified=NOW() WHERE id=:id";
        $result_db_title_img = $conn->prepare($res_title_img);
        $result_db_title_img->bindParam(':id', $id);
        $result_db_title_img->bindParam(':img_fivecon', $img);
        $result_db_title_img->execute();

        if ($result_db_title_img->rowCount()) {
            $_SESSION['five_del'] = "<div class='alert alert-success' role='alert'>Title Atualizado com Sucesso!</div>";
            header("Location: ../pages/title_site.php");
        }
    }
}

if (!empty($dadosUser['btnAtualizar'])) {
    $res_title = "UPDATE title SET title_site=:title_site, slug=:slug, sub_slug=:sub_slug, keywords=:keywords, descript=:descript, modified=NOW() WHERE id=:id";
    $result_db_title = $conn->prepare($res_title);
    $result_db_title->bindParam(':id', $id);
    // $result_db_title->bindParam(':img_fivecon', $img);
    $result_db_title->bindParam(':title_site', $dadosUser['title']);
    $result_db_title->bindParam(':slug', $dadosUser['slug']);
    $result_db_title->bindParam(':sub_slug', $dadosUser['sub_slug']);
    $result_db_title->bindParam(':keywords', $dadosUser['keywords']);
    $result_db_title->bindParam(':descript', $dadosUser['descript']);
    $result_db_title->execute();

    if ($result_db_title->rowCount()) {
        $_SESSION['five_del'] = "<div class='alert alert-success' role='alert'>Title Atualizado com Sucesso!</div>";
        header("Location: ../pages/title_site.php");
    }
}

// FIM UPLOAD IMAGEM BANNER
require "../core/admin/navbar-adm.php";


?>

<div class="row ">
    <div class="col col-md-4 p-3 mx-auto">
        <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->
        <div id="darkModeColor" class="dark_color border border-1 px-3 rounded ">
            <!-- UPLOAD DO BANNER -->
            <h5 class="text-start mr-2 px-3 py-2">Atualizar Title</h5>          

            <form action="" method="post" class="p-2 " enctype="multipart/form-data">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">
                    <div class="col col-xl-7 mb-5">
                        <input type="file" name="files" class="form-control" onchange="previewImage()" id="files"><br />
                        <img src="<?php echo URLFAVICON . $res['img_fivecon'] ?>" alt="">


                    </div>
                    <div class="col col-xl-5 ">
                        <div class="py-5 d-flex justify-content-center align-items-center border border-1 rounded">
                            <img id="preview" class="img_preview_title">
                        </div>
                        <small style="font-size: .7em; font-weight: 200;" class="">Preview da Imagem</small>
                    </div>
                </div>
                <div class="row px-2">

                    <div class="col gy-2  ">
                        <label class="form-label float-start ">Title do Site</label>
                        <input class=" form-control" value="<?php echo $res['title_site'] ?>" type="text" name="title" placeholder="Titulo do site">

                        <label class="form-label float-start ">Slug</label>
                        <input class=" form-control" value="<?php echo $res['slug'] ?>" type="text" name="slug" placeholder="Slug do site">

                        <label class="form-label float-start ">Sub Slug</label>
                        <input class=" form-control" value="<?php echo $res['sub_slug'] ?>" type="text" name="sub_slug" placeholder="Sub Slug do site">

                        <label class="form-label float-start mt-3 ">Palavra-Chave</label>
                        <input class=" form-control" value="<?php echo $res['keywords'] ?>" type="text" name="keywords" placeholder="Piscina, churrasqueira, vagas, casa">

                        <label class="form-label float-start mt-3">Descrição do Site</label>
                        <input class=" form-control" value="<?php echo $res['descript'] ?>" type="text" name="descript" placeholder="Descrição do site">
                    </div>

                    <div>
                        <input type="submit" class="btn btn-success px-5 mt-3" value="Atualizar" name="btnAtualizar" />
                        <a class="float-end btn btn-outline-danger px-5 mt-3" href="../pages/title_site.php">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php require "../core/admin/footer-adm.php"; ?>