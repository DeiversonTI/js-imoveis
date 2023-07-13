<?php

session_start();
ob_start();

require_once '../conn/conn.php';

$id_turma = $_GET['id'];

$del_query = "DELETE FROM img_banner WHERE id=:id";
$res_del = $conn->prepare($del_query);
$res_del->bindParam(":id",$id_turma, PDO::PARAM_INT);
$retorno = $res_del->execute();


if($retorno){
    $_SESSION['img_one'] = "<p style='color: green'>Deletado com sucesso!</p>";
    header("Location: ../admin/index.php ");
    exit;

}else{
    $_SESSION['img_one'] = "<p style='color: red'>NÃO DELETADO com sucesso!</p>";
    header("Location: ../admin/index.php ");
    exit;
}