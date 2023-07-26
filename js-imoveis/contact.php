<?php 
require "../back/core/app/header.php";
$res = "SELECT * FROM contato_empresa LIMIT 1";
$result_db = $conn->prepare($res);
$result_db->execute();
$result = $result_db->fetch(PDO::FETCH_ASSOC);
extract($result);

$message_cliente = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($message_cliente['btnMessage'])){  

  $res_msn = "INSERT INTO message_cliente (nome, email, cel, tel, assunto, textarea, created) VALUES (:nome, :email, :cel, :tel, :assunto, :textarea, NOW())";
  $result_db_msn = $conn->prepare($res_msn);
  $result_db_msn->bindParam(':nome', $message_cliente['nome']);
  $result_db_msn->bindParam(':email', $message_cliente['email']);
  $result_db_msn->bindParam(':cel', $message_cliente['cel']);
  $result_db_msn->bindParam(':tel', $message_cliente['tel']);
  $result_db_msn->bindParam(':assunto', $message_cliente['assunto']);
  $result_db_msn->bindParam(':textarea', $message_cliente['textarea']);
  $result_db_msn->execute();

  if ($result_db_msn->rowCount()) {
    $_SESSION['msn'] = "<div class='alert alert-success' role='alert'>Enviado com Sucesso. Entraremos em contato em breve!</div>";
  }

}

require "../back/core/app/navbar.php";

?>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Contato</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  contato
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row">
          <div
            class="col-lg-4 mb-5 mb-lg-0"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <div class="contact-info">
              <div class="address mt-2">
                <i class="icon-room"></i>
                <h4 class="mb-2">Corretor:</h4>
                <p><?php echo $nome; ?><br /> CRECI: <?php echo $creci; ?></p>
              </div>

              <div class="open-hours mt-4">
                <i class="icon-clock-o"></i>
                <h4 class="mb-2">Horários:</h4>
                <p><?php echo $semana; ?>:<br /><?php echo $horario; ?></p>
              </div>

              <div class="email mt-4">
                <i class="icon-envelope"></i>
                <h4 class="mb-2">Email:</h4>
                <p><?php echo $email?></p>
              </div>

              <div class="phone mt-4">
                <i class="icon-whatsapp"></i>
                <h4 class="mb-2">WhatsApp:</h4>
                <p><?php echo $tel_one; ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <div class="mb-3">
              <h4>Fale Conosco</h4>
              <span>Preencha o formulário abaixo que entrarei em contato com você.</span>
            </div>
            <?php
              if (isset($_SESSION['msn'])) {
                  echo $_SESSION['msn'];
                  unset($_SESSION['msn']);
              }
            ?>

            <form action="#" method="post">
              <div class="row">
                <div class="col-6 mb-3">
                  <input
                    type="text"
                    name="nome"
                    class="form-control"
                    placeholder="Seu Nome"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Seu E-mail"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="text"
                    name="cel"
                    class="form-control"
                    placeholder="Celular"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="text"
                    name="tel"
                    class="form-control"
                    placeholder="Telefone"
                  />
                </div>
                <div class="col-12 mb-3">
                  <input
                    type="text"
                    name="assunto"
                    class="form-control"
                    placeholder="Asusnto"
                  />
                </div>
                <div class="col-12 mb-3">
                  <textarea
                    name="textarea"
                    id=""
                    cols="30"
                    rows="7"
                    class="form-control"
                    placeholder="Olá, Preciso de um ajuda para..."
                  ></textarea>
                </div>

                <div class="col-12 mb-3">
                  <input
                    type="submit"
                    value="Send Message"
                    name="btnMessage"
                    class="btn btn-primary"
                  />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    

    <?php require "../back/core/app/footer.php" ?>
    