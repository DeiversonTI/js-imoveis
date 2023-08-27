<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    require "../core/admin/header-adm.php";

    $query = "SELECT imo.id, imo.fk_nome_cli, imo.cod_imovel, imo.area, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
    FROM  imoveis As imo
    INNER JOIN images_imoveis_one As img 
    ON imo.id  = img.fk_id_imoveis
    INNER JOIN enderecos As ende
    ON ende.fk_id_imoveis=imo.id
    INNER JOIN sit_imoveis As sit
    ON sit.fk_id_imoveis=imo.id
    INNER JOIN imovel_interesse As inte
    ON inte.id_imovel = imo.id
    WHERE imo.id LIKE :tt
    ORDER BY imo.id DESC LIMIT 40";

    $query_imo = $conn->prepare($query);
    $query_imo->bindParam(":tt", $id);
    $query_imo->execute();
    $res_imoveis = $query_imo->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($res_imoveis);
    require "../core/admin/navbar-adm.php";
?>
    <div class="text-center">
        <div class="row">
            <div class="col col-md-6 mx-auto p-1">
                <div class="px-1 my-3">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h5 class="text-start mr-2  pt-2">Imóveis do Cliente: <strong><?php echo $res_imoveis[0]['nome'] ?? "No Users" ?></strong> </h5>
                        <a class="btn btn-outline-danger mr-3" href="../pages/cadastro-proprietario.php">voltar</a>
                    </div>
                    <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->

                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }

                    ?>
                    <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                        <div class=" col px-4 py-1">
                            <table id="darkModeColor" class="dark_color light_mode w-100">
                                <tr>
                                    <th scope="col">Preview</th>
                                    <th scope="col">Cód Imóvel</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">Bairro</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">actions</th>
                                </tr>
                                <?php
                                foreach ($res_imoveis as $res_imo) :
                                    extract($res_imo);
                                    $valor = number_format($valor_imovel, 0, ".", ".");
                                ?>
                                    <tr>
                                        <!-- <th scope="row">1</th> -->
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
        </div>
    </div>

<?php
    require "../core/admin/footer-adm.php";
} else {
    header("Location: ../.././js-imoveis/admin.php");
    exit;
}
?>