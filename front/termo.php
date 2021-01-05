<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */
session_start();
require_once('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class=" mb-6 text-gray-800">
    <!-- Page Heading -->
    <h1 class="menu mb-6 text-gray-800">
      <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
      <a href="colaboradores.php?pagina=3"><i class="fas fa-users"></i> Colaboradores</a> /
      <a href="funcionario.php?pagina=3"><i class="fas fa-user"></i> <?= $_SESSION['nomeFuncionario'] ?></a> /
      <a href="funcionarioequip.php?pagina=3"><i class="fas fa-laptop"></i> Equipamentos</a> /
      <i class="fas fa-file"></i> Emitir Termo
    </h1>
  </h1>
  <hr />
  <!-- /.container-fluid -->
</div>

<div class="text-center py-4">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Emitir termo de todos os equipamentos ?</h1>
  <div class="py-4">
    <a href="javascript:" class="btn btn-danger">Não</a>
    <a href="javascript:" class="btn btn-success">SIM</a>
  </div>
</div>
<!-- End of Main Content -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Então escolha qual!</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Check</th>
            <th>Equipamento</th>
            <th>Modelo</th>
            <th>Patrimonio</th>
            <th>Número</th>
            <th>IMEI</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Check</th>
            <th>Equipamento</th>
            <th>Modelo</th>
            <th>Patrimonio</th>
            <th>Número</th>
            <th>IMEI</th>
          </tr>
        </tfoot>
        <tbody class="colorTable">
          <tr>
              <td><input type="checkbox" value="" name="equip[]"></td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>




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