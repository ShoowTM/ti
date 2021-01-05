<?php
require_once('header.php');

require_once('../inc/permissoes.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid py-4">

  <!-- Page Heading -->
  <h1 class="h6 mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <i class="fab fa-google"></i> Pesquisa
    <!--- <span class="float-rigth"><a href="colaboradores.php?pagina=3" id="atualiz"><i class="fas fa-sync-alt"></i> Atualizar</a></span> --->
  </h1>
  <hr />

  <!-- Conteudo -->


  <!-- Topbar Search -->
  <div class="centro">
    <img src="../img/google.png">
    <hr>
    <div class="dentro">

      <form class="container d-none d-sm-inline-block form-inline mr-auto ml-md-0 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="borderradius form-control bg-blue border-0 small" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <!--<button class="btn btn-dark" type="button"> 
                    <i class="fas fa-search fa-sm"></i>-->
            </button>
          </div>
        </div>
      </form>
      <hr>
    </div>

    <div>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i> Buscar</a>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50 fas fa-plus"></i> Adicionar Conteudo</a>
    </div>



    <!-- Conteudo  /.container-fluid -->

  </div>




  <!-- AMADOR QUE FALA NEH -->
  <div>
    <hr>
  </div>


  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>TI Grupo Servopa - Qualquer dúvida ligue no 110-2151</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
</body>

</html>