<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

$newT= $_POST['newTitle'];
$newL=$_POST['newLegende'];
$titre_recit=$_POST['titre_recit'];
$source=$_POST['file_name'];
$latT=$_POST['lastTitle'];
$latL= $_POST['lastLegende'];        
$source = trim($source);

$id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");

if(isset($_POST['newTitle'])&& $_POST['newLegende'] && $source!=''){
$idphoto = $wpdb->get_var("SELECT ID_media FROM `cdv_media` WHERE nom_fichier='$source' AND ID_cdv='$id_cdv_actif' AND titleImg='".$latT."' AND txtImg='".$latL."' ");

$reussite = $wpdb->update(
                        'cdv_media', array(
                        'titleImg' => $newT,
                        'txtImg' => $newL 
                        ), array(
                        'ID_media' => $idphoto
                        )
                    );

if($reussite){
    echo 'informations  modifiés avec succés!';
}
}




//photo principale
if(isset($_POST['file_name_radio'])&& isset($_POST['profile_titre'])){
$sourcef = trim($_POST['file_name_radio']);


            $titre_recit=$_POST["profile_titre"];
            $id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv_actif . "' AND titlePost='" . $titre_recit . "'");
            $deb= $id_cdv_actif . $idedito;
            $idp = $wpdb->get_results("SELECT ID_media FROM cdv_media WHERE nom_fichier LIKE '$deb%' and ID_cdv ='" . $id_cdv_actif . "' ORDER BY ID_media DESC");
                foreach ($idp as $p) {
                    $idph = $p->ID_media;
                        //if ($idph == $id_cdv_actif) {
                            $reussite = $wpdb->update(
                                'cdv_media', array(
                                'IsPhotoPrincipal' => 0
                                ), array(
                                'ID_media' => $idph
                                )
                            );
                        //}
                }
               
                $isidphoto = $wpdb->get_var("SELECT ID_media FROM `cdv_media` WHERE nom_fichier='$sourcef' AND ID_cdv='$id_cdv_actif' ");
                
                    $reussite1 = $wpdb->update(
                        'cdv_media', array(
                        'IsPhotoPrincipal' => 1
                        ), array(
                        'ID_media' => $isidphoto
                        )
                    );
            if($reussite1) {
                echo'photo principale ok!';
            }   
    
}



//chek
//photo principale
if(isset($_POST['idphoto'])&& isset($_POST['idedito'])){
            $idedito=$_POST['idedito'];
            $idphoto=$_POST['idphoto'];
       
            $princip=$wpdb->get_var("SELECT IsPhotoPrincipal FROM cdv_media WHERE ID_media='" . $idphoto . "' ");
           // if($princip==0)
           // {
                if(isset($_POST['idcdvactif'])){
                    $id_cdv_actif=$_POST['idcdvactif'];
                }
                else{
                     $id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
                }
             
            
            $deb= $id_cdv_actif . $idedito;
			
            $idp = $wpdb->get_results("SELECT ID_media FROM cdv_media WHERE nom_fichier LIKE '$deb%' and ID_cdv ='" . $id_cdv_actif . "' ORDER BY ID_media DESC");
                foreach ($idp as $p) {
                    $idph = $p->ID_media;
					
					 
                      ///  if ($idph == $id_cdv_actif) {
                            $reussite = $wpdb->update(
                                'cdv_media', array(
                                'IsPhotoPrincipal' => 0
                                ), array(
                                'ID_media' => $idph
                                )
                            );
							
                        //}
                }
               
                
                
                    $reussite = $wpdb->update(
                        'cdv_media', array(
                        'IsPhotoPrincipal' => 1
                        ), array(
                        'ID_media' => $idphoto
                        )
                    );
            if($reussite) {
                echo'photo principale ok!';
            }  
                
       // }
    /*    elseif ($princip==1) {
            
                $reussite = $wpdb->update(
                        'cdv_media', array(
                        'IsPhotoPrincipal' => 0
                        ), array(
                        'ID_media' => $idphoto
                        )
                    );
            if($reussite) {
                echo'photo principale annulé!';
            }
        
    }*/
            
               
    
}

if(isset($_POST['idphoto'])&&$_POST['newTitlein']&&$_POST['newLegendein'])
{
    $newT= $_POST['newTitlein'];
    $newL=$_POST['newLegendein'];
    
    $idphoto =$_POST['idphoto'];
  
    $reussite = $wpdb->update(
                        'cdv_media', array(
                        'titleImg' => $newT,
                        'txtImg' => $newL 
                        ), array(
                        'ID_media' => $idphoto
                        )
                    );

if($reussite){
    echo 'informations  modifiés avec succés!';
}
    
    
    
}








    