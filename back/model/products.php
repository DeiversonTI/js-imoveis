<?php
session_start();
ob_start();

require_once "../conn/conn.php";

// $query = "SELECT imo.id, imo.valor, img.images, imo.endereco, imo.numero, imo.estado, imo.bairro, imo.dormitorio, imo.banheiro, imo.piscina, imo.churrasqueira, imo.descricao
// FROM imoveis As imo
// INNER JOIN images_imoveis_one As img
// ON imo.id = img.fk_id_imoveis
// ORDER BY id DESC LIMIT 40";
// $query_imo = $conn->prepare($query);
// $query_imo->execute();
// $result = $query_imo->fetchAll(PDO::FETCH_ASSOC);

$dados_imovel = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados_imovel['btnSalvarImovel'])) {

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
    }
     header("Location: ../pages/product.php ");
}
