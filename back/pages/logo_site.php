<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    // DENTRO DE HEADER TEM A CONEXÃO COM O BANCO DE DADOS GLOBAL
    require "../core/admin/header-adm.php";

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
            }
        }
    }   

   
    require "../core/admin/navbar-adm.php";
?>

    <div>
        <div class="container">
            <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>            -->
            <div class="text-center">
                <div class=" row mx-auto ">
                    <div class=" col-9 p-3 mx-auto">
                    <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> 
                        <div class="border border-1 mt-1 px-1 ">
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