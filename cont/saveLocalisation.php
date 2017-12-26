<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

$titre_recit = $_POST['profile_titre_recit'];

$lieud = $_POST['from'];
$destination = $_POST['to'];

$id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
$cdv_version_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv_version) AS cpt FROM cdv, cdv_version WHERE cdv_version.ID_cdv_version = ($id_cdv_actif + (-2)) AND cdv.ID_contact = $user ORDER BY ID_cdv_version DESC");

$statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $id_cdv_actif ");
$ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");
if($ordre==Null)
    {
        $ordre=1;
    }
else {$ordre=$ordre+1;}

//     if ( $statut != 3) {
if ($cdv_version_actif == NULL && $statut != 3) {
    
    $trp = $wpdb->get_var("SELECT DISTINCT titlePost FROM cdv_editorial where titlePost ='". htmlentities($_POST["profile_titre_recit"])."' and  ID_cdv='".$id_cdv_actif . "'");

 
    if ($statut == 0) {
        $reussite = $wpdb->update('cdv', array(
                                'Statut' => 1
                                    ), array(
                                'ID_cdv' => $id_cdv_actif
                                    )
                            );
    if ($reussite) {
                         
    if($trp !=htmlentities($_POST["profile_titre_recit"])){
      
    $nouveau_id = $wpdb->insert_id;
    $reussite = $wpdb->insert(
                        'cdv_editorial', array(
                        'ID_cdv' => $id_cdv_actif,
                        'titlePost' => $_POST["profile_titre_recit"],
                        'lieuDepPost' => $lieud,
                        'lieuArrPost' => $destination,
                        'ordPost'     => $ordre   
                        ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%d' 
                        )
                    );
                     echo 'Enregistré avec succès!';
    }
    elseif (($trp ==htmlentities($_POST["profile_titre_recit"]))) {
          
            echo 'Ce post est déjà existant! vous pouvez accéder pour modifier la localisation!';   
    
}        
           
							   
    }

}
    
else if ($statut == 1) {
    //statut = 2 et bouton enregistrer
   $reussite = $wpdb->update('cdv', array(
                                'Statut' => 2
                                    ), array(
                                'ID_cdv' => $id_cdv_actif
                                    )
                    );
    
    if ($reussite) {
    if($trp !=htmlentities($_POST["profile_titre_recit"])){
      
    $nouveau_id = $wpdb->insert_id;
    $reussite = $wpdb->insert(
                        'cdv_editorial', array(
                        'ID_cdv' => $id_cdv_actif,
                        'titlePost' => $_POST["profile_titre_recit"],
                        'lieuDepPost' => $lieud,
                        'lieuArrPost' => $destination,
                        'ordPost'     => $ordre   
                        ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%d' 
                        )
                    );
                    echo 'Enregistré avec succès!';
    }
    else if($trp ==htmlentities($_POST["profile_titre_recit"])){
        
            
           echo 'Ce post est déjà existant! vous pouvez accéder pour modifier la localisation!';
    }
}    
}
else if ($statut == 2) {
    echo 'votre cdv est en attente de validation vous pouvez pas ajoutez de nouveaux posts! ';
}

}
