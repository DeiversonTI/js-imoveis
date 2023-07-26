<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {   

    require "../core/admin/header-adm.php";   

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
    
    if(!empty($dados['btnSalvarContato'])){

        $res = "INSERT INTO contato_empresa (nome, creci, email, semana, horario, numero, bairro, tel_one, tel_two, facebook, instagram, created) 
                                    VALUES (:nome, :creci, :email, :semana, :horario, :numero, :bairro, :tel_one, :tel_two, :facebook, :instagram, NOW())";
        $result_db = $conn->prepare($res);
        $result_db->bindParam(':nome', $dados['nome']);
        $result_db->bindParam(':creci', $dados['creci']);
        $result_db->bindParam(':email', $dados['email']);
        $result_db->bindParam(':semana', $dados['semana']);
        $result_db->bindParam(':horario', $dados['horario']);
        $result_db->bindParam(':numero', $dados['numero']);
        $result_db->bindParam(':bairro', $dados['bairro']);
        $result_db->bindParam(':tel_one', $dados['tel_one']);
        $result_db->bindParam(':tel_two', $dados['tel_two']);
        $result_db->bindParam(':facebook', $dados['facebook']);
        $result_db->bindParam(':instagram', $dados['instagram']);
        $result_db->execute();

        if ($result_db->rowCount()) {
            $_SESSION['contact'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso!</div>";
        }

    }

    require "../core/admin/navbar-adm.php";
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
                            if (isset($_SESSION['contact'])) {
                                echo $_SESSION['contact'];
                                unset($_SESSION['contact']);
                            }
                            ?>

                            <form action="" method="post" class="p-2">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 mx-2">
                                    <div class="col col-xl-7" >
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
                                        
                                        <div class="mb-3">
                                            <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarContato" />
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