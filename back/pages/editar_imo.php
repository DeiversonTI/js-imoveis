<?php

// require_once "../conn/conn.php";
// require "../Links.php";

$id = $_GET['id'];
require "../core/admin/header-adm.php";

$query_mani =  "SELECT imo.id, imo.cod_imovel, imo.area, ender.valor_imovel, ender.endereco, ender.num_casa, ender.estado, ender.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
  FROM  imoveis As imo
  INNER JOIN enderecos As ender 
  ON ender.fk_id_imoveis=imo.id
  INNER JOIN sit_imoveis As sit
  ON sit.fk_id_imoveis=imo.id
  WHERE imo.id=:id LIMIT 1";
$query_banner_mani = $conn->prepare($query_mani);
$query_banner_mani->bindParam(":id", $id);
$query_banner_mani->execute();
$res_imo = $query_banner_mani->fetch(PDO::FETCH_ASSOC);
// var_dump($res_imo);
extract($res_imo);
// var_dump($res_imo);

$query_img =  "SELECT * FROM images_imoveis_one WHERE fk_id_imoveis=:id LIMIT 1";
$query_img_imo = $conn->prepare($query_img);
$query_img_imo->bindParam(":id", $id);
$query_img_imo->execute();
$result_img = $query_img_imo->fetch(PDO::FETCH_ASSOC);
// var_dump($result_img);

// var_dump(URLIMOVEIS . $id . "/" . $result_img['images']);

require "../core/admin/navbar-adm.php";

?>

<div id="darkModeColor" class="col col-xl-6 dark_color container border border-1 p-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Atualizar Imóvel</h1>
        <a class="btn btn-outline-danger" href="../pages/index.php">Voltar</a>
    </div>
    <form action="../model/upt_imoveis.php" method="post" class="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row row-cols-1 row-cols-xl-2 ">
            <div class="col col-lg-6">
                <!-- <label class="form-label float-start">Imagem Home</label><br><br> -->
                <!-- <img class="float-start" src="<?php echo URLIMGONE . $result_img['images']; ?>" alt="" style="max-width: 200px; margin-bottom: 15px;"> -->
                <label class="form-label float-start">Upload da Imagem</label>
                <input type="file" name="images" class="form-control" />
                <label class="form-label float-start">Código do Imóvel</label>
                <input type="text" class="form-control" value="<?php echo $cod_imovel; ?>" name="codigo" placeholder="Código do Imóvel" />
                <label class="form-label float-start">Valor</label>
                <input type="text" class="form-control" value="<?php echo $valor_imovel; ?>" name="valor" placeholder="Valor do Imóvel" />
                <label class="form-label float-start">Endereço</label>
                <input type="text" class="form-control" name="endereco" value="<?php echo $endereco; ?>" placeholder="Endereço do Imóvel" />
                <label class="form-label float-start">Número</label>
                <input type="text" class="form-control" name="numero" value="<?php echo $num_casa; ?>" placeholder="Número do Imóvel" />
                <label class="form-label float-start">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?php echo $estado; ?>" placeholder="Bairro do Imóvel" />
                <label class="form-label float-start">Estado</label>
                <input type="text" class="form-control" name="estado" value="<?php echo $bairro; ?>" placeholder="Estado do Imóvel" />
                <label class="form-label float-start">Situação</label>
                <select class="form-select" name="situacao">
                    <option value="<?php echo $situacao; ?>"><?php echo $situacao; ?></option>
                    <option value="comprar">Comprar</option>
                    <option value="Vender">Vender</option>
                </select>
            </div>


            <div class="col col-lg-6">
                <div class="row">
                    <div class="col">
                        <label class="form-label float-start">Dormitório</label>
                        <input type="number" class="form-control" value="<?php echo $dormitorio; ?>" name="dormitorio" placeholder="Número de Dormitório">
                    </div>
                    <div class="col">
                        <label class="form-label float-start">Banheiro</label>
                        <input type="number" class="form-control" value="<?php echo $banheiro; ?>" name="banheiro" placeholder="Número de Banheiro">
                    </div>
                </div>

                <label class="form-label float-start">Suite</label>
                <input type="number" class="form-control" value="<?php echo $suite; ?>" name="suite" placeholder="Número de Suíte">

                <label class="form-label float-start">Vagas de Carro</label>
                <input type="number" class="form-control" value="<?php echo $vagas; ?>" name="vagas" placeholder="Número de Vagas">


                <label class="form-label float-start">Piscina</label>
                <select class="form-select" value="" name="piscina">
                    <option value="<?php echo $piscina; ?>"><?php echo $piscina; ?></option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
                <label class="form-label float-start">Churrasqueira</label>
                <select class="form-select" name="churrasqueira">
                    <option value="<?php echo $churrasqueira; ?>"><?php echo $churrasqueira; ?></option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>

                <label class="form-label float-start">Imagem</label>
                <input type="file" name="imagens[]" multiple class="form-control" />
                <label class="form-label float-start">Tipo do Imóvel</label>
                <select class="form-select" name="tipo_imovel">
                    <option value="<?php echo $tipo_imovel; ?>"><?php echo $tipo_imovel; ?></option>
                    <option value="Casa">Casa</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Sítio">Sítio</option>
                    <option value="Chácara">Chácara</option>
                </select>
                <label class="form-label float-start">Área Total</label>
                <input type="text" class="form-control" value="<?php echo $area; ?>" name="area" placeholder="Área total">
            </div>
        </div>
        <div class="col">
            <div>
                <label class="form-label float-start">Descrição do Imóvel</label><br>
                <textarea class="" id="trumbowyg-demo" name="descricao"><?php echo $descricao; ?></textarea>
            </div>
            <div style="width: 100%;" class="mt-2 col  d-flex justify-content-center align-items-center ">
                <input type="submit" class="btn btn-primary px-5 py-2" value="Atualizar Imóveis" name="btnSalvarImovel" />
            </div>
        </div>
    </form>
</div>

<?php require "../core/admin/footer-adm.php"; ?>