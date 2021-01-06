<?php
session_start();

if(empty($_GET['id'])){
    $id_fun = $_SESSION['id_funcionario'];
}else{
    $id_fun = $_GET['id'];
}


if ($_POST['equip'] == NULL) {
     //sim é todos os equipamentos

     if ($_SESSION["perfil"] == 1) {

        header('location: termopdf.php?id_fun='.$id_fun.'');

    } else {        

        header('location: termopdftecnicos.php?id_fun='.$id_fun.'');
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
         header('Location: termopdf.php?query=' . $equip . '');
     } else {
         header('Location: termopdftecnicos.php?query=' . $equip . '');
     }
   
}
