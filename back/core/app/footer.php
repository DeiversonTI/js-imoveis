<?php

$res = "SELECT nome, creci, tel_one, tel_two, facebook, instagram FROM contato_empresa LIMIT 1";
$result_db = $conn->prepare($res);
$result_db->execute();
$result = $result_db->fetch(PDO::FETCH_ASSOC);

extract($result);


?>
<div class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="widget">
          <h3>Contato</h3>
          <address><?php echo $nome; ?><br /> CRECI: <?php echo $creci ?></address>
          <ul class="list-unstyled links">
            <li><?php echo $tel_one ?></li>
            <li><?php echo $tel_two ?></li>
            <!-- <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
            <li><a href="tel://11234567890">+1(123)-456-7890</a></li> -->
            <!-- <li>
              <a href="mailto:info@mydomain.com">info@mydomain.com</a>
            </li> -->
          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="widget">
          <h3>A Empresa</h3>
          <ul class="list-unstyled float-start links">
            <!-- <li><a href="about.php">Sobre Nós</a></li> -->
            <li><a href="#">Anuncie seu Imóvel</a></li>
            <li><a href="contact.php">Fale Conosco</a></li>
          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="widget">
          <h3>Imóveis</h3>
          <ul class="list-unstyled links">
            <li><a href="e-comprar.php">Comprar Imóvel</a></li>
            <li><a href="#">Alugar Imóvel</a></li>
          </ul>

          <ul class="list-unstyled social">
            <li>
              <a href="<?php echo $instagram ?>"><span class="icon-instagram"></span></a>
            </li>
            <li>
              <a href="<?php echo $facebook ?>"><span class="icon-facebook"></span></a>
            </li>

          </ul>
        </div>
        <!-- /.widget -->
      </div>
      <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

    <div class="row mt-5">
      <div class="col-12 text-center">
        <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

        <p>
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script>
          . Todos Direitos Reservados &mdash;  Template Desenvolvido por <a href="https://untree.co">Untree.co</a>
          <!-- License information: https://untree.co/license/ -->
        </p>       
      </div>
    </div>
  </div>
</div>
<!-- /.container -->
</div>
<!-- /.site-footer -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/search.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/aos.js"></script>
<script src="js/navbar.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>

</body>

</html>