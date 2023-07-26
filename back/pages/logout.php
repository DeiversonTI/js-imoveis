<?php 
session_start();

session_destroy();
// header("Location: http://localhost/js-imoveis/js-imoveis/");
header("Location: ../.././js-imoveis/admin.php");

exit;