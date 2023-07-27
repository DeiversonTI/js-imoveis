<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    // DENTRO DE HEADER TEM A CONEXÃO COM O BANCO DE DADOS GLOBAL
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


    // UPLOAD LOGO 
    if (array_key_exists('logo', $_FILES)) {

        $banner_logo = $_FILES['logo'];
        $img = $banner_logo['name'];
        $tmp = $banner_logo['tmp_name'];

        $dest = ".././img/logo/$img/";



        if (move_uploaded_file($tmp, $dest)) {
            $res_logo = "INSERT INTO logo (img_logo, created) VALUES (:img_logo, NOW())";
            $result_db_logo = $conn->prepare($res_logo);
            $result_db_logo->bindParam(':img_logo', $img);
            $result = $result_db_logo->execute();

            if ($result_db_logo->rowCount()) {
                $_SESSION['img_logo'] = "<div class='alert alert-success' role='alert'>Logo Cadastrada com Sucesso!</div>";               
                header("Location: ../pages/logo_site.php ");
            }
        }
    }


   
?>

    <div>
        <div class="container">
            <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>            -->
            <div class="text-center">
                <div class=" row row-cols-1  ">
                    <div class=" col col-md-8 p-3  mx-auto">
                        <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>  -->
                        <div id="darkModeColor" class="dark_color border border-1 mt-1 px-1 rounded">
                            <h5 class="text-start mr-2 px-3 py-2">Upload da Logo</h5>
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
                        </div>
                    </div>
                    <!-- LOGO SITE -->
                    <div class="col col-md-8 mx-auto">
                        <div class=" border border-1 mt-1 py-2 px-2  rounded">
                            <!-- <h5 class="text-start pt-2 px-3 ">Logo Cadastrado do Site</h5> -->
                            <?php
                            if (isset($_SESSION['del_img_logo'])) {
                                echo $_SESSION['del_img_logo'];
                                unset($_SESSION['del_img_logo']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 p-1">
                                        <div class="mx-3 p-1">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong><?php echo $count_logo; ?></strong> - Logo(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($result as $res_logo) :
                                            // var_dump($res_logo);
                                            extract($res_logo);
                                        ?>
                                            <!-- LOGO -->
                                            <div class="col py-1">
                                                <!-- PALETA DE CORES, BACKGROUND BOX DAS INFORMAÇÕES DARK #0d2044, #142f54, #203650, #253346   -->
                                                <div id="darkModeColor" class="dark_color p-2 rounded d-flex justify-content-between align-items-center gap-3 border border-light-subtle shadow-sm ">
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
                        <div class="w-100  text-start"><small>Obs.: A Logo será trocada em todas as páginas do site.</small></div>
                    </div>
                    <!-- FIM LOGO SITE -->
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