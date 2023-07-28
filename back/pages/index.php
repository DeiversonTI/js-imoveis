<?php

session_start();
ob_start();


// require_once "../conn/conn.php";

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel']) == 1) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";

    // RECUPERAR A LOGO DO BANCO
    $sel_msn = "SELECT * FROM message_cliente ORDER BY id DESC";
    $query_msn = $conn->prepare($sel_msn);
    $query_msn->execute();
    // conta quantas imagens tem no banco
    $count_msn = $query_msn->rowCount();

    $result = $query_msn->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);


    // // RECUPERAR A TITLE DO BANCO
    // $sel_five = "SELECT * FROM title";
    // $query_five = $conn->prepare($sel_five);
    // $query_five->execute();
    // // conta quantas imagens tem no banco
    // $count_logo_favicon = $query_five->rowCount();

    // $res_favicon = $query_five->fetchAll(PDO::FETCH_ASSOC);
    // // var_dump($result);

    // // RECUPERAR A BANNER DO BANCO
    // $sel_banner = "SELECT * FROM img_banner";
    // $query_banner = $conn->prepare($sel_banner);
    // $query_banner->execute();
    // // conta quantas imagens tem no banco
    // $count_banner = $query_banner->rowCount();

    // $res_ban = $query_banner->fetchAll(PDO::FETCH_ASSOC);
    // // var_dump($result);

    // LISTA DE IMOVEIS VINDO DE DIVERSAS TABELAS VIA INNER JOIN
    $query = "SELECT imo.id, imo.cod_imovel, imo.area, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
    FROM  imoveis As imo
    INNER JOIN images_imoveis_one As img 
    ON imo.id  = img.fk_id_imoveis
    INNER JOIN enderecos As ende
    ON ende.fk_id_imoveis=imo.id
    INNER JOIN sit_imoveis As sit
    ON sit.fk_id_imoveis=imo.id
    ORDER BY imo.id DESC LIMIT 40";

    $query_imo = $conn->prepare($query);
    $query_imo->execute();
    $res_imoveis = $query_imo->fetchAll(PDO::FETCH_ASSOC);

?>
    <div>
        <div class="container-fluid">           
            <div class="text-center">
                <div class="row ">                   
                    <div class="col col-md-9 mx-auto p-1">
                        <div class="px-1">
                        <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1>
                        <h5 class="text-start mr-2 px-3 pt-2">Imóveis Cadastrados</h5>
                        <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }

                            ?>
                            <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                                <div class=" col px-4 py-1">
                                    <table  id="darkModeColor" class="dark_color light_mode w-100 ">
                                        <tr>
                                        <th scope="col">Qnt</th>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Cód Imóvel</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Bairro</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">actions</th>
                                        </tr>
                                        <?php
                                            foreach ($res_imoveis as $value=>$res_imo) :
                                                extract($res_imo);
                                                $valor = number_format($valor_imovel, 0, ".", ".");
                                            ?>
                                                <tr>
                                                    <!-- <th scope="row">1</th> -->
                                                    <td><?php echo $value+1 ?></td>
                                                    <td><img src="<?php echo URLIMGONE . $images ?>" alt="" style="max-width: 50px; "></td>
                                                    <td><?php echo $cod_imovel ?></td>
                                                    <td><?php echo $valor ?></td>
                                                    <td><?php echo $endereco;  ?> - <?php echo $num_casa ?></td>
                                                    <td><?php echo $estado ?></td>
                                                    <td><?php echo $bairro ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm " href="../pages/editar_imo.php?id=<?php echo $id; ?>">Editar</a>
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="../pages/delete_banner.php?id=<?php echo $id; ?>">Deletar</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-md-9 mx-auto  p-1">
                        <div class="px-1">
                        <h5 class="text-start mr-2 px-3 pt-4">Mensagens de Clientes Vindo do Site</h5>   
                        <?php
                            if (isset($_SESSION['msg_msn'])) {
                                echo $_SESSION['msg_msn'];
                                unset($_SESSION['msg_msn']);
                            }

                            ?>                    
                            <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                                <div class=" col px-4 py-1">
                                    <table  id="darkModeColor" class="dark_color light_mode w-100 ">
                                        <tr>
                                        <th scope="col">Qnt</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Assunto</th>
                                        <th scope="col">Mensagem</th>
                                        <th scope="col">Recebimento</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                        <?php
                                            foreach ($result as $value=>$res_msn) :
                                                extract($res_msn);                                                
                                            ?>
                                          
                                                <tr>
                                                    <!-- <th scope="row">1</th> --> 
                                                    <td><?php echo $value+1 ?></td>                                                   
                                                    <td ><?php echo $nome ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $cel  ?></td>
                                                    <td><?php echo $tel ?></td>
                                                    <td><?php echo $assunto ?></td>
                                                    <td><?php echo $textarea ?></td>
                                                    <td><?php echo $created ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary btn-sm " onclick="atendido(<?php echo $id ?>)"  href="#">Atendido</a>
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm" href="#">Aguardando</a>
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="#">Negociando</a>
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="#">Deletar</a>
                                                            <!-- <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="../pages/delete_contato_msn.php?id=<?php echo $id; ?>">Deletar</a> -->
                                                            <!-- <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="../pages/delete_banner.php?id=<?php echo $id; ?>">Negociando</a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            <?php
                                            endforeach;
                                            ?>
                                    </table>
                                </div>
                            </div>
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