<?php
/* permissões de visualização de conteudo:

Block = permitido;

None = não permitido; */


switch ($_SESSION['perfil']) {

  case '0'://Administrador
    //front.php
    $relatorio = "block";
    $google = "block";
    $colaboradores = "block";
    $equipamentos = "block";

    //config.php
    $config = "block";

    //perfil.php
    $perfil = "block";
    $alterarPermissoes = "block";

  break;
  
  case '1'://usuario
    
    //front.php
    $relatorio = "block";
    $google = "none";
    $colaboradores = "block";
    $equipamentos = "block";

    //config.php
    $config = "none";

    //perfil.php
    $perfil = "none";
    $alterarPermissoes = "none";
  break;

  case '2'://tecnico
    //front.php
    $relatorio = "block";
    $google = "block";
    $colaboradores = "block";
    $equipamentos = "block";

    //config.php
    $config = "none";

    //perfil.php
    $perfil = "none";
    $alterarPermissoes = "none";
  break;

  case '3'://RH
    //front.php
    $relatorio = "none";
    $google = "none";
    $colaboradores = "block";
    $equipamentos = "none";

    //config.php
    $config = "none";

    //perfil.php
    $perfil = "none";
    $alterarPermissoes = "none";
  break;

  case '4'://tecnicos RS
    //front.php
    $relatorio = "block";
    $google = "block";
    $colaboradores = "block";
    $equipamentos = "block";

    //config.php
    $config = "none";

    //perfil.php
    $perfil = "none";
    $alterarPermissoes = "none";
  break;
}

?>