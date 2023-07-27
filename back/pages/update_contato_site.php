<?php

session_start();

require "../core/admin/header-adm.php";
require "../core/admin/navbar-adm.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
// var_dump($id);

 // RECUPERAR A BANNER DO BANCO
 $sel_cont = "SELECT * FROM contato_empresa WHERE id=:id LIMIT 1";
 $query_cont = $conn->prepare($sel_cont);
 $query_cont->bindParam(":id", $id);
 $query_cont->execute();
 // conta quantas imagens tem no banco
//  $count_cont = $query_cont->rowCount();

 $res_cont = $query_cont->fetch(PDO::FETCH_ASSOC);
 extract($res_cont);

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($dados);

if (!empty($dados['btnContatos'])) {
    $res = "UPDATE contato_empresa SET nome=:nome, creci=:creci, email=:email, semana=:semana, horario=:horario, endereco=:endereco, numero=:numero, bairro=:bairro, tel_one=:tel_one, tel_two=:tel_two, facebook=:facebook, instagram=:instagram, modified=NOW() WHERE id=:id";
    $result_db_cont = $conn->prepare($res);    
    $result_db_cont->bindParam(':id', $res_cont['id']);
    $result_db_cont->bindParam(':nome', $dados['nome']);
    $result_db_cont->bindParam(':creci', $dados['creci']);
    $result_db_cont->bindParam(':email', $dados['email']);
    $result_db_cont->bindParam(':semana', $dados['semana']);
    $result_db_cont->bindParam(':horario', $dados['horario']);
    $result_db_cont->bindParam(':endereco', $dados['endereco']);
    $result_db_cont->bindParam(':numero', $dados['numero']);
    $result_db_cont->bindParam(':bairro', $dados['bairro']);
    $result_db_cont->bindParam(':tel_one', $dados['tel_one']);
    $result_db_cont->bindParam(':tel_two', $dados['tel_two']);
    $result_db_cont->bindParam(':facebook', $dados['facebook']);
    $result_db_cont->bindParam(':instagram', $dados['instagram']);
    $result_db_cont->execute();
    if ($result_db_cont->rowCount()) {

        $_SESSION['update_contato'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Selecionado com Sucesso!</div>";
        header("Location: ../pages/contact.php ");
    }
}

?>
<div class="container">
<div id="darkModeColor" class="dark_color border border-1 px-1 mt-5 rounded ">
    <!-- UPLOAD DO BANNER -->
    <h5 class="text-start mr-2 px-3 py-2">Atualizar Contatos do Site</h5>
    <form action="" method="post" class="p-2">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-3 mx-2">
            <div class="col">
                <div class="mb-3">
                    <label class="float-start form-label">Nome Corretor</label>
                    <input type="text" value="<?php echo $nome?>" class="form-control" name="nome" placeholder="Nome do Corretor">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Registro CRECI</label>
                    <input type="text" value="<?php echo $creci?>" class="form-control" name="creci" placeholder="Somente o número do CRECI">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Email</label>
                    <input type="text" value="<?php echo $email?>" class="form-control" name="email" placeholder="Email do Corretor">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Dias da Semana</label>
                    <input type="text" value="<?php echo $semana?>" class="form-control" name="semana" placeholder="Insira o período da semana ex.: Segunda à Sábado">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="float-start form-label">Horários</label>
                    <input type="text" value="<?php echo $horario?>" class="form-control" name="horario" placeholder="Insira os horários ex.: 8h às 17h ">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Endereço</label>
                    <input type="text" value="<?php echo $endereco?>" class="form-control" name="endereco" placeholder="Endereço da Empresa">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Número</label>
                    <input type="text" value="<?php echo $numero?>" class="form-control" name="numero" placeholder="Número da Empresa">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Bairro</label>
                    <input type="text" value="<?php echo $bairro?>" class="form-control" name="bairro" placeholder="Bairro da Empresa">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="float-start form-label">Telefone 1</label>
                    <input type="text" value="<?php echo $tel_one?>" class="form-control" name="tel_one" placeholder="Telefone de Contato">
                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Telefone 2</label>
                    <input type="text" value="<?php echo $tel_two?>" class="form-control" name="tel_two" placeholder="Telefone de Contato">
                </div>
                <!-- REDES SOCIAIS -->
                <div class="mb-3">
                    <label class="float-start form-label">Facebook</label>
                    <input type="text" value="<?php echo $facebook?>" class="form-control" name="facebook" placeholder="Cole aqui o endereço do facebook">

                </div>
                <div class="mb-3">
                    <label class="float-start form-label">Instagram</label>
                    <input type="text" value="<?php echo $instagram?>" class="form-control" name="instagram" placeholder="Cole aqui o endereço do Instragram">
                </div>
            </div>
            <div class="mb-3">
            <input type="submit" class="btn btn-success px-5 mt-3" value="Atualizar" name="btnContatos" />
        </div>
        </div>
        

    </form>
</div>
</div>
<?php require "../core/admin/footer-adm.php";