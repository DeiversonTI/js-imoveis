<?php
session_start();
ob_start();

require_once "../conn/conn.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_GET, "nome");

// $nome = "Atendido";

// var_dump($id);
// var_dump($nome);

// extract($dados_cadastro);
$del_query = "DELETE FROM estado_msn WHERE fk_id_msn=:id";
$res_del = $conn->prepare($del_query);
$res_del->bindParam(":id", $id, PDO::PARAM_INT);
$retorno = $res_del->execute();

if($retorno){

    $res_cli = "INSERT INTO estado_msn (estado, fk_id_msn, created) VALUES (:estado, :fk_id_msn, NOW())";
    $result_db_cli = $conn->prepare($res_cli);
    $result_db_cli->bindParam(':estado', $nome);
    $result_db_cli->bindParam(':fk_id_msn', $id, PDO::PARAM_INT);
    $result_db_cli->execute();

    if ($result_db_cli->rowCount()) {
        $_SESSION['msg_msn'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Cliente Atendido com Sucesso!</div>";
        header("Location: ../pages/index.php");
    }

}



