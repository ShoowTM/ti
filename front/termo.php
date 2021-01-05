<?php
require_once('header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h6 mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <i class="fas fa-users"></i> Colaboradores
  </h1>
  <hr />
  <div class="text-center">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Colaborador <span class="colorRed">DESATIVADO!</span></h1>
    <div style="display: <?= $_SESSION["ativar_cpf"] == 0 ? "none" : "block" ?>;">
      <p class="mb-4">Deseja ativar ele novamente ?</p>
      <a href="../inc/ativarfuncionario.php?id=<?= $_GET['id'] ?>" class="btn btn-success">SIM</a>
    </div>
    <div style="display: <?= $_SESSION["ativar_cpf"] == 0 ? "block" : "none" ?>;">
      <p class="mb-4">Você não tem permissão para reativá-lo</p>
      <a href="colaboradores.php?pagina=3" class="btn btn-warning">Voltar</a>
    </div>
  </div>
  <!-- /.container-fluid -->

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