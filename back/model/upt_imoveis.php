<?php
session_start();
ob_start();

require_once "../conn/conn.php";

$dados_imovel = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$fk_id_imoveis = $dados_imovel['id'];

if (!empty($dados_imovel['btnSalvarImovel'])) {

    $img = $_FILES['images'];
    $image = $img['name'];
    // var_dump($img);

    $files = "../img/img_one/$image/";
    if (move_uploaded_file($img['tmp_name'], $files)) {
        $query_mani = "UPDATE images_imoveis_one SET images=:images, modified=NOW() WHERE fk_id_imoveis=$fk_id_imoveis";
        $mani = $conn->prepare($query_mani);
        $mani->bindParam(':images', $image);
        $mani->execute();
    } 
    
    // var_dump($dados_imovel);

    extract($dados_imovel);

    $res_imoveis = " UPDATE imoveis
                     SET valor=:valor, endereco=:endereco, numero=:numero, estado=:estado, bairro=:bairro, dormitorio=:dormitorio, banheiro=:banheiro,suite=:suite, vagas=:vagas, piscina=:piscina, churrasqueira=:churrasqueira, descricao=:descricao, situacao=:situacao, tipo_imovel=:tipo_imovel, modified=NOW()
                     WHERE id=$id";
    $result_db_imoveis = $conn->prepare($res_imoveis);
    $result_db_imoveis->bindParam(':valor', $valor);
    $result_db_imoveis->bindParam(':endereco', $endereco);
    $result_db_imoveis->bindParam(':numero', $numero);
    $result_db_imoveis->bindParam(':estado', $estado);
    $result_db_imoveis->bindParam(':bairro', $bairro);
    $result_db_imoveis->bindParam(':dormitorio', $dormitorio);
    $result_db_imoveis->bindParam(':banheiro', $banheiro);
    $result_db_imoveis->bindParam(':suite', $suite);
    $result_db_imoveis->bindParam(':vagas', $vagas);
    $result_db_imoveis->bindParam(':piscina', $piscina);
    $result_db_imoveis->bindParam(':churrasqueira', $churrasqueira);
    $result_db_imoveis->bindParam(':descricao', $descricao);
    $result_db_imoveis->bindParam(':situacao', $situacao);
    $result_db_imoveis->bindParam(':tipo_imovel', $tipo_imovel);
    $res = $result_db_imoveis->execute();

    if ($res) {

        $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Atualizado com Sucesso!</div>";
        header("Location: ../pages/product.php ");

       
    }
}
