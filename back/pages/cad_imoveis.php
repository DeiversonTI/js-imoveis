<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {

// ASSIM QUE DER POR ESSE LINK DENTRO DO ADMIN-HEADER PARA FICAR GLOBAL
// require "../links.php";

 // DENTRO DE HEADER TEM A CONEXÃO COM O BANCO DE DADOS GLOBAL
 require "../core/admin/header-adm.php";

$query = "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
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
$result = $query_imo->fetchAll(PDO::FETCH_ASSOC);

require "../core/admin/navbar-adm.php";
?>

<section class="mx-3">
    <div class="container">
        <h1 class="py-1 text-light-emphasis  display-6 ">Painel Administrativo</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="text-center">
            <div class=" row  row-cols-2 ">
                <div class="col-4 p-1">
                    <div class="border border-1">
                        <h1>Cadastrar Imóveis</h1>

                        <form action="../model/products.php" method="post" class="p-2" enctype="multipart/form-data">
                            <div class=" g-2">
                                <div class="col ">
                                    <label class="form-label float-start">Imagem Home</label>
                                    <input type="file" name="images" class="form-control" />
                                    <label class="form-label float-start">Código Imóvel</label>
                                    <input type="text" class="form-control" name="codigo" placeholder="Digite o código do Imóvel" />
                                    <label class="form-label float-start">Valor</label>
                                    <input type="text" class="form-control" name="valor" placeholder="Valor do Imóvel" />
                                    <label class="form-label float-start">Endereço</label>
                                    <input type="text" class="form-control" name="endereco" placeholder="Endereço do Imóvel" />
                                    <label class="form-label float-start">Número</label>
                                    <input type="text" class="form-control" name="numero" placeholder="Número do Imóvel" />
                                    <label class="form-label float-start">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" placeholder="Bairro do Imóvel" />
                                    <label class="form-label float-start">Estado</label>
                                    <input type="text" class="form-control" name="estado" placeholder="Estado do Imóvel" />

                                </div>

                                <div class="col">
                                    <label class="form-label float-start">Dormitório</label>
                                    <input type="number" class="form-control" name="dormitorio" placeholder="Número de Dormitório">

                                    <label class="form-label float-start">Banheiro</label>
                                    <input type="number" class="form-control" name="banheiro" placeholder="Número de Banheiro">

                                    <label class="form-label float-start">Suite</label>
                                    <input type="number" class="form-control" name="suite" placeholder="Número de Suíte">

                                    <label class="form-label float-start">Vagas de Carro</label>
                                    <input type="number" class="form-control" name="vagas" placeholder="Número de Vagas">


                                    <label class="form-label float-start">Piscina</label>
                                    <select class="form-select" name="piscina">
                                        <option value="">Selecionar</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <label class="form-label float-start">Churrasqueira</label>
                                    <select class="form-select" name="churrasqueira">
                                        <option value="">Selecionar</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>

                                    <label class="form-label float-start">Imagem</label>
                                    <input type="file" name="imagens[]" multiple class="form-control" />
                                </div>

                                <div class="row row-cols-1">
                                    <div class="col ">
                                        <label class="form-label float-start">Situação</label>
                                        <select class="form-select" name="situacao">
                                            <option value="">Selecionar</option>
                                            <option value="comprar">Comprar</option>
                                            <option value="Vender">Vender</option>
                                        </select>
                                        <label class="form-label float-start">Tipo do Imóvel</label>
                                        <select class="form-select" name="tipo_imovel">
                                            <option value="">Selecionar</option>
                                            <option value="Casa">Casa</option>
                                            <option value="Apartamento">Apartamento</option>
                                            <option value="Sítio">Sítio</option>
                                            <option value="Chácara">Chácara</option>
                                        </select>
                                    </div>
                                    <div class="col ">
                                        <label class="form-label float-start">Descrição do Imóvel</label>
                                        <textarea rows="5" id="trumbowyg-demo" name="descricao"></textarea>

                                    </div>


                                    <div style="width: 100%;" class="mt-2 col bg-body d-flex justify-content-center align-items-center ">
                                        <input type="submit" class="btn btn-primary px-5 py-2" value="Salvar Imóveis" name="btnSalvarImovel" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-8 p-1">
                    <div class="border border-1">
                        <div class="row row-cols-1 row-cols-sm-3  p-1">
                            <?php
                            // $url_imoveis_one = "http://localhost/js-imoveis/back/img/img_one/";
                            foreach ($result as $retorno) :
                                extract($retorno);
                                $valor = number_format($valor_imovel, 0, ".", ".");

                            ?>
                                <div class="col p-3">
                                    <div class="p-2 bg-light d-flex flex-column justify-content-center align-items-start gap-1 shadow-sm">
                                        <img src="<?php echo URLIMGONE . $images ?>" alt="" style="max-width: 60px; ">
                                        <span style="font-size: small; font-family: sans-serif;"><b>Cód Imóvel: </b><?php echo $cod_imovel ?></span>
                                        <span style="font-size: small; font-family: sans-serif;"><b>Valor</b> R$ <?php echo $valor ?></span>
                                        <span style="font-size: small; font-family: sans-serif;" class=""><b>End:</b> <?php echo $endereco;  ?> - <?php echo $num_casa ?> </span>
                                        <span style="font-size: small; font-family: sans-serif;" class="">Estado: <?php echo $estado ?> </span>
                                        <span style="font-size: small; font-family: sans-serif;" class=""><b>Bairro:</b> <?php echo $bairro ?> </span>
                                        <div class=" d-flex  text-secondary">
                                            <span class="d-block d-flex align-items-center me-3">
                                                <span class="icon-bed me-2"></span>
                                                <span class="caption_adm"><?php echo $dormitorio; ?> Dormitório </span>
                                            </span>
                                            <span class="d-block d-flex align-items-center">
                                                <span class="me-2"><i class="fa-solid fa-shower"></i></span>
                                                <span class="caption_adm"><?php echo $banheiro ?> Banheiro</span>
                                            </span>
                                        </div>
                                        <div class=" d-flex mb-1 text-secondary">
                                            <span class="d-block d-flex align-items-center">
                                                <span class="me-2"><i class="fas fa-swimmer"></i></span>
                                                <span class="caption_adm me-2">Piscina - <?php echo $piscina ?></span>
                                            </span>
                                            <span class="d-block d-flex align-items-center">
                                                <span class="me-2"><i class="fas fa-utensils"></i></span>
                                                <span class="caption_adm">Churrasqueira - <?php echo $churrasqueira ?></span>
                                            </span>
                                        </div>
                                        <div class=" d-flex mb-1 text-secondary">
                                            <span class="d-block d-flex align-items-center">
                                                <span class="me-2"><i class="fa-solid fa-bath"></i></span>
                                                <span class="caption_adm me-2"><?php echo $suite ?> Suíte</span>
                                            </span>
                                            <span class="d-block d-flex align-items-center">
                                                <span class="me-2"><i class="fa-solid fa-car"></i></span>
                                                <span class="caption_adm"><?php echo $vagas ?> Vagas</span>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm " href="../pages/editar_imo.php?id=<?php echo $id; ?>">Editar</a>
                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary btn-sm" href="../pages/delete_banner.php?id=<?php echo $id; ?>">Deletar</a>
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
</section>

<?php 

require "../core/admin/footer-adm.php";
}else{
    header("Location: ../../../js-imoveis/admin.php");
    exit;
}


?>