<?php 

session_start();

require_once "../conn/conn.php";

// UPLOAD IMAGEM BANNER
if(array_key_exists('files', $_FILES)){

    $banner = $_FILES['files'];
    $img = $banner['name']; 
    $tmp = $banner['tmp_name']; 

    $dest = "../img/banner/$img/";

    if(move_uploaded_file($tmp,$dest)){
        $res = "INSERT INTO img_banner (imag_banner, created) VALUES (:imag_banner, NOW())";
        $result_db = $conn->prepare($res);
        $result_db->bindParam(':imag_banner', $img);
        $retorno = $result_db->execute();

        if($retorno){
            $_SESSION['msg'] = "<p style='color: green;'>Cadastrado com sucesso!</p>";
        }
    }
}
// FIM UPLOAD IMAGEM BANNER

$dados_imovel = filter_input_array(INPUT_POST, FILTER_DEFAULT);  
    
if(!empty($dados_imovel['btnSalvarImovel'])){

    extract($dados_imovel);

    $res_imoveis = "INSERT INTO 
    imoveis (valor, endereco, numero, estado, bairro, dormitorio, banheiro, piscina, churrasqueira, descricao, created ) 
    VALUES (:valor, :endereco, :numero, :estado, :bairro, :dormitorio, :banheiro, :piscina, :churrasqueira, :descricao, NOW())";
    $result_db_imoveis = $conn->prepare($res_imoveis);
    $result_db_imoveis->bindParam(':valor', $valor);
    $result_db_imoveis->bindParam(':endereco', $endereco);
    $result_db_imoveis->bindParam(':numero', $numero);
    $result_db_imoveis->bindParam(':estado', $estado);
    $result_db_imoveis->bindParam(':bairro', $bairro);
    $result_db_imoveis->bindParam(':dormitorio', $dormitorio);
    $result_db_imoveis->bindParam(':banheiro', $banheiro);
    $result_db_imoveis->bindParam(':piscina', $piscina);
    $result_db_imoveis->bindParam(':churrasqueira', $churrasqueira);
    $result_db_imoveis->bindParam(':descricao', $descricao);
    $res = $result_db_imoveis->execute();

    if($result_db_imoveis->rowCount()){

        $_SESSION['imo'] = "<p style='color: green;'>Imóvel Cadastrado com SUCESSO!</p>";

        $id_imoveis = $conn->lastInsertId();

        $imovel = $_FILES['imagens']; 
        $img_one = $_FILES['images'];
        $image_one = $img_one['name'];
        $image_one_tmp = $img_one['tmp_name'];
        
        for($cnt=0; $cnt < count($imovel['name']); $cnt++){
    
            $name_imovel = $imovel['name'][$cnt];      
    
            $tmp_img = $imovel['tmp_name'][$cnt];
    
            $files = "../img/imoveis/$id_imoveis/";  
            
            $diretorio = $files . $name_imovel;

            if(file_exists($files)){
                if(move_uploaded_file($tmp_img, $diretorio)){ 
                    
                $images_imoveis = "INSERT INTO images_imoveis (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
                $result_db_imagens = $conn->prepare($images_imoveis);
                $result_db_imagens->bindParam(':images', $name_imovel);
                $result_db_imagens->bindParam(':fk_id_imoveis', $id_imoveis);       
                $result_db_imagens->execute();                   
                }

            }else{
                mkdir($files, 0755);
                if(move_uploaded_file($tmp_img, $diretorio)){ 

                    $images_imoveis = "INSERT INTO images_imoveis (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
                    $result_db_imagens = $conn->prepare($images_imoveis);
                    $result_db_imagens->bindParam(':images', $name_imovel);
                    $result_db_imagens->bindParam(':fk_id_imoveis', $id_imoveis);       
                    $result_db_imagens->execute();

                }
            }
        }

        $file_one = "../img/img_one/$image_one";         
        if(move_uploaded_file($image_one_tmp, $file_one)){
            $images_imoveis_one = "INSERT INTO images_imoveis_one (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
            $result_db_imagens_one = $conn->prepare($images_imoveis_one);
            $result_db_imagens_one->bindParam(':images', $image_one);
            $result_db_imagens_one->bindParam(':fk_id_imoveis', $id_imoveis);       
            $result_db_imagens_one->execute();  
        }
           
    }

}   
require "../core/include/admin/header-adm.php" ;
require "../core/include/admin/navbar-adm.php";
?>

<section class="container">
    <div>
        <h1 class="py-2 text-light-emphasis display-1 ">Painel Administrativo</h1>
        <div class="text-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols ">
                <div class="col-5 border border-1 p-5 ">
                    <h1>Upload Imagem Banner</h1>
                    <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                    <form action="" method="post" class="p-2 " enctype="multipart/form-data">
                        <div> 
                            <input type="file" name="files" class="form-control" ><br>
                            <input type="submit" class="btn btn-primary px-5 mt-3" value="Salvar" name="btnSalvarBanner"/>
                        </div>
                    </form>
                </div>
                <div class="col-5 border border-1 p-5">
                    <h1>Cadastrar Imóveis</h1>
                    <?php
                    if(isset($_SESSION['imo'])){
                        echo $_SESSION['imo'];
                        unset($_SESSION['imo']);
                    }
                    ?>
                    <form action="" method="post" class="p-2" enctype="multipart/form-data" >                       
                        <div class="row row-cols-1 row-cols-sm-2 row-cols g-2">   
                            <div class="col ">
                                <label class="form-label float-start">Imagem Home</label>
                                <input type="file" name="images" class="form-control" />
                                <label class="form-label float-start">Valor</label>
                                <input type="text" class="form-control" name="valor" placeholder="Valor do Imóvel" />
                                <label class="form-label float-start">Endereço</label>
                                <input type="text" class="form-control" name="endereco" placeholder="Endereço do Imóvel" />
                                <label class="form-label float-start">Número</label>
                                <input type="text" class="form-control" name="numero" placeholder="Número do Imóvel" />
                                <label class="form-label float-start">Bairro</label>
                                <input type="text" class="form-control" name="bairro"  placeholder="Bairro do Imóvel" />
                                <label class="form-label float-start">Estado</label>
                                <input type="text" class="form-control" name="estado" placeholder="Estado do Imóvel" /> 
                                                          
                            </div>
                                                        
                            <div class="col">
                                 <label class="form-label float-start">Dormitório</label>
                                 <select class="form-select" name="dormitorio" id="">
                                    <option value="">Selecionar</option>
                                    <option value="1">1 Quarto</option>
                                    <option value="2">2 Quarto</option>
                                    <option value="3">3 Quarto</option>
                                 </select>
                                 <label class="form-label float-start">Banheiro</label>
                                 <select class="form-select" name="banheiro" >
                                    <option value="">Selecionar</option>
                                    <option value="1">1 Banheiro</option>
                                    <option value="2">2 Banheiro</option>
                                    <option value="3">3 Banheiro</option>
                                 </select>
                              
                               
                                <label class="form-label float-start">Piscina</label>
                                <select class="form-select" name="piscina" >
                                    <option value="">Selecionar</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>                                    
                                 </select>
                            <label class="form-label float-start">Churrasqueira</label>
                                <select class="form-select" name="churrasqueira" >
                                    <option value="">Selecionar</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>                                    
                                 </select>  
                                
                            <label class="form-label float-start">Imagem</label>
                                <!-- <input type="file" name="imagens" class="form-control" /> -->
                                <input type="file" name="imagens[]" multiple class="form-control" />
                 
                               
                            </div>  
                          
                            <div class="row  ">  
                                <div class="col ">
                                    <label class="form-label float-start">Descrição do Imóvel</label>
                                    <textarea style="height: 100px" cols="70" name="descricao"  ></textarea>
                                    
                                </div>   
                                <div style="width: 100%;" class="mt-2 col bg-body d-flex justify-content-center align-items-center ">                                    
                                    <input type="submit" class="btn btn-primary px-5 py-2" value="Salvar Imóveis" name="btnSalvarImovel"/>
                                </div>                                 
                            </div>                
                          
                            
                           
                        </div> 
                                  
                    </form>
                    <!-- <form action="" method="post" enctype="multipart/form-data">
                                      <label class="form-label float-start">Imagem</label>
                                        <input type="file" name="imagens[]" multiple="multiple" class="form-control" />
                                        <input type="submit" class="btn btn-primary px-5 py-2" value="Salvar Imóveis" name="btnSal"/>
                                </form> -->
                </div>
                
            </div>
        </div>
    </div>
</section>



<?php require "../core/include/admin/footer-adm.php" ?>