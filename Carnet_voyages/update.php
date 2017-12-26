<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

$ID_recit= $_POST['ID_recit'];
$titre_recit= $_POST['titre_recit'];
if($_POST['datedebut']!=""){
 $datedebut=date("Y-m-d", strtotime($_POST['datedebut']));
}else{
 $datedebut=$_POST['datedebut'];
}

if($_POST['datedefin']!=""){
$datedefin=date("Y-m-d", strtotime($_POST['datedefin'])); //$_POST['datedefin'];
}else{
$datedefin=$_POST['datedefin'];
}
$recit= $_POST['recit'];
$addep= $_POST['addep'];
$addest= $_POST['addest'];

$reussite = $wpdb->update(
                'cdv_editorial', array(
                'titlePost' => $titre_recit,
                'txtPost' => $recit,
                'dateDebutPost' => $datedebut,
                'dateFinPost' => $datedefin,
                'lieuDepPost' => $addep,
                'lieuArrPost' => $addest
                ), array(
                'ID_edito' => $ID_recit
                )
            ); 


if($reussite){
    echo 'modifié!';
}
 else {
    echo 'erreur';    
} 