<?php

session_start();
ob_start();


// require_once "../conn/conn.php";

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel']) == 1) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";

    // RECUPERAR A LOGO DO BANCO
    $sel_msn = "SELECT mc.id, msn.estado, mc.nome, mc.email, mc.cel, mc.tel, mc.assunto, mc.textarea, mc.created FROM message_cliente As mc
                LEFT JOIN estado_msn As msn
                ON msn.fk_id_msn=mc.id
                ORDER BY mc.id DESC";
    $query_msn = $conn->prepare($sel_msn);
    $query_msn->execute();

    // conta quantas imagens tem no banco
    $count_msn = $query_msn->rowCount();

    $result = $query_msn->fetchAll(PDO::FETCH_ASSOC);

    // IMÓVEIS DE INTERESSE
    $sel_interesse = "SELECT inte.id, inte.nome, inte.id_imovel, msn.estado, inte.telefone, inte.email, inte.created 
                FROM imovel_interesse As inte
                LEFT JOIN estado_msn As msn
                ON msn.fk_id_msn=inte.id
                ORDER BY inte.id DESC";
    $query_interesse = $conn->prepare($sel_interesse);
    $query_interesse->execute();

    // conta quantas imagens tem no banco
    $count_msn = $query_interesse->rowCount();

    $result_interesse = $query_interesse->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    // O LOGO ESTÁ VINDO DO BANCO E ADICIONADO NO HEADER, AGORA SÓ CHAMAR A VARIAVEL $URL QUE A IMAGEM APARECE ONDE QUISER


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
                    <!-- DADOS RECUPERADOS DOS IMÓVEIS CADASTRADOS -->
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
                                    <table id="darkModeColor" class="dark_color light_mode w-100 ">
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
                                        foreach ($res_imoveis as $value => $res_imo) :
                                            extract($res_imo);
                                            $valor = number_format($valor_imovel, 0, ".", ".");
                                        ?>
                                            <tr>
                                                <!-- <th scope="row">1</th> -->
                                                <td><?php echo $value + 1 ?></td>
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

                    <!-- MENSAGENS RECUPERADAS DO CLIENTE VINDO DO FORMULÁRIO DE CONTATO -->
                    <div class="col col-md-9 mx-auto  p-1">
                        <div class="px-1">
                            <h5 class="text-start mr-2 px-3 pt-4">Mensagens de Clientes do FORMULÁRIO DE CONTATO</h5>
                            <?php
                            if (isset($_SESSION['msg_msn'])) {
                                echo $_SESSION['msg_msn'];
                                unset($_SESSION['msg_msn']);
                            }

                            ?>
                            <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                                <div class=" col px-4 py-1">
                                    <table id="darkModeColor" class="dark_color light_mode w-100 ">
                                        <tr>
                                            <th scope="col">Qnt</th>
                                            <th scope="col">Status</th>
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
                                        foreach ($result as $value => $res_msn) :
                                            extract($res_msn);
                                        ?>

                                            <tr>
                                                <!-- <th scope="row">1</th> -->
                                                <td><?php echo $value + 1 ?></td>
                                                <td>
                                                    <?php
                                                    echo $estado ? $estado : "Aguardando...";
                                                    ?>
                                                </td>
                                                <td><?php echo $nome ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $cel  ?></td>
                                                <td><?php echo $tel ?></td>
                                                <td><?php echo $assunto ?></td>
                                                <td><?php echo $textarea ?></td>
                                                <td><?php echo $created ?></td>
                                                <td>
                                                    <div class=" d-flex justify-content-center align-items-center gap-2 w-100">
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm w-100 " href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Atendido">Atendido</a>
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary btn-sm w-100" href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Negociando">Negociando</a>
                                                        <a style=" --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-info btn-sm w-100" href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Finalizado">Finalizado</a>
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm w-100" href="../pages/delete_contato_msn.php?id=<?php echo $id; ?>">Deletar</a>

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

                    <!-- MENSAGENS RECUPERADAS DO CLIENTE VINDO DO FORMULÁRIO IMÓVEIS DE INTERESSE -->
                    <div class="col col-md-9 mx-auto  p-1">
                        <div class="px-1">
                            <h5 class="text-start mr-2 px-3 pt-4">Mensagens de Clientes do FORMULÁRIO IMÓVEIS INTERESSADOS</h5>
                            <?php
                            if (isset($_SESSION['msg_msn'])) {
                                echo $_SESSION['msg_msn'];
                                unset($_SESSION['msg_msn']);
                            }

                            ?>
                            <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                                <div class=" col px-4 py-1">
                                    <table id="darkModeColor" class="dark_color light_mode w-100 ">
                                        <tr>
                                            <th scope="col">Qnt</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Imóvel</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Recebido em: </th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        <?php
                                        foreach ($result_interesse as $value => $res_inte) :
                                            extract($res_inte);
                                        ?>

                                            <tr>
                                                <!-- <th scope="row">1</th> -->
                                                <td><?php echo $value + 1 ?></td>
                                                <td>
                                                    <?php
                                                    echo $estado ? $estado : "Aguardando...";
                                                    ?>
                                                </td>
                                                <td><?php echo $id_imovel ?></td>
                                                <td><?php echo $nome ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $tel ?></td>
                                                <td><?php echo $created ?></td>
                                                <td>
                                                    <div class=" d-flex justify-content-center align-items-center gap-2 w-100">
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm w-100 " href="../pages/imoveis-cliente-interesse.php?id=<?php echo $id_imovel; ?>">Imóvel</a>
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm w-100 " href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Atendido">Atendido</a>
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary btn-sm w-100" href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Negociando">Negociando</a>
                                                        <a style=" --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-info btn-sm w-100" href="../pages/status-msn.php?id=<?php echo $id ?>&nome=Finalizado">Finalizado</a>
                                                        <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm w-100" href="../pages/delete_contato_msn.php?id=<?php echo $id; ?>">Deletar</a>

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