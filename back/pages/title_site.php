<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";

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
            $res_logo = "INSERT INTO title (img_fivecon, title_site, keywords, descript, created) 
                                    VALUES (:img_fivecon, :title_site, :keywords, :descript, NOW())";
            $result_db_logo = $conn->prepare($res_logo);
            $result_db_logo->bindParam(':img_fivecon', $img);
            $result_db_logo->bindParam(':title_site', $dadosUser['title']);
            $result_db_logo->bindParam(':keywords', $dadosUser['keywords']);
            $result_db_logo->bindParam(':descript', $dadosUser['descript']);
            $result_db_logo->execute();

            if ($result_db_logo->rowCount()) {
                $_SESSION['favicon'] = "<div class='alert alert-success' role='alert'>Title Cadastrado com Sucesso!</div>";
            }
        }
    }
    // FIM UPLOAD IMAGEM BANNER



?>

    <div>
        <div class="container">
           
            <div class="text-center">
                <div class="row ">
                    <div class="col-md-9 p-3 mx-auto">
                    <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
                        <div class="border border-1 px-1  ">
                            <!-- UPLOAD DO BANNER -->
                            <h5 class="text-start mr-2 px-3 py-2">Upload Favicon</h5>
                            <?php
                            if (isset($_SESSION['favicon'])) {
                                echo $_SESSION['favicon'];
                                unset($_SESSION['favicon']);
                            }
                            ?>

                            <form action="" method="post" class="p-2 " enctype="multipart/form-data">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">
                                    <div class="col col-xl-7 mb-5">
                                        <input type="file" name="files" class="form-control" onchange="previewImage()" id="files"><br>

                                    </div>
                                    <div class="col col-xl-5 ">
                                        <div class="py-5 border border-1 rounded">
                                            <img id="preview" class="img_preview_banner">
                                        </div>
                                        <small style="font-size: .7em; font-weight: 200;" class="">Preview da Imagem</small>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col gy-2  ">
                                        <label class="form-label float-start ">Title do Site</label>
                                        <input class=" form-control" type="text" name="title" placeholder="Titulo do site">

                                        <label class="form-label float-start mt-3 ">Palavra-Chave</label>
                                        <input class=" form-control" type="text" name="keywords" placeholder="Piscina, churrasqueira, vagas, casa">
                                        

                                        <label class="form-label float-start mt-3">Descrição do Site</label>
                                        <input class=" form-control" type="text" name="descript" placeholder="Descrição do site">
                                    </div>
                                  
                                    <div>
                                        <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarFavicon" />
                                    </div>
                                </div>

                            </form>
                        </div>
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