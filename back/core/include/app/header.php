<?php
require_once ".././back/conn/conn.php";
require ".././back/Links.php";


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

  <!-- O FAVICON VAI VIR DO BANCO DE DADOS -->
  <link  rel="shortcut icon" href="<?php echo $url; ?>" />

  <!-- O DESCRIPTION VAI VIR DO BANCO DE DADOS -->
  <meta name="description" content="" />

  <!-- O KEYWORDS VAI VIR DO BANCO DE DADOS -->
  <meta name="keywords" content="bootstrap, bootstrap5" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap&family=Montserrat:wght@200;300;400;500;800&family=Open+Sans:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,400;0,600;1,300;1,500&family=Roboto:ital,wght@0,100;0,400;0,500;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css" />
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
  <!-- <link rel="stylesheet" href="../back/dist/ui/trumbowyg.min.css"> -->

  <link rel="stylesheet" href="css/tiny-slider.css" />
  <link rel="stylesheet" href="css/aos.css" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- <link rel="stylesheet" href="../../../css/style.css"> -->

  <!-- O TITLE VAI VIR DO BANCO DE DADOS -->
  <title>
    JS Imóveis - Assessoria Imobiliária
  </title>
</head>

<body>