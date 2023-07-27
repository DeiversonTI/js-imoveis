<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    require "../core/admin/header-adm.php";
    

     // RECUPERAR A TITLE DO BANCO
     $sel_five = "SELECT * FROM title";
     $query_five = $conn->prepare($sel_five);
     $query_five->execute();
     // conta quantas imagens tem no banco
     $count_logo_favicon = $query_five->rowCount();
 
     $res_favicon = $query_five->fetchAll(PDO::FETCH_ASSOC);
     // var_dump($result);

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
                header("Location: ../pages/title_site.php ");
            }
        }
    }
    // FIM UPLOAD IMAGEM BANNER
    require "../core/admin/navbar-adm.php";


?>

    <div>
        <div class="container">

            <div class="text-center">
                <div class="row ">
                    <div class="col col-md-8 p-3 mx-auto">
                        <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->
                        <div id="darkModeColor" class="dark_color border border-1 px-1 rounded ">
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
                                <div class="row px-2">
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
                    <!-- INICIO LOGO FIVICON -->
                    <div class="col col-md-8 mx-auto">
                        <div class="border border-1 mt-1 px-1 ">
                            <h5 class="text-start mr-2 px-3 pt-2">Favicon e Informações do head Cadastrado - SEO</h5>
                            <?php
                            if (isset($_SESSION['five_del'])) {
                                echo $_SESSION['five_del'];
                                unset($_SESSION['five_del']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 p-1">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong><?php echo $count_logo_favicon; ?></strong> - Logo(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($res_favicon as $res_fav) :
                                            extract($res_fav);
                                        ?>
                                            <!-- FAVICON -->
                                            <div class="col py-1">
                                                <div id="darkModeColor" class="dark_color p-2 rounded d-flex flex-column border border-light-subtle  shadow-sm ">
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
                        <div class="w-100  text-start"><small>Obs.: Fivecon é a logo do aparece no navegador e as informações são para os robôs do google.</small></div>
                    </div>
                    <!-- FIM FAVICON -->
                    
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