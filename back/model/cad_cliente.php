<?php
session_start();
ob_start();

require_once "../conn/conn.php";

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados_cadastro['btnCadastrar'])) {

    var_dump($dados_cadastro);

    extract($dados_cadastro);

    $res_cli = "INSERT INTO cad_cliente ( nome, email, celular, fixo, created )
                                VALUES ( :nome, :email, :celular, :fixo, NOW())";
    $result_db_cli = $conn->prepare($res_cli);   
    $result_db_cli->bindParam(':nome', $nome);
    $result_db_cli->bindParam(':email', $email);
    $result_db_cli->bindParam(':celular', $celular);
    $result_db_cli->bindParam(':fixo', $fixo);   
    $res = $result_db_cli->execute();

    if ($result_db_cli->rowCount()) {
        $_SESSION['cad_dono_imo'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Cadastrado com Sucesso!</div>";
        header("Location: ../pages/cadastro-proprietario.php ");
    }
}