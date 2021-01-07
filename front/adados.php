<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

require_once('../bd/conexao.php');
require_once('header.php');
require_once('../inc/dropdown.php');
require_once('../inc/pesquisas.php');

//quantidade equipamentos
if (!empty($_SESSION['id_funcionario'])) {
  $queryEquipamentosCount .= " WHERE id_funcionario = " . $_SESSION['id_funcionario'] . " Group by id_funcionario";
  $resultCountEquip = $conn->query($queryEquipamentosCount);
  $countEquip = $resultCountEquip->fetch_assoc();
}

?>
<!-- Begin Page Content -->
<div class="container-fluid py-4">
  <!-- Page Heading -->


  <div>
    <h1 class="menu mb-6 h6 text-gray-800">
      <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
      <a href="pdados.php?pagina=4"><i class="fab fa-google"></i> Pesquisa </a> /
      <i class="fas fa-plus"></i> Adicionar Conteúdo
    </h1>
    <hr />
  </div>


 

  <div class="col-lg-6 left">
    <!-- Circle Buttons -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 h6 font-weight-bold text-primary"><?= empty($_SESSION['nomeFuncionario']) ? "Adicionar Conteúdo" : "Editando Conteúdo" ?></h6>
      </div>

      <div class="card-body">
        <form action="<?= empty($_SESSION['nomeFuncionario']) ? "../inc/novofuncionario.php" : "../inc/editefuncionario.php?id=" . $_SESSION['id_funcionario'] . "" ?>" method="POST">
          <div class="form-group">
            <label for="nome"><a class="negritoad">Titulo</a></label>
                <input type="text" class="form-control" id="nome" value="<?= empty($_SESSION['nomeFuncionario']) ? "" : $_SESSION['nomeFuncionario'] ?>" name="titulo">
          </div>



          <!-- Label de Informações -->
          <label for="email"><a class="negritoad"><hr>Informações<hr class="tamanhohr"></a></label>
          <div class="form-group mb1">
            <textarea name='txtArtigo' id='txtArtigo'></textarea>
            <script>
              CKEDITOR.replace('txtArtigo');
            </script>
          </div>

          <!-- Botão de Anexar Arquivo -->

          <div class="btn btn-primary btn-icon-split menu roscovo mb-3 ">
            <label for="formFile" class="labelinfo form-label">
              <span class="botaoanexo icon text-white-50">
                <i class="fas fa-file-upload "></i>
              </span>
              <span class="textoanexar">
                Anexar Arquivo
              </span>
            </label>
            <input class="" type="file" id="formFile">
          </div>

          <!-- Botão Salvar -->

          <div>
          <a href="pdados.php?pagina=4" class="btn btn-primary btn-block22">Cancelar</a>

          </div>

          <?php
          if (empty($_SESSION['nomeFuncionario'])) {
            echo '<button type="submit" class="btn btn-primary btn-block22">Salvar</button>';
          } else {
            echo '<button type="submit" class="btn btn-success btn-block"';

            if ($_SESSION['editar_cadastroFuncionario'] == 0) {
              echo 'title="Você não tem permissão" disabled';
            }

            echo '>Editar</button>';
          }
          ?>

          <div class="col-lg-15 mb-4 my-2 text-center" id="senha" style="display: <?= $_GET['msn'] == 1 ? "block" : "none" ?>;">
            <div class="card bg-success text-white shadow">
              <div class="card-body">
                Salvo com sucesso!<br>
                Para aplicar as alterações sair e entre novamente no sistema!
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<hr>
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
<!-- Logout Modal-->



<!-- <div class="modal fade" id="desativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realmente quer <span class='colorRed'>EXCLUIR</span> o funcionario?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
        <a class="btn btn-primary" href="../inc/desativarfuncionario.php?id=<?= $_SESSION['id_funcionario'] ?>">Sim</a>
      </div>
    </div>
  </div>
</div> -->




</html>