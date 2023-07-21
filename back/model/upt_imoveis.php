<?php
session_start();
ob_start();

require_once "../conn/conn.php";

$dados_imovel = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$id = $dados_imovel['id'];
var_dump($dados_imovel);

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
    

    extract($dados_imovel);   

    $res_end = " UPDATE enderecos SET valor_imovel=:valor, endereco=:endereco, num_casa=:numero, estado=:estado, bairro=:bairro, modified=NOW() WHERE fk_id_imoveis=$id";
    $result_db_end = $conn->prepare($res_end);
    $result_db_end->bindParam(':valor', $valor);
    $result_db_end->bindParam(':endereco', $endereco);
    $result_db_end->bindParam(':numero', $numero);
    $result_db_end->bindParam(':estado', $estado);
    $result_db_end->bindParam(':bairro', $bairro);
    $res_ende = $result_db_end->execute();
    

    $res_imoveis = "UPDATE imoveis SET cod_imovel=:cod_imovel, dormitorio=:dormitorio, banheiro=:banheiro, suite=:suite, vagas=:vagas, piscina=:piscina, churrasqueira=:churrasqueira, descricao=:descricao, modified=NOW()
                     WHERE id=$id";
    $result_db_imoveis = $conn->prepare($res_imoveis);    
    $result_db_imoveis->bindParam(':cod_imovel', $codigo);
    $result_db_imoveis->bindParam(':dormitorio', $dormitorio);
    $result_db_imoveis->bindParam(':banheiro', $banheiro);
    $result_db_imoveis->bindParam(':suite', $suite);
    $result_db_imoveis->bindParam(':vagas', $vagas);
    $result_db_imoveis->bindParam(':piscina', $piscina);
    $result_db_imoveis->bindParam(':churrasqueira', $churrasqueira);
    $result_db_imoveis->bindParam(':descricao', $descricao);   
    $result_db_imoveis->execute();
   

    $res_sit = " UPDATE sit_imoveis SET situacao=:situacao, tipo_imovel=:tipo_imovel, modified=NOW() WHERE fk_id_imoveis=$id";
    $result_db_sit = $conn->prepare($res_sit);   
    $result_db_sit->bindParam(':situacao', $dados_imovel['situacao']);
    $result_db_sit->bindParam(':tipo_imovel', $dados_imovel['tipo_imovel']);
    $retorno = $result_db_sit->execute();

    if ($res_end) {
        $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Atualizado com Sucesso!</div>";
        header("Location: ../pages/product.php ");       
    }
}

header("Location: ../pages/product.php ");
