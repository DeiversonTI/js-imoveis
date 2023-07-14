<?php

session_start();

require_once "../conn/conn.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// SELECIONA A IMAGEM CADASTRADA
$query_mani =  "SELECT * FROM mani_banner";
 $query_banner_mani = $conn->prepare($query_mani);        
 $query_banner_mani->execute();        
 $res_mani = $query_banner_mani->fetch(PDO::FETCH_ASSOC);

// DELETA A IMAGEM DO BANCO
$del_query = "DELETE FROM mani_banner WHERE fk_id_img_banner=:id";
$res_del = $conn->prepare($del_query);
$res_del->bindParam(":id",$res_mani['fk_id_img_banner'], PDO::PARAM_INT);
$retorno = $res_del->execute();

// PEGA A NOVA IMAGEM
 $query_banner =  "SELECT * FROM img_banner WHERE id=:id ORDER BY id DESC LIMIT 1";
 $query_banner_imo = $conn->prepare($query_banner);
 $query_banner_imo->bindParam(":id", $id);        
 $query_banner_imo->execute();        
 $result = $query_banner_imo->fetch(PDO::FETCH_ASSOC);

//CRIA A NOVA IMAGEM
 $res_id = "INSERT INTO mani_banner (images, fk_id_img_banner) VALUES (:images, :fk_id_img_banner)";
 $result_db_id = $conn->prepare($res_id);
 $result_db_id->bindParam(':images', $result['imag_banner']);
 $result_db_id->bindParam(':fk_id_img_banner', $result['id']);
 $rest = $result_db_id->execute();

//  var_dump($rest);
 
 if($result_db_id->rowCount()){

    $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Selecionado com Sucesso!</div>";
    header("Location: ../admin/index.php ");
 
} 