<?php
require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');

//colaborador
switch ($_GET['status']) {
  case '4':
    $status = $_GET['status'];
    break;

  case '3':
    $status = $_GET['status'];
    break;

  case '8':
    $status = $_GET['status'];
    break;

  default:
    $status = '4, 3, 8';
    break;
}

$queryColaborador .= " WHERE MIF.deletar = 0 AND MIF.status IN (" . $status . ")";
$resultColaborador = $conn->query($queryColaborador);

//ativo
$resultAtivo = $conn->query($queryAtivosFuncionario);
$ativo = $resultAtivo->fetch_assoc();
//termo
$resultTermo = $conn->query($queryTermoFuncionario);
$termo = $resultTermo->fetch_assoc();
//demitudo
$resultDemitido = $conn->query($queryDemitidoFuncionario);
$demitido = $resultDemitido->fetch_assoc();

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h6 mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <i class="fas fa-users"></i> Colaboradores
    <span class="float-rigth"><a href="colaboradores.php?pagina=3" id="atualiz"><i class="fas fa-sync-alt"></i> Atualizar</a></span>
  </h1>
  <hr />

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Colaboradores</h1>
  <p class="mb-4">Caso queira adicionar um novo colaborador <a class="btn btn-success btn-pen-square btn-sm" title="Adicionar" href="#" data-toggle="modal" data-target="#adicionar"><i class="fas fa-user-plus"></i></a></p>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="colaboradores.php?pagina=3&status=4" class="text-decoration">
        <div class="card border-left-success shadow h-100 py-2" style="background-color: <?= $_GET['status'] == 4 ? "#1cc88a3b" : "white" ?>">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ativo</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ativo['status'] ?> Funcionários</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="colaboradores.php?pagina=3&status=3" class="text-decoration">
        <div class="card border-left-warning shadow h-100 py-2" style="background-color: <?= $_GET['status'] == 3 ? "#f6c23e52" : "white" ?>">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Falta Termo</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $termo['status'] ?> Funcionários</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="colaboradores.php?pagina=3&status=8" class="text-decoration">
        <div class="card border-left-danger shadow h-100 py-2" style="background-color: <?= $_GET['status'] == 8 ? "#e74a3b5c" : "white" ?>">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Demitidos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $demitido['status'] ?> Funcionários</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">lista de colaboradores</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered small-lither" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>C.P.F</th>
              <th>FUNÇÃO</th>
              <th>DEPARTAMENTO</th>
              <th>EMPRESA</th>
              <th>EQUIPAMENTOS</th>
              <th>STATUS</th>
              <th class="maior">AÇÃO</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>C.P.F</th>
              <th>FUNÇÃO</th>
              <th>DEPARTAMENTO</th>
              <th>EMPRESA</th>
              <th>EQUIPAMENTOS</th>
              <th>STATUS</th>
              <th  class="maior">AÇÃO</th>
            </tr>
          </tfoot>
          <tbody>
            <?php

            while ($colaborador = $resultColaborador->fetch_assoc()) {
              echo '<tr>';
              echo $colaborador['id_funcionario'] != NULL ?  '<td>' . $colaborador['id_funcionario'] . '</td>' :  '<td>----------</td>';
              echo $colaborador['nome'] != NULL ?  '<td>' . $colaborador['nome'] . '</td>' :  '<td>----------</td>';
              echo $colaborador['cpf'] != NULL ?  '<td>' . $colaborador['cpf'] . '</td>' :  '<td>----------</td>';
              echo $colaborador['funcao'] != NULL ?  '<td>' . $colaborador['funcao'] . '</td>' :  '<td>----------</td>';
              echo $colaborador['departamento'] != NULL ?  '<td>' . $colaborador['departamento'] . '</td>' :  '<td>----------</td>';
              echo $colaborador['empresa'] != NULL ?  '<td>' . $colaborador['empresa'] . '</td>' :  '<td>----------</td>';

              //quantidade equipamentos
              $queryQuantidadeEquipamentos = "SELECT 
              COUNT(*) AS quantidade, MDE.nome AS equipamento
              FROM
              manager_inventario_equipamento MIE
              LEFT JOIN
              manager_dropequipamentos MDE ON (MIE.tipo_equipamento = MDE.id_equip) 
              WHERE MIE.id_funcionario = " . $colaborador['id_funcionario'] . " AND MIE.deletar = 0 GROUP BY MDE.id_equip";

              $resultQuantidadeEquipamentos = $conn->query($queryQuantidadeEquipamentos);

              echo '<td>';

              while ($quantidadeEquipamentos = $resultQuantidadeEquipamentos->fetch_assoc()) {
                echo '[ ' . $quantidadeEquipamentos['quantidade'] . ' - ' . $quantidadeEquipamentos['equipamento'] . ' ]<br>';
              }

              echo '</td>';

              switch ($colaborador['id_status']) {
                case '4':
                  echo '<td><span class="icone" style="color: green;">' . $colaborador['status'] . '</span></td>';
                  break;

                case '3':
                  echo '<td><span class="icone" style="color: #f3b37c7a;">' . $colaborador['status'] . '</span></td>';
                  break;

                case '8':
                  echo '<td><span class="icone" style="color: black;">' . $colaborador['status'] . '</span></td>';
                  break;

                default:
                  '<td>CódErro[1]: NO STATUS</td>';
                  break;
              }

              echo '<td>                    
                      <a href="../inc/pesquisaFuncionario.php?id='.$colaborador['id_funcionario'].'" class="btn btn-success btn-sm btn-circle" title="Editar" ><i class="fas fa-pen"></i></a>
                      <a href="#" class="btn btn-warning btn-sm btn-circle" title="Check-List"  style="display: '; echo empty($_SESSION['emitir_check_list']) ? "none" : "inline-block"; echo '"><i class="fas fa-list-ul"></i></a>
                      <a href="#" class="btn btn-info btn-sm btn-circle" title="Termo"><i class="fas fa-file"></i></a>
                    </td>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
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
<!-- Logout Modal-->
<div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Localizar Funcionário</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../inc/pesquisaFuncionario.php" method="POST" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Digite o CPF" id="RegraValida" name="cpf" onkeydown="javascript: fMasc( this, mCPF );">
            <span class="small-lither">Veja se o funcionário ja está cadastrado!</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-info" type="submit">Procurar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</html>