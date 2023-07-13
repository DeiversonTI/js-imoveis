<?php

session_start();
ob_start();

require_once '../conn/conn.php';

$id_turma = $_GET['id'];

$del_query = "DELETE FROM imoveis WHERE id=:id";
$res_del = $conn->prepare($del_query);
$res_del->bindParam(":id",$id_turma, PDO::PARAM_INT);
$retorno = $res_del->execute();


if($retorno){
    $_SESSION['img_banner'] = "<p style='color: green'>Deletado com sucesso!</p>";
    header("Location: ../pages/product.php ");
    exit;

}else{
    $_SESSION['img_banner'] = "<p style='color: red'>NÃO DELETADO com sucesso!</p>";
    header("Location: ../pages/product.php ");
    exit;
}