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
                        <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->
                        <div class="border border-1 px-1  ">
                            <!-- UPLOAD DO BANNER -->
                            <h5 class="text-start mr-2 px-3 py-2">Cadastro de Contatos do Site</h5>
                            <?php
                            if (isset($_SESSION['msg_banner'])) {
                                echo $_SESSION['msg_banner'];
                                unset($_SESSION['msg_banner']);
                            }
                            ?>

                            <form action="" method="post" class="p-2">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">
                                    <div class="col col-xl-7" >
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="float-start form-label">Endereço</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Endereço da Empresa">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="float-start form-label">Número</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Número da Empresa">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput3" class="float-start form-label">Bairro</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Bairro da Empresa">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput4" class="float-start form-label">Telefone 1</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput4" placeholder="Telefone de Contato">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput5" class="float-start form-label">Telefone 2</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Telefone de Contato">
                                        </div>
                                        <!-- REDES SOCIAIS -->
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput6" class="float-start form-label">Facebook</label>                                            
                                            <input type="text" class="form-control" id="exampleFormControlInput6" placeholder="Cole aqui o endereço do facebook">
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput7" class="float-start form-label">Instagram</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput7" placeholder="Cole aqui o endereço do Instragram">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarBanner" />
                                        </div>

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