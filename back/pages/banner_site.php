<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    require "../core/admin/header-adm.php";
    
      // RECUPERAR A BANNER DO BANCO
      $sel_banner = "SELECT * FROM img_banner";
      $query_banner = $conn->prepare($sel_banner);
      $query_banner->execute();
      // conta quantas imagens tem no banco
      $count_banner = $query_banner->rowCount();
  
      $res_ban = $query_banner->fetchAll(PDO::FETCH_ASSOC);
      // var_dump($result);

    // // UPLOAD IMAGEM BANNER
    if (array_key_exists('files', $_FILES)) {

        $banner = $_FILES['files'];
        $img = $banner['name'];
        $tmp = $banner['tmp_name'];

        $dest = ".././img/banner/$img/";

        if (move_uploaded_file($tmp, $dest)) {
            $res = "INSERT INTO img_banner (imag_banner, created) VALUES (:imag_banner, NOW())";
            $result_db = $conn->prepare($res);
            $result_db->bindParam(':imag_banner', $img);
            $retorno = $result_db->execute();

            if ($result_db->rowCount()) {
                $_SESSION['msg_banner'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso!</div>";
                header("Location: ../pages/banner_site.php");
            }
        }
    }
    require "../core/admin/navbar-adm.php";

   
?>

    <div>
        <div class="container">
                     
            <div class="text-center">
                <div class="row ">
                    <div class="col col-md-8  mx-auto p-3">
                    <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
                        <div id="darkModeColor" class="dark_color border border-1 px-1 rounded ">
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
                    </div>
                    <!-- INICIO BANNER -->
                    <div class="col col-md-8 mx-auto">
                    <div class="border border-1 mt-1 px-3 py-2 rounded ">
                            <!-- <h5 class="text-start mr-2 px-3 pt-2 ">Banner do Site</h5> -->
                            <?php
                            if (isset($_SESSION['img_one_del'])) {
                                echo $_SESSION['img_one_del'];
                                unset($_SESSION['img_one_del']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 px-2">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong><?php echo $count_banner; ?></strong> - Banner(s) Cadastrada(s)</span>
                                        </div>
                                        <?php
                                        foreach ($res_ban as $res_banner) :
                                            extract($res_banner);
                                        ?>

                                            <div class="col py-1">
                                                <div id="darkModeColor" class=" dark_color p-2 rounded d-flex border border-light-subtle justify-content-between align-items-center gap-3 shadow-sm ">
                                                    <div class="d-flex d-flex align-items-center gap-3">
                                                        <img src="<?php echo URLBANNER . $imag_banner ?>" alt="" style="max-width: 60px; margin-right:10px;">
                                                        <span class="me-3"><?php echo $imag_banner ?></span>
                                                    </div>
                                                    <div class="">

                                                        <a title="Selecionar o BANNER principal do site" class="btn btn-warning me-1 btn-sm" href="../pages/update_img_one.php?id=<?php echo $id; ?>">
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
                    </div>

                        <!-- FIM BANNER -->

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