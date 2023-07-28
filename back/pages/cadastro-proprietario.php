<?php
session_start();
ob_start();

if (isset($_SESSION['id']) and (isset($_SESSION['nome'])) and ($_SESSION['nivel'] == 1)) {
    require "../core/admin/header-adm.php";

    // RECUPERAR A BANNER DO BANCO
    $sel_cli = "SELECT * FROM cad_cliente";
    $query_cli = $conn->prepare($sel_cli);
    $query_cli->execute();
    // conta quantas imagens tem no banco
    $count_cli = $query_cli->rowCount();

    $res_cli = $query_cli->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);


    require "../core/admin/navbar-adm.php";
?>

    <div class="container">
        <div class="text-center">
            <div class="row">
                <div class="col col-md-8 mx-auto  p-3">
                    <!-- <h1 class="py-1 text-light-emphasis display-6 ">Painel Administrativo</h1> -->
                    <div id="darkModeColor" class="dark_color border border-1 px-3 rounded ">
                        <!-- UPLOAD DO BANNER -->
                        <h5 class="text-start mr-2 px-4 py-2">Cadastrar Donos dos Imóveis</h5>
                        <?php
                        if (isset($_SESSION['cad_dono_imo'])) {
                            echo $_SESSION['cad_dono_imo'];
                            unset($_SESSION['cad_dono_imo']);
                        }
                        ?>

                        <form action="../model/cad_cliente.php" method="post" class="p-2">
                            <div class="row row-cols-2 mx-2">
                                <div class="col">                               
                                    <div class="mb-3">
                                        <label class="float-start form-label">Nome Cliente</label>
                                        <input type="text" class="form-control" name="nome" placeholder="Nome do Cliente">
                                    </div>                                   
                                    <div class="mb-3">
                                        <label class="float-start form-label">Telefone 1</label>
                                        <input type="text" class="form-control" name="celular" placeholder="Telefone de Contato">
                                    </div>
                                </div>                            
                                <div class="col">                                    
                                    <div class="mb-3">
                                        <label class="float-start form-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Email do Cliente">
                                    </div>                                   
                                    <div class="mb-3">
                                        <label class="float-start form-label">Telefone 2</label>
                                        <input type="text" class="form-control" name="fixo" placeholder="Telefone de Contato">
                                    </div>
                                </div>                            
                                <div class="col-12">                                    
                                    <div class="my-3">
                                        <input type="submit" class="btn btn-success px-5 btn-lg " value="Cadastrar" name="btnCadastrar" />
                                    </div>
                                </div>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- INICIO BANNER -->
            <div class="col col-md-8 mx-auto">
                <div class="border border-1 mt-1 px-3 py-2 rounded ">
                    <!-- <h5 class="text-start mr-2 px-3 pt-2 ">Banner do Site</h5> -->
                    <?php
                    if (isset($_SESSION['del_cli'])) {
                        echo $_SESSION['del_cli'];
                        unset($_SESSION['del_cli']);
                    }
                    ?>
                    <div class="mt-3 mb-4">
                        <div>
                            <div class="row row-cols-1 px-2">
                                <div class="mx-3 p-1">
                                    <span style="font-family: sans-serif;" class="float-start text-secondary"><strong><?php echo $count_cli; ?></strong> - Contatos do Site</span>
                                </div>
                                <div class="row row-cols-1 row-cols-sm-1  p-1 table-responsive">
                                <div class=" col px-4 py-1">
                                    <table  id="darkModeColor" class="dark_color light_mode w-100 ">
                                        <tr>                                        
                                            <th scope="col">Qnt</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Celular</th>
                                            <th scope="col">Telefone</th>                                       
                                            <th scope="col">Action</th>
                                        </tr>
                                        <?php
                                             foreach ($res_cli as $value=>$result_cli) :
                                                extract($result_cli);                                             
                                            ?>
                                          
                                                <tr>
                                                    <td><?php echo $value+1 ?></td>
                                                    <td><?php echo $nome ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $celular  ?></td>
                                                    <td><?php echo $fixo ?></td>                                                  
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center gap-2">                                                           
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-success btn-sm" href="../pages/imoveis-cliente-cad.php?id=<?php echo $id; ?>">Imóveis</a> 
                                                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-danger btn-sm" href="../pages/delete_cliente.php?id=<?php echo $id; ?>"><i class="fa-regular fa-trash-can" style="color: #ffffff;"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            <?php
                                            endforeach;
                                            ?>
                                    </table>
                                </div>
                            </div>
                                <!-- <?php
                                foreach ($res_cli as $result_cli) :
                                    extract($result_cli);
                                ?>

                                <div class="col py-1">
                                    <div id="darkModeColor" class=" dark_color p-2 rounded d-flex flex-column border border-light-subtle justify-content-between align-items-center gap-3 shadow-sm ">
                                        <div class="row d-flex w-100 p-2 ">
                                            <div class="col d-flex flex-column  align-items-start fw-light">
                                                <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Código Imóvel:</b> <?php echo $cod_imovel ?></div>
                                                <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Nome Cliente:</b> <?php echo $nome ?></div>
                                                <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">E-mail:</b> <?php echo $email ?></div>
                                                <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Celular:</b> <?php echo $celular ?></div>
                                                <div><b style="font-family: Poppins, sans-serif;" class="fw-bold">Telefone:</b> <?php echo $fixo ?></div>                                                   
                                            </div>
                                            
                                            <div class="col  d-flex justify-content-center align-items-center">
                                                <a title="Editar Informações do contato" class="btn btn-success me-1 btn-lg" href="../pages/update_contato_site.php?id=<?php echo $id; ?>">
                                                    <i style="color:#fff;" class="fa-solid fa-pencil"></i>
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
                                ?> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIM BANNER -->

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