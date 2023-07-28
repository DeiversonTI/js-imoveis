<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    require "../core/admin/header-adm.php";

    // RECUPERAR A BANNER DO BANCO
    $sel_cont = "SELECT * FROM contato_empresa";
    $query_cont = $conn->prepare($sel_cont);
    $query_cont->execute();
    // conta quantas imagens tem no banco
    $count_cont = $query_cont->rowCount();

    $res_cont = $query_cont->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['btnSalvarContato'])) {

        $res = "INSERT INTO contato_empresa (nome, creci, email, semana, horario, endereco, numero, bairro, tel_one, tel_two, facebook, instagram, created) 
                                    VALUES (:nome, :creci, :email, :semana, :horario, :endereco, :numero, :bairro, :tel_one, :tel_two, :facebook, :instagram, NOW())";
        $result_db = $conn->prepare($res);
        $result_db->bindParam(':nome', $dados['nome']);
        $result_db->bindParam(':creci', $dados['creci']);
        $result_db->bindParam(':email', $dados['email']);
        $result_db->bindParam(':semana', $dados['semana']);
        $result_db->bindParam(':horario', $dados['horario']);
        $result_db->bindParam(':endereco', $dados['endereco']);
        $result_db->bindParam(':numero', $dados['numero']);
        $result_db->bindParam(':bairro', $dados['bairro']);
        $result_db->bindParam(':tel_one', $dados['tel_one']);
        $result_db->bindParam(':tel_two', $dados['tel_two']);
        $result_db->bindParam(':facebook', $dados['facebook']);
        $result_db->bindParam(':instagram', $dados['instagram']);
        $result_db->execute();

        if ($result_db->rowCount()) {
            $_SESSION['contact'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso!</div>";
            header("Location: ../pages/contact.php");
        }
    }

    require "../core/admin/navbar-adm.php";
?>

    <div>
        <div class="container">
            <div class="text-center">
                <div class="row row-cols-1 row-cols-lg-1">
                    <div class="col col-md-8 mx-auto  p-3">
                        <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->
                        <div id="darkModeColor" class="dark_color border border-1 px-1 rounded ">
                            <!-- UPLOAD DO BANNER -->
                            <h5 class="text-start mr-2 px-3 py-2">Cadastro de Contatos do Site</h5>
                            <?php
                            if (isset($_SESSION['contact'])) {
                                echo $_SESSION['contact'];
                                unset($_SESSION['contact']);
                            }
                            ?>

                            <form action="" method="post" class="p-2">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-3 mx-2">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="float-start form-label">Nome Corretor</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Nome do Corretor">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Registro CRECI</label>
                                            <input type="text" class="form-control" name="creci" placeholder="Somente o número do CRECI">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Email do Corretor">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Dias da Semana</label>
                                            <input type="text" class="form-control" name="semana" placeholder="Insira o período da semana ex.: Segunda à Sábado">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="float-start form-label">Horários</label>
                                            <input type="text" class="form-control" name="horario" placeholder="Insira os horários ex.: 8h às 17h ">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Endereço</label>
                                            <input type="text" class="form-control" name="endereco" placeholder="Endereço da Empresa">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Número</label>
                                            <input type="text" class="form-control" name="numero" placeholder="Número da Empresa">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Bairro</label>
                                            <input type="text" class="form-control" name="bairro" placeholder="Bairro da Empresa">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="float-start form-label">Telefone 1</label>
                                            <input type="text" class="form-control" name="tel_one" placeholder="Telefone de Contato">
                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Telefone 2</label>
                                            <input type="text" class="form-control" name="tel_two" placeholder="Telefone de Contato">
                                        </div>
                                        <!-- REDES SOCIAIS -->
                                        <div class="mb-3">
                                            <label class="float-start form-label">Facebook</label>
                                            <input type="text" class="form-control" name="facebook" placeholder="Cole aqui o endereço do facebook">

                                        </div>
                                        <div class="mb-3">
                                            <label class="float-start form-label">Instagram</label>
                                            <input type="text" class="form-control" name="instagram" placeholder="Cole aqui o endereço do Instragram">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarContato" />
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- INICIO BANNER -->
                    <div class="col col-md-8 mx-auto">
                        <div class="border border-1 mt-1 px-3 py-2 rounded ">
                            <!-- <h5 class="text-start mr-2 px-3 pt-2 ">Banner do Site</h5> -->
                            <?php
                            if (isset($_SESSION['del_cont'])) {
                                echo $_SESSION['del_cont'];
                                unset($_SESSION['del_cont']);
                            }

                            ?>
                            <div class="mt-3 mb-4">
                                <div>
                                    <div class="row row-cols-1 px-2">
                                        <div class="mx-3 p-1" style="width: 95%;">
                                            <span style="font-family: sans-serif;" class="float-start text-secondary"><strong><?php echo $count_cont; ?></strong> - Contatos do Site</span>
                                        </div>
                                        <?php
                                        foreach ($res_cont as $result_cont) :
                                            extract($result_cont);
                                        ?>

                                            <div class="col py-1">
                                                <div id="darkModeColor" class=" dark_color p-2 rounded d-flex flex-column border border-light-subtle justify-content-between align-items-center gap-3 shadow-sm ">
                                                    <div class="row d-flex w-100 p-2 ">
                                                        <div class="col d-flex flex-column  align-items-start fw-light">
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Corretor:</b> <?php echo $nome ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">CRECI:</b> <?php echo $creci ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">E-mail:</b> <?php echo $email ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Semana:</b> <?php echo $semana ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Horário:</b> <?php echo $horario ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Endereço:</b> <?php echo $endereco ?> - Nº: <?php echo $numero ?> </div>
                                                        </div>
                                                        <div class="col d-flex flex-column  align-items-start fw-light ">
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Bairro:</b> <?php echo $bairro ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Celular:</b> <?php echo $tel_one ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Telefone:</b> <?php echo $tel_two ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Facebook:</b> <?php echo $facebook ?></div>
                                                            <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Instagram:</b> <?php echo $instagram ?></div>

                                                        </div>
                                                        <div class="col  d-flex justify-content-center align-items-center">

                                                            <a title="Editar Informações do contato" class="btn btn-success me-1 btn-lg" href="../pages/update_contato_site.php?id=<?php echo $id; ?>">
                                                                <i style="color:#fff;" class="fa-solid fa-pencil" ></i>
                                                            </a>
                                                            <a title="Deletar Imagem" class="btn btn-danger btn-lg" href="../pages/delete_contato_site.php?id=<?php echo $id; ?>">
                                                                <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                            </a>
                                                        </div>                                                    
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
    

<?php require "../core/admin/footer-adm.php";
} else {
    header("Location: ../.././js-imoveis/admin.php");
    exit;
}
?>