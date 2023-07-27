<?php

session_start();

// header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");
// header('Content-Type: application/json;');

require_once "../conn/conn.php";


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
var_dump($id);

 // RECUPERAR A BANNER DO BANCO
 $sel_cont = "SELECT * FROM message_cliente WHERE id=$id LIMIT 1";
 $query_cont = $conn->prepare($sel_cont);
 $query_cont->execute();

 var_dump($sel_cont);

 $res_cont = $query_cont->fetch(PDO::FETCH_ASSOC);
// $resposta = [];
// while($tt  = $query_cont->fetch(PDO::FETCH_ASSOC)){
//     $resposta[] = $tt;
//     var_dump($tt);
// }

//  var_dump($res_cont);

 $resposta = ["msg"=>true, "dados"=> $res_cont];

 echo json_encode($resposta);


 


//  extract($res_cont);
// $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// if (!empty($dados['btnContatos'])) {
//     $res = "UPDATE contato_empresa SET nome=:nome, creci=:creci, email=:email, semana=:semana, horario=:horario, endereco=:endereco, numero=:numero, bairro=:bairro, tel_one=:tel_one, tel_two=:tel_two, facebook=:facebook, instagram=:instagram, modified=NOW() WHERE id=:id";
//     $result_db_cont = $conn->prepare($res);    
//     $result_db_cont->bindParam(':id', $res_cont['id']);
//     $result_db_cont->bindParam(':nome', $dados['nome']);
//     $result_db_cont->bindParam(':creci', $dados['creci']);
//     $result_db_cont->bindParam(':email', $dados['email']);
//     $result_db_cont->bindParam(':semana', $dados['semana']);
//     $result_db_cont->bindParam(':horario', $dados['horario']);
//     $result_db_cont->bindParam(':endereco', $dados['endereco']);
//     $result_db_cont->bindParam(':numero', $dados['numero']);
//     $result_db_cont->bindParam(':bairro', $dados['bairro']);
//     $result_db_cont->bindParam(':tel_one', $dados['tel_one']);
//     $result_db_cont->bindParam(':tel_two', $dados['tel_two']);
//     $result_db_cont->bindParam(':facebook', $dados['facebook']);
//     $result_db_cont->bindParam(':instagram', $dados['instagram']);
//     $result_db_cont->execute();
//     if ($result_db_cont->rowCount()) {

//         $_SESSION['update_contato'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Selecionado com Sucesso!</div>";
//         header("Location: ../pages/contact.php ");
//     }
// }

?>
