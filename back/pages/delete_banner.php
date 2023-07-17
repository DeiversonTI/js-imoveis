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
    $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#F8D7DA; color: #B8521C; padding: 1rem; border: 1px solid #F1AEB5; border-radius:8px;'>Deletado com sucesso!!</div>";
    header("Location: ../pages/product.php ");
    exit;

}else{
    $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#F8D7DA; color: #B8521C; padding: 1rem; border: 1px solid #F1AEB5; border-radius:8px;'>NÃO DELETADO com sucesso!!</div>";
    // $_SESSION['msg'] = "<p style='color: red'>NÃO DELETADO com sucesso!</p>";
    header("Location: ../pages/product.php ");
    exit;
}