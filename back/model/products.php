<?php
session_start();
ob_start();

require_once "../conn/conn.php";

$dados_imovel = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_imovel);

if (!empty($dados_imovel['btnSalvarImovel'])) {

    // var_dump($dados_imovel);

    extract($dados_imovel);

    $res_imoveis = "INSERT INTO
imoveis ( cod_imovel, fk_nome_cli, dormitorio, banheiro, suite, vagas, piscina, churrasqueira, descricao,  created )
VALUES ( :cod_imovel,  :fk_nome_cli, :dormitorio, :banheiro, :suite, :vagas, :piscina, :churrasqueira, :descricao, NOW())";
    $result_db_imoveis = $conn->prepare($res_imoveis);   
    $result_db_imoveis->bindParam(':cod_imovel', $codigo);
    $result_db_imoveis->bindParam(':fk_nome_cli', $nome_cli);
    $result_db_imoveis->bindParam(':dormitorio', $dormitorio);
    $result_db_imoveis->bindParam(':banheiro', $banheiro);
    $result_db_imoveis->bindParam(':suite', $suite);
    $result_db_imoveis->bindParam(':vagas', $vagas);
    $result_db_imoveis->bindParam(':piscina', $piscina);
    $result_db_imoveis->bindParam(':churrasqueira', $churrasqueira);   
    $result_db_imoveis->bindParam(':descricao', $descricao);
    $res = $result_db_imoveis->execute();

    if ($result_db_imoveis->rowCount()) {


        $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Cadastrado com Sucesso!</div>";

        $id_imoveis = $conn->lastInsertId();

        $imovel = $_FILES['imagens'];
        $img_one = $_FILES['images'];
        $image_one = $img_one['name'];
        $image_one_tmp = $img_one['tmp_name'];

        for ($cnt = 0; $cnt < count($imovel['name']); $cnt++) {
            $name_imovel = $imovel['name'][$cnt];
            $tmp_img = $imovel['tmp_name'][$cnt];
            $files = "../img/imoveis/$id_imoveis/";
            $diretorio = $files . $name_imovel;
            if (file_exists($files)) {
                if (move_uploaded_file($tmp_img, $diretorio)) {
                    $images_imoveis = "INSERT INTO images_imoveis (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
                    $result_db_imagens = $conn->prepare($images_imoveis);
                    $result_db_imagens->bindParam(':images', $name_imovel);
                    $result_db_imagens->bindParam(':fk_id_imoveis', $id_imoveis);
                    $result_db_imagens->execute();
                }
            } else {
                mkdir($files, 0755);
                if (move_uploaded_file($tmp_img, $diretorio)) {

                    $images_imoveis = "INSERT INTO images_imoveis (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
                    $result_db_imagens = $conn->prepare($images_imoveis);
                    $result_db_imagens->bindParam(':images', $name_imovel);
                    $result_db_imagens->bindParam(':fk_id_imoveis', $id_imoveis);
                    $result_db_imagens->execute();
                }
            }
        }

        $file_one = "../img/img_one/$image_one";
        if (move_uploaded_file($image_one_tmp, $file_one)) {
            $images_imoveis_one = "INSERT INTO images_imoveis_one (images, fk_id_imoveis, created) VALUES (:images, :fk_id_imoveis, NOW())";
            $result_db_imagens_one = $conn->prepare($images_imoveis_one);
            $result_db_imagens_one->bindParam(':images', $image_one);
            $result_db_imagens_one->bindParam(':fk_id_imoveis', $id_imoveis);
            $result_db_imagens_one->execute();
           
        }

        $sit_imoveis = "INSERT INTO sit_imoveis (situacao, tipo_imovel, fk_id_imoveis, created) VALUES (:situacao, :tipo_imovel, :fk_id_imoveis, NOW())";
        $sit_imoveis_sits = $conn->prepare($sit_imoveis);
        $sit_imoveis_sits->bindParam(':situacao', $situacao);
        $sit_imoveis_sits->bindParam(':tipo_imovel', $tipo_imovel);
        $sit_imoveis_sits->bindParam(':fk_id_imoveis', $id_imoveis);       
        $sit_imoveis_sits->execute();

        $end_imoveis = "INSERT INTO enderecos ( valor_imovel, endereco, num_casa, bairro, estado, fk_id_imoveis, created) 
                                       VALUES ( :valor_imovel, :endereco, :num_casa, :bairro, :estado, :fk_id_imoveis, NOW())";
        $end_imoveis_sits = $conn->prepare($end_imoveis);
        $end_imoveis_sits->bindParam(':valor_imovel', $valor);
        $end_imoveis_sits->bindParam(':endereco', $endereco);
        $end_imoveis_sits->bindParam(':num_casa', $numero);
        $end_imoveis_sits->bindParam(':bairro', $bairro);
        $end_imoveis_sits->bindParam(':estado', $estado);
        $end_imoveis_sits->bindParam(':fk_id_imoveis', $id_imoveis);            
        $end_imoveis_sits->execute();
    }
     header("Location: ../pages/index.php ");
}
