<?php


require ".././conn/conn.php";
// require_once "../../conn/conn.php";
require "../../back/Links.php";

$query_five =  "SELECT * FROM title LIMIT 1";
$query_banner_five = $conn->prepare($query_five);
$query_banner_five->execute();
$res_five = $query_banner_five->fetch(PDO::FETCH_ASSOC);
// var_dump($res_five);

// O LOGO ESTÁ VINDO DO BANCO E ADICIONADO NO HEADER, AGORA SÓ CHAMAR A VARIAVEL $URL QUE A IMAGEM APARECE ONDE QUISER
$query_logo =  "SELECT * FROM logo ORDER BY id DESC LIMIT 1";
$query_banner_logo = $conn->prepare($query_logo);
$query_banner_logo->execute();
$res = $query_banner_logo->fetch(PDO::FETCH_ASSOC);

$url = URLDEFAULT . "anonimo.png";

if ($res) {
  $url = URLLOGO . $res['img_logo'];
} else {
  $url = URLDEFAULT . "logo_default2.png";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Untree.co" />
  <link rel="shortcut icon" href="<?php echo URLFAVICON . $res_five['img_fivecon']; ?>" />

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap5" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../.././js-imoveis/fonts/icomoon/style.css" />
  <link rel="stylesheet" href="../.././back/dist/ui/trumbowyg.min.css">
  <link rel="stylesheet" href="../.././back/dist/plugins/colors/ui/trumbowyg.colors.min.css">
  <!-- <link rel="stylesheet" href="../.././js-imoveis/fonts/flaticon/font/flaticon.css" /> -->
  <link rel="stylesheet" href="../.././js-imoveis/css/adm-style.css" />
  <title>
    Property &mdash; Free Bootstrap 5 Website Template by Untree.co
  </title>
</head>

<!-- PALETA DE CORES DARK #071135, #0b1a43 , #071135, #252e37, #040928, #00001a-->
<!-- PALETA DE CORES LIGHT #eeffff, #4473bd, #a2d9ff, #c3ecff -->
<body id="darkColorBody" class="dark_color_body" style="overflow-y: scroll;">
 