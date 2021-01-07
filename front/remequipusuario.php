<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

session_start();
require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');

$id_funcionario = $_SESSION['id_funcionario'];
$nomeFuncionario = $_SESSION['nomeFuncionario'];

//equipamento
$queryEquipamento .= "WHERE MIE.id_funcionario = " . $id_funcionario . "";
$resultEquipamento = $conn->query($queryEquipamento);


?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="mb-6 text-gray-800">
    <!-- Page Heading -->
    <h1 class="menu mb-6 text-gray-800">
      <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
      <a href="colaboradores.php?pagina=3"><i class="fas fa-users"></i> Colaboradores</a> /
      <a href="funcionario.php?pagina=3"><i class="fas fa-user"></i><?= $_SESSION['nomeFuncionario'] ?></a> /
      <a href="funcionarioequip.php?pagina=3"><i class="fas fa-laptop"></i> Equipamentos</a> /
      <i class="fas fa-minus-square"></i> Remover Equipamento
    </h1>
  </h1>
  <hr />
  <!-- /.container-fluid -->
  <form action="#" method="POST">
    <div>
      <h1 class="h6 mb-2 text-gray-800">1-) Qual status ficará esse equipamento ?</h1>
      <div class="row">
        <div class="col-md-2 py-4">
          <select name="demitido" class="form-control" required>
            <option value="">---</option>
            <option value="0">Sim</option>
            <option value="1">Não</option>
          </select>
        </div>
      </div>
    </div>

    <div>
      <h1 class="h6 mb-2 text-gray-800">2-) Deseja atribuir a um novo funcionário ?</h1>
      <div class="form-group py-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios1" value="1" onclick="sim()" checked>
          <label class="form-check-label" for="exampleRadios1">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios2" value="2" onclick="nao()">
          <label class="form-check-label" for="exampleRadios2">
            Não
          </label>
        </div>
      </div>
    </div>
    <div>
      <h1 class="h6 mb-2 text-gray-800">3-) Quer remover mais algum equipamento ?</h1>
      <div class="form-group py-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios1" value="1" onclick="sim()" checked>
          <label class="form-check-label" for="exampleRadios1">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios2" value="2" onclick="nao()">
          <label class="form-check-label" for="exampleRadios2">
            Não
          </label>
        </div>
      </div>
    </div>
    <div>
      <h1 class="h6 mb-2 text-gray-800">4-) Motivo da remoção ?</h1>
      <div class="form-group py-4">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Escreva..." name="msn"></textarea>
      </div>
    </div>
    <h1 class="h6 mb-2 text-gray-800">5-) Check-List:</h1>
    <div class="row">
      <div class="col-md-2 py-4">
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
    </div>
</div>
<!-- End of Main Content -->
<hr>
<div class="textCenterTela">
  <a href="funcionarioequip.php?pagina=3" class="btn btn-success btn-icon-split rigth">
    <span class="icon text-white-50">
      <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">voltar</span>
  </a>
  <button type="submit" class="btn btn-danger btn-icon-split">
    <span class="icon text-white-50">
      <i class="fas fa-minus"></i>
    </span>
    <span class="text">Remover Equipamento</span>
  </button>
</div>
</form>
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

<!--MOSTRAR TABELA DOS EQUIPAMENTOS-->
<script>
  function nao() {
    document.getElementById("tabelaEquip").style.display = "block";
  }

  function sim() {
    document.getElementById("tabelaEquip").style.display = "none";
  }
</script>

</html>