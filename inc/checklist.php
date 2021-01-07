<?php
session_start();

require_once('../bd/conexao.php');

$dataHoje= date('d/m/Y H:i:s');


//FUNCIONARIO
if(empty($_GET['id'])){
    $id_fun = $_SESSION['id_funcionario'];
}else{
    $id_fun = $_GET['id'];
}


//DEMITINDO FUNCIONÁRIO
if($_POST['demitido'] == 0){//0=sim; 1=não
    $updateDemitido= "UPDATE manager_inventario_funcionario SET status = 8 WHERE id_funcionario = ".$id_fun."";

    if(!$resultUpdate = $conn->query($updateDemitido)){
        printf("Error[1]: %s\n", $conn->error);
        exit;
    }
}

//GERANDO O TERMO

if ($_POST['equip'] == NULL) {
     //sim é todos os equipamentos

     if ($_SESSION["perfil"] == 1) {

        header('location: checkpdf.php?id_fun='.$id_fun.'');

    } else {        

        header('location: checkpdftecnicos.php?id_fun='.$id_fun.'');
    }

   
} else {
    
     //não é todos os equipamentos
     $equip = " WHERE MIE.id_equipamento in (";

     $qte = count($_POST['equip']);
 
     $cont = 1;
 
     foreach ($_POST['equip'] as $id_equipamento) {
         $equip .= $id_equipamento;
 
         if ($qte == $cont) {
             $equip .= ")";
         } else {
             $equip .= ",";
         }
 
         $cont++;
     }
 
     if ($_SESSION["perfil"] == 1) {
         header('Location: checkpdf.php?query=' . $equip . '');
     } else {
         header('Location: checkpdftecnicos.php?query=' . $equip . '');
     }
   
}
