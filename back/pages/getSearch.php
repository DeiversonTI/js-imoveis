<?php

header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");

require_once "../conn/conn.php";

// $data = $_POST;
 
echo json_encode($_POST);
// var_dump($data);

// header("Access-Control-Allow-Origin: *");

//     $tipo = "%" . $search['tipo'] . "%";
//     $sit = "%" . $search['situacao'] . "%";
//     $nome = "%" . $search['nome'] . "%";

    
//     if ((!empty($search['nome'])) and (empty($search['situacao'])) and (empty($search['tipo']))) {

//         $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
//         FROM  imoveis As imo

//         INNER JOIN images_imoveis_one As img 
//         ON imo.id  = img.fk_id_imoveis

//         INNER JOIN enderecos As ende
//         ON ende.fk_id_imoveis=imo.id

//         INNER JOIN sit_imoveis As sit
//         ON sit.fk_id_imoveis=imo.id

//         WHERE ende.endereco LIKE :nome    
//         OR imo.cod_imovel LIKE :nome
//         OR ende.valor_imovel LIKE :nome
//         OR ende.bairro LIKE :nome
//         OR ende.estado LIKE :nome

//         ORDER BY imo.id DESC LIMIT 40";

//         $query_imo = $conn->prepare($query);
//         $query_imo->bindParam(":nome", $nome);
//         $query_imo->execute();
//         $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
      

//         $uid = $query_imo->rowCount();
//     } elseif ((empty($search['nome'])) and (!empty($search['situacao'])) and (empty($search['tipo']))) {

//         $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
//         FROM  imoveis As imo

//         INNER JOIN images_imoveis_one As img 
//         ON imo.id  = img.fk_id_imoveis

//         INNER JOIN enderecos As ende
//         ON ende.fk_id_imoveis=imo.id

//         INNER JOIN sit_imoveis As sit
//         ON sit.fk_id_imoveis=imo.id

//         WHERE sit.situacao LIKE :situacao    

//         ORDER BY imo.id DESC LIMIT 40";

//         $query_imo = $conn->prepare($query);
//         $query_imo->bindParam(":situacao", $sit);
//         $query_imo->execute();
//         $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
       

//         $uid = $query_imo->rowCount();

//     } elseif ((empty($search['nome'])) and (empty($search['situacao'])) and (!empty($search['tipo']))) {

//         $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
//         FROM  imoveis As imo

//         INNER JOIN images_imoveis_one As img 
//         ON imo.id  = img.fk_id_imoveis

//         INNER JOIN enderecos As ende
//         ON ende.fk_id_imoveis=imo.id

//         INNER JOIN sit_imoveis As sit
//         ON sit.fk_id_imoveis=imo.id

//         WHERE sit.tipo_imovel LIKE :tipo     

//         ORDER BY imo.id DESC LIMIT 40";

//         $query_imo = $conn->prepare($query);
//         $query_imo->bindParam(":tipo", $tipo);
//         $query_imo->execute();
//         $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);     

//         $uid = $query_imo->rowCount();

//     } elseif ((empty($search['nome'])) and (!empty($search['situacao'])) and (!empty($search['tipo']))) {

//         $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
//         FROM  imoveis As imo

//         INNER JOIN images_imoveis_one As img 
//         ON imo.id  = img.fk_id_imoveis

//         INNER JOIN enderecos As ende
//         ON ende.fk_id_imoveis=imo.id

//         INNER JOIN sit_imoveis As sit
//         ON sit.fk_id_imoveis=imo.id

//         WHERE sit.situacao LIKE :situacao 
//         AND sit.tipo_imovel LIKE :tipo   
            

//         ORDER BY imo.id DESC LIMIT 40";

//         $query_imo = $conn->prepare($query);
//         $query_imo->bindParam(":situacao", $sit);
//         $query_imo->bindParam(":tipo", $tipo);
//         $query_imo->execute();
//         $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);
//         // var_dump($retorno);

//         $uid = $query_imo->rowCount();

//     } else {

//         $query =  "SELECT imo.id, imo.cod_imovel, ende.valor_imovel, img.images, ende.endereco, ende.num_casa, ende.estado, ende.bairro, imo.dormitorio, imo.banheiro, imo.suite, imo.vagas, imo.piscina, imo.churrasqueira, imo.descricao, sit.situacao, sit.tipo_imovel 
//         FROM  imoveis As imo

//         INNER JOIN images_imoveis_one As img 
//         ON imo.id  = img.fk_id_imoveis

//         INNER JOIN enderecos As ende
//         ON ende.fk_id_imoveis=imo.id

//         INNER JOIN sit_imoveis As sit
//         ON sit.fk_id_imoveis=imo.id

//         WHERE sit.situacao LIKE :situacao 
//         AND sit.tipo_imovel LIKE :tipo   
//         AND ende.endereco LIKE :nome
    
//         ORDER BY imo.id DESC LIMIT 40";

//         $query_imo = $conn->prepare($query);
//         $query_imo->bindParam(":situacao", $sit);
//         $query_imo->bindParam(":tipo", $tipo);
//         $query_imo->bindParam(":nome", $nome);
//         $query_imo->execute();
//         $retorno = $query_imo->fetchAll(PDO::FETCH_ASSOC);  

//         $uid = $query_imo->rowCount();
//     }


// $query_img =  "SELECT * FROM enderecos ORDER BY valor_imovel DESC";
// $query_img_imo = $conn->prepare($query_img);
// $query_img_imo->execute();

// $result = $query_img_imo->fetchAll(PDO::FETCH_ASSOC);
// foreach($result as $r){

//     var_dump($r);
// }

// var_dump($uid);
// var_dump($retorno);



$dados = (["msg" => true, "info" => "Cadastro com Sucesso"]);
// echo $dados;

echo json_encode($dados);


