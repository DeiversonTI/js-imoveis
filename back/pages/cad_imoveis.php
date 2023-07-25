<?php

session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and (isset($_SESSION['nivel']) == 1)) {

    require "../core/admin/header-adm.php";
    require "../core/admin/navbar-adm.php";
?>

    <section class="mx-3 ">
        <div class="container">
            <!-- <h1 class="py-1 text-light-emphasis  display-6 ">Painel Administrativo</h1> -->
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div  class=" text-center mt-3">
                <div class="row mx-auto">
                    <div class="col col-xl-8 mx-auto p-1">
                        <div id="darkModeColor" class="dark_color border border-1 rounded">
                            <h1>Cadastrar Imóveis</h1>
                            <form action="../model/products.php" method="post" class="p-2" enctype="multipart/form-data">
                                <div class="row row-cols-1 row-cols-xl-2 g-2 px-3">
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
                                        <label class="form-label float-start">Situação</label>
                                        <select class="form-select" name="situacao">
                                            <option value="">Selecionar</option>
                                            <option value="comprar">Comprar</option>
                                            <option value="Vender">Vender</option>
                                        </select>

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

                                        <label class="form-label float-start">Tipo do Imóvel</label>
                                        <select class="form-select" name="tipo_imovel">
                                            <option value="">Selecionar</option>
                                            <option value="Casa">Casa</option>
                                            <option value="Apartamento">Apartamento</option>
                                            <option value="Sítio">Sítio</option>
                                            <option value="Chácara">Chácara</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 px-3">
                                    <div class="">
                                        <label class="form-label float-start">Descrição do Imóvel</label>
                                        <textarea rows="5" id="trumbowyg-demo" name="descricao"></textarea>
                                    </div>
                                    <div style="width: 100%;" class="mt-2 col  d-flex justify-content-center align-items-center ">
                                        <input type="submit" class="btn btn-primary px-5 py-2" value="Salvar Imóveis" name="btnSalvarImovel" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

    require "../core/admin/footer-adm.php";
} else {
    header("Location: ../../../js-imoveis/admin.php");
    exit;
}


?>