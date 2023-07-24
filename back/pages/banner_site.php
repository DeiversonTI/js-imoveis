<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";

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
            }
        }
    }
  
   
?>

    <div>
        <div class="container">
                     
            <div class="text-center">
                <div class="row ">
                    <div class="col-12 mx-auto col-lg-9 p-3">
                    <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
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