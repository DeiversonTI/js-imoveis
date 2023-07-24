<?php

    $localhost = "localhost";
    $pass  =  "";
    $user = "root";
    $db = "js_imoveis";

    try {
        $conn = new PDO("mysql:host=$localhost;dbname=" . $db, $user, $pass);  
        // echo "conectado com sucesso";
    } catch ( PDOException $err) {
        echo $err->getMessage();
    }   
    
   
    

    