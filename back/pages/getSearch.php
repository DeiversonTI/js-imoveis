<?php

session_start();

header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");

require_once "../conn/conn.php";

$dados = json_decode(file_get_contents("php://input"));

if($dados === "Maior_Valor"){ 
        
    if (!empty($dados)) {

    $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
    FROM  imoveis As imo

    INNER JOIN images_imoveis_one As img 
    ON imo.id  = img.fk_id_imoveis

    INNER JOIN enderecos As ende
    ON ende.fk_id_imoveis=imo.id

    INNER JOIN sit_imoveis As sit
    ON sit.fk_id_imoveis=imo.id

    ORDER BY ende.valor_imovel DESC LIMIT 40";

    $query_imo = $conn->prepare($query);       
    $query_imo->execute();
    $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);

    $uid = $query_imo->rowCount();    

    $envDados = $_SESSION['dados'] = $retorno;

    
    $arr = (["msg" => true, "info" => "Cadastro com Sucesso", "data" => $retorno]);
    echo json_encode($arr);   
    exit;
    
}

}else if($dados === "Menor_Valor"){
    echo "Menor" . $dados. "<br>";
}else{
    echo "Total" . $dados . "<br>";
}

