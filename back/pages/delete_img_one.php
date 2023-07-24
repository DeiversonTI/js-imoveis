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
    $_SESSION['img_one'] = "<div class='alert alert-danger' role='alert'>Banner deletado com sucesso!!</div>";
    header("Location: ../pages/index.php ");
    exit;

}else{
    $_SESSION['img_one'] = "<div class='alert alert-danger' role='alert'>ERRO: Banner não deletado!!</div>";
    header("Location: ../pages/index.php ");
    exit;
}