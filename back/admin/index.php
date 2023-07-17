<?php

session_start();
ob_start();



require_once "../conn/conn.php";
require "../links.php";

if(isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)){
    // echo "Bem vindo " . $_SESSION['nome']."<br>";
    // echo "Nível " . $_SESSION['nivel'];
}else{
    header("Location: ../pages/login.php");
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

            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso!</div>";

            //  $newId = $conn->lastInsertId();
            //  $res_id = "INSERT INTO mani_banner (fk_id_img_banner) VALUES (:fk_id_img_banner)";
            //  $result_db_id = $conn->prepare($res_id);
            //  $result_db_id->bindParam(':fk_id_img_banner', $newId);
            //  $rest = $result_db_id->execute();
        }
    }
}
// FIM UPLOAD IMAGEM BANNER

// RECUPERAR IMAGENS DO BANCO

$sel_img = "SELECT * FROM img_banner";
$query_img = $conn->prepare($sel_img);
$query_img->execute();

$res = $query_img->fetchAll(PDO::FETCH_ASSOC);

require "../core/include/admin/header-adm.php";
require "../core/include/admin/navbar-adm.php";
?>

<div>
    <div class="container">
        <h1 class="py-2 text-light-emphasis display-1 ">Painel Administrativo</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="text-center">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2   ">
                <div class="col p-3">
                    <div class="border border-1  ">
                        <h1>Upload Imagem Banner</h1>

                        <form action="" method="post" class="p-2 " enctype="multipart/form-data">
                            <div>
                                <input type="file" name="files" class="form-control" onchange="previewImage()" id="files"><br>
                                <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarBanner" />
                            </div>
                        </form>
                        <div class="mt-5">
                            <img id="preview" class="img_preview_banner">
                        </div>
                    </div>

                </div>

                <div class="col p-3">
                    <div class="border border-1">
                        <div class="row row-cols-1 row-cols-sm-2  p-1">
                            <?php
                            foreach ($res as $retorno) :
                                extract($retorno);
                            ?>
                                <div class="col py-2">
                                    <div class="p-3 bg-light d-flex flex-column justify-content-center align-items-center gap-3 shadow-sm ">
                                        <div class="d-flex flex-column gap-3">
                                            <img src="<?php echo URLBANNER . $imag_banner ?>" alt="" style="max-width: 150px; margin-right:10px;">
                                            <span class="me-3"><?php echo $imag_banner ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <a class="btn btn-warning me-2" href="../pages/update_img_one.php?id=<?php echo $id; ?>">Selecionar</a>
                                            <a class="btn btn-primary" href="../pages/delete_img_one.php?id=<?php echo $id; ?>">Deletar</a>
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