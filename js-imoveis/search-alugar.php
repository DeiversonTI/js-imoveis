<?php
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: *");


require_once "../back/conn/conn.php";


$dadosUser = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// echo json_encode($dadosUser);

if (!empty($dadosUser['email'])) {

    // var_dump($dadosUser);

    $res_title = "INSERT INTO imovel_interesse (nome, telefone, id_imovel, email, created) VALUES (:nome, :telefone, :id_imovel, :email, NOW())";
    $result_db_title = $conn->prepare($res_title);
    $result_db_title->bindParam(':nome', $dadosUser['nome']);
    $result_db_title->bindParam(':telefone', $dadosUser['telefone']);
    $result_db_title->bindParam(':id_imovel', $dadosUser['id_imovel']);
    $result_db_title->bindParam(':email', $dadosUser['email']);
    $result_db_title->execute();

    if ($result_db_title->rowCount()) {
        // $_SESSION['cad_imo_new'] = "<div class='alert alert-success' role='alert'>Recebemos seu pedido! Entraremos em contato em breve!!</div>";
        $arr = array('msg' => true);
        // header("Location: slideshow-imoveis?id=$id");
    }
}else{
    $arr = array('msg' => false);
}

echo json_encode($arr);





?>

