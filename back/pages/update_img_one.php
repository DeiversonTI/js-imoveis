<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

var_dump($id);

// UPLOAD IMAGEM BANNER
// if(array_key_exists('files', $_FILES)){

//     $banner = $_FILES['files'];
//     $img = $banner['name']; 
//     $tmp = $banner['tmp_name']; 

//     $dest = "../img/banner/$img/";

//     if(move_uploaded_file($tmp,$dest)){
//         $res = "INSERT INTO img_banner (imag_banner, created) VALUES (:imag_banner, NOW())";
//         $result_db = $conn->prepare($res);
//         $result_db->bindParam(':imag_banner', $img);
//         $retorno = $result_db->execute();

//         if($retorno){
//             $_SESSION['msg'] = "<p style='color: green;'>Cadastrado com sucesso!</p>";
//         }
//     }
// }

echo $id;