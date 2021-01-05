<?php
session_start();

require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');

$queryEquipamento .= " WHERE MIE.id_funcionario = " . $_SESSION['id_funcionario'] . "";

$result = $conn->query($queryEquipamento);

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="menu mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="colaboradores.php?pagina=3"><i class="fas fa-users"></i> Colaboradores</a> /
    <a href="funcionario.php?pagina=3"><i class="fas fa-user"></i> <?= $_SESSION['nomeFuncionario'] ?></a> /
    <i class="fas fa-laptop"></i> Equipamentos
  </h1>
  <hr />

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Equipamentos</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Lista dos equipamentos
        <a href="checklist.php?pagina=3" class="float-right btn btn-warning" style="display: <?= empty($_SESSION["emitir_check_list"]) ? "none" : "inline-block" ?>;" title="Check-list"><i class="fas fa-list"></i></a>
        <a href="termo.php?pagina=3" class="float-right btn btn-info" style="margin-right: 10px;" title="Termo"><i class="fas fa-file"></i></a>         
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered small-lither" id="dataTable" width="100%" cellspacing="0">

          <?php

          if ($_SESSION['perfil'] == 1) { //USUÁRIO
            echo '<thead>
                        <tr>
                          <th>ID</th>
                          <th>EQUIPAMENTO</th>
                          <th>MODELO</th>
                          <th>PATRIMÔNIO</th>
                          <th>FILIAL</th>
                          <th>OPERADORA</th>
                          <th>NUMERO</th>
                          <th>IMEI</th>
                          <th>PLANO</th>
                          <th>VALOR</th>
                          <th>ESTADO</th>
                          <th>SITUAÇÃO</th>
                          <th>STATUS</th>
                          <th>TERMO</th>
                          <th>AÇÃO</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>EQUIPAMENTO</th>
                          <th>MODELO</th>
                          <th>PATRIMÔNIO</th>
                          <th>FILIAL</th>
                          <th>OPERADORA</th>
                          <th>NUMERO</th>
                          <th>IMEI</th>
                          <th>PLANO</th>
                          <th>VALOR</th>
                          <th>ESTADO</th>
                          <th>SITUAÇÃO</th>
                          <th>STATUS</th>
                          <th>TERMO</th>
                          <th>AÇÃO</th>
                        </tr>
                      </tfoot>';
          } elseif ($_SESSION['perfil'] == 2) { //tecnicos
            echo '<thead>
                <tr>
                  <th>ID</th>
                  <th>EQUIPAMENTO</th>
                  <th>PATRIMÔNIO</th>
                  <th>FILIAL</th>
                  <th>NUMERO</th>
                  <th>STATUS</th>
                  <th>IP</th>
                  <th>S.O</th>
                  <th>OFFICE</th>
                  <th>AD</th>
                  <th>AÇÃO</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>EQUIPAMENTO</th>
                  <th>PATRIMÔNIO</th>
                  <th>FILIAL</th>
                  <th>NUMERO</th>
                  <th>STATUS</th>
                  <th>IP</th>
                  <th>S.O</th>
                  <th>OFFICE</th>
                  <th>AD</th>
                  <th>AÇÃO</th>
                </tr>
              </tfoot>';
          } else { //demais perfis
            echo '<thead>
                    <tr>
                      <th>ID</th>
                      <th>EQUIPAMENTO</th>
                      <th>MODELO</th>
                      <th>PATRIMÔNIO</th>
                      <th>FILIAL</th>
                      <th>OPERADORA</th>
                      <th>NUMERO</th>
                      <th>IMEI</th>
                      <th>PLANO</th>
                      <th>VALOR</th>
                      <th>ESTADO</th>
                      <th>SITUAÇÃO</th>
                      <th>STATUS</th>
                      <th>TERMO</th>
                      <th>IP</th>
                      <th>S.O</th>
                      <th>OFFICE</th>
                      <th>AD</th>
                      <th>AÇÃO</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>EQUIPAMENTO</th>
                      <th>MODELO</th>
                      <th>PATRIMÔNIO</th>
                      <th>FILIAL</th>
                      <th>OPERADORA</th>
                      <th>NUMERO</th>
                      <th>IMEI</th>
                      <th>PLANO</th>
                      <th>VALOR</th>
                      <th>ESTADO</th>
                      <th>SITUAÇÃO</th>
                      <th>STATUS</th>
                      <th>TERMO</th>
                      <th>IP</th>
                      <th>S.O</th>
                      <th>OFFICE</th>
                      <th>AD</th>
                      <th>AÇÃO</th>
                    </tr>
                  </tfoot>';
          }
          ?>
          <tbody class="colorTable">
            <?php

            while ($equipamento = $result->fetch_assoc()) {

              //ICONES TERMO
              $equipamento['termo'] == 0 ? $termo = "<i class='fas fa-check-circle fa-2x colorGrenn' style='margin-left: 7px;'></i>" : $termo = "<i class='fas fa-times-circle fa-2x colorRed' style='margin-left: 7px;'></i>";

              //ICONES DOMINIO
              $equipamento['dominio'] == 0 ? $dominio = "<i class='fas fa-check-circle fa-2x colorGrenn' style='margin-left: px;'></i>" : $dominio = "<i class='fas fa-times-circle fa-2x colorRed' style='margin-left: 3px;'></i>";

              //OFFICE
              if ($equipamento['id_tipoEquipamento'] == 9 || $equipamento['id_tipoEquipamento'] == 8) {
                //OFFICE
                $queryoffice = "SELECT 
                                  MO.versao AS id_versao, 
                                  MDO.nome AS versao
                                  FROM
                                  manager_office MO
                                  LEFT JOIN
                                  manager_dropoffice MDO ON (MO.versao = MDO.id) WHERE MO.id_equipamento = '" . $equipamento['id_equipamento'] . "'";

                if (!$resultOFFICE = $conn->query($queryoffice)) {
                  printf("erro[1]: %s\n", $conn->error);
                } else {
                  $office = $resultOFFICE->fetch_assoc();
                }
              }

              //WINDOWS  
              if ($equipamento['id_tipoEquipamento'] == 9 || $equipamento['id_tipoEquipamento'] == 8) {
                //WINDOWS
                $queryso = "SELECT 
                              MSO.versao AS id_versao, 
                              MDSO.nome AS versao
                              FROM
                              manager_sistema_operacional MSO
                              LEFT JOIN
                              manager_dropsistemaoperacional MDSO ON (MSO.versao = MDSO.id) WHERE MSO.id_equipamento = " . $equipamento['id_equipamento'] . "";

                if (!$resultos = $conn->query($queryso)) {
                  printf("erro[2]: %s\n", $conn->error);
                } else {
                  $so = $resultos->fetch_assoc();
                }
              }


              if ($_SESSION['perfil'] == 1) { //usuario
                echo '<tr>';
                echo $equipamento['id_equipamento'] != NULL ?  '<td>' . $equipamento['id_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['tipo_equipamento'] != NULL ?  '<td>' . $equipamento['tipo_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['modelo'] != NULL ?  '<td>' . $equipamento['modelo'] . '</td>' :  '<td>-</td>';
                echo $equipamento['patrimonio'] != NULL ?  '<td>' . $equipamento['patrimonio'] . '</td>' :  '<td>-</td>';
                echo $equipamento['empresa'] != NULL ?  '<td>' . $equipamento['empresa'] . '</td>' :  '<td>-</td>';
                echo $equipamento['operadora'] != NULL ?  '<td>' . $equipamento['operadora'] . '</td>' :  '<td>-</td>';
                echo $equipamento['numero'] != NULL ?  '<td>' . $equipamento['numero'] . '</td>' :  '<td>-</td>';
                echo $equipamento['imei_chip'] != NULL ?  '<td>' . $equipamento['imei_chip'] . '</td>' :  '<td>-</td>';
                echo $equipamento['planos_voz'] != NULL || $equipamento['planos_dados'] != NULL ?  '<td>' . $equipamento['planos_voz'] . ',' . $equipamento['planos_dados'] . '</td>' :  '<td>-</td>';
                echo $equipamento['valor'] != NULL ?  '<td>' . $equipamento['valor'] . '</td>' :  '<td>-</td>';
                echo $equipamento['estado'] != NULL ?  '<td>' . $equipamento['estado'] . '</td>' :  '<td>-</td>';
                echo $equipamento['situacao'] != NULL ?  '<td>' . $equipamento['situacao'] . '</td>' :  '<td>-</td>';
                echo $equipamento['status'] != NULL ?  '<td>' . $equipamento['status'] . '</td>' :  '<td>-</td>';
                echo $equipamento['termo'] != NULL ?  '<td>' . $termo . '</td>' :  '<td>-</td>';
                /*AÇÂO*/
                if ($equipamento['id_tipoEquipamento'] == 9 || $equipamento['id_tipoEquipamento'] == 5 || $equipamento['id_tipoEquipamento'] == 8  || $equipamento['id_tipoEquipamento'] == 10) {
                  echo "<td>Técnicos são responsáveis</td>";
                } else {
                  echo "<td></td>";
                }
                /*FIM AÇÂO*/
                echo '</tr>';
              } elseif ($_SESSION['perfil'] == 2) {
                echo '<tr>';
                echo $equipamento['id_equipamento'] != NULL ?  '<td>' . $equipamento['id_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['tipo_equipamento'] != NULL ?  '<td>' . $equipamento['tipo_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['patrimonio'] != NULL ?  '<td>' . $equipamento['patrimonio'] . '</td>' :  '<td>-</td>';
                echo $equipamento['empresa'] != NULL ?  '<td>' . $equipamento['empresa'] . '</td>' :  '<td>-</td>';
                echo $equipamento['numero'] != NULL ?  '<td>' . $equipamento['numero'] . '</td>' :  '<td>-</td>';
                echo $equipamento['status'] != NULL ?  '<td>' . $equipamento['status'] . '</td>' :  '<td>-</td>';
                echo $equipamento['ip'] != NULL ?  '<td>' . $equipamento['ip'] . '</td>' :  '<td>-</td>';

                if ($equipamento['id_tipoEquipamento'] == 9 || $equipamento['id_tipoEquipamento'] == 8) {
                  echo $so['versao'] != NULL ?  '<td>' . $so['versao'] . '</td>' :  '<td>-</td>';
                  echo $office['versao'] != NULL ?  '<td>' . $office['versao'] . '</td>' :  '<td>-</td>';
                  echo $equipamento['dominio'] != NULL ?  '<td>' . $dominio  . '</td>' :  '<td>-</td>';
                } else {
                  echo '<td>-</td>';
                  echo '<td>-</td>';
                  echo '<td>-</td>';
                }
                /*AÇÂO*/
                echo '<td>
                        <a href="#" class="btn btn-success btn-sm btn-circle" title="Editar/Visualizar"><i class="fas fa-pen"></i></a>
                        <a href="#" class="btn btn-warning btn-sm btn-circle" title="Check-List"><i class="fas fa-list-ul"></i></a>
                      </td>';
              } else {
                echo '<tr>';
                echo $equipamento['id_equipamento'] != NULL ?  '<td>' . $equipamento['id_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['tipo_equipamento'] != NULL ?  '<td>' . $equipamento['tipo_equipamento'] . '</td>' :  '<td>-</td>';
                echo $equipamento['modelo'] != NULL ?  '<td>' . $equipamento['modelo'] . '</td>' :  '<td>-</td>';
                echo $equipamento['patrimonio'] != NULL ?  '<td>' . $equipamento['patrimonio'] . '</td>' :  '<td>-</td>';
                echo $equipamento['empresa'] != NULL ?  '<td>' . $equipamento['empresa'] . '</td>' :  '<td>-</td>';
                echo $equipamento['operadora'] != NULL ?  '<td>' . $equipamento['operadora'] . '</td>' :  '<td>-</td>';
                echo $equipamento['numero'] != NULL ?  '<td>' . $equipamento['numero'] . '</td>' :  '<td>-</td>';
                echo $equipamento['imei_chip'] != NULL ?  '<td>' . $equipamento['imei_chip'] . '</td>' :  '<td>-</td>';
                echo $equipamento['planos_voz'] != NULL || $equipamento['planos_dados'] != NULL ?  '<td>' . $equipamento['planos_voz'] . ',' . $equipamento['planos_dados'] . '</td>' :  '<td>-</td>';
                echo $equipamento['valor'] != NULL ?  '<td>' . $equipamento['valor'] . '</td>' :  '<td>-</td>';
                echo $equipamento['estado'] != NULL ?  '<td>' . $equipamento['estado'] . '</td>' :  '<td>-</td>';
                echo $equipamento['situacao'] != NULL ?  '<td>' . $equipamento['situacao'] . '</td>' :  '<td>-</td>';
                echo $equipamento['status'] != NULL ?  '<td>' . $equipamento['status'] . '</td>' :  '<td>-</td>';
                echo $equipamento['termo'] != NULL ?  '<td>' . $termo . '</td>' :  '<td>-</td>';
                echo $equipamento['ip'] != NULL ?  '<td>' . $equipamento['ip'] . '</td>' :  '<td>-</td>';

                if ($equipamento['id_tipoEquipamento'] == 9 || $equipamento['id_tipoEquipamento'] == 8) {
                  echo $so['versao'] != NULL ?  '<td>' . $so['versao'] . '</td>' :  '<td>-</td>';
                  echo $office['versao'] != NULL ?  '<td>' . $office['versao'] . '</td>' :  '<td>-</td>';
                  echo $equipamento['dominio'] != NULL ?  '<td>' . $dominio  . '</td>' :  '<td>-</td>';
                } else {
                  echo '<td>-</td>';
                  echo '<td>-</td>';
                  echo '<td>-</td>';
                }
                /*AÇÂO*/
                echo '<td>
                        <a href="#" class="btn btn-success btn-sm btn-circle" title="Editar/Visualizar"><i class="fas fa-pen"></i></a>
                      </td>';
                echo '</tr>';
              }
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