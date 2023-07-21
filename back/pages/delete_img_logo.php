<?php

session_start();
ob_start();

require_once '../conn/conn.php';

$id_turma = $_GET['id'];

$del_query = "DELETE FROM logo WHERE id=:id";
$res_del = $conn->prepare($del_query);
$res_del->bindParam(":id",$id_turma, PDO::PARAM_INT);
$retorno = $res_del->execute();


if($retorno){
    // $_SESSION['img_logo'] = "<p style='color: green'>logo deletado com sucesso!</p>";
    $_SESSION['img_logo'] = "<div class='alert alert-danger' role='alert'>Logo deletado com sucesso!!</div>";
    header("Location: ../admin/index.php ");
    exit;

}else{
    $_SESSION['img_logo'] = "<div class='alert alert-danger' role='alert'>ERRO: logo Não deletado!!</div>";
    header("Location: ../admin/index.php ");
    exit;
}