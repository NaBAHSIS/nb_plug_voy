<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

    $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
   // $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
   $idcdv = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
    $trp = $wpdb->get_var("SELECT DISTINCT titlePost FROM cdv_editorial where titlePost ='".mysql_real_escape_string($_POST["profile_titre_recit"])."' and  ID_cdv='".$idcdv . "'");
	 
    $statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $idcdv ");
   $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version AS cpt FROM cdv_version WHERE cdv_version.ID_cdv = $idcdv ");

    
    if(!empty($trp)){
      // echo 'Ce titre existe déjà ! veuillez choisissez un autre';
	  // echo $trp.' /sans slaches: '.stripcslashes($trp);
	//exit;
    }
    else{
    if( $statut!=3 && $cdv_version_actif== NULL ){
      $ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");
        if($ordre==Null)
        {
        $ordre=1;
        }
        else {$ordre=$ordre+1;}
                   
        $nouveau_id = $wpdb->insert_id;
        $reussite = $wpdb->insert(
                            'cdv_editorial', array(
                            'ID_cdv' => $idcdv,
                            'titlePost' => $_POST["profile_titre_recit"],
                            'ordPost'     => $ordre    
                            ), array(
                            '%d',
                            '%s',
                            '%d'    
                            )
                        );
    }
    else{
        
         //creéation version
       // $idd_cdv_version = $wpdb->get_results("SELECT ID_cdv_version FROM cdv_version");
        //$id_cdv_version = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version");
        if ($cdv_version_actif == NULL) {
            $deux = (-2);
           
        $ID_cdv_version = $idcdv + $deux;
        
        $reussite = $wpdb->insert('cdv_version', array(
                            'ID_cdv_version' => $ID_cdv_version,
                            'ID_cdv' => $idcdv
                                ), array(
                            '%d',
                            '%d'
                            )
                        );
         //enregistrement version
        if($reussite){
        $reussite1 = $wpdb->update('cdv', array(
                        'Statut' => 1
                            ), array(
                        'ID_cdv' => $idcdv
                            )
                    );
                if($reussite1)
                {
                    $ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");
                    if($ordre==Null)
                    {
                    $ordre=1;
                    }
                    else {$ordre=$ordre+1;}

                    $nouveau_id = $wpdb->insert_id;
                    $reussite = $wpdb->insert(
                                        'cdv_editorial', array(
                                        'ID_cdv' => $idcdv,
                                        'titlePost' => $_POST["profile_titre_recit"],
                                        'ordPost'     => $ordre    
                                        ), array(
                                        '%d',
                                        '%s',
                                        '%d'    
                                        )
                                    );
 
                 }
      
        }
        
        
        
        
    }
    else{
        if($statut == 3){
        $reussite1 = $wpdb->update('cdv', array(
                        'Statut' => 1
                            ), array(
                        'ID_cdv' => $idcdv
                            )
                    );
                if($reussite1)
                {
                    $ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");
                    if($ordre==Null)
                    {
                    $ordre=1;
                    }
                    else {$ordre=$ordre+1;}

                    $nouveau_id = $wpdb->insert_id;
                    $reussite = $wpdb->insert(
                                        'cdv_editorial', array(
                                        'ID_cdv' => $idcdv,
                                        'titlePost' => $_POST["profile_titre_recit"],
                                        'ordPost'     => $ordre    
                                        ), array(
                                        '%d',
                                        '%s',
                                        '%d'    
                                        )
                                    );
 
                 }
    }
    else{
        
        
        $ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");
                    if($ordre==Null)
                    {
                    $ordre=1;
                    }
                    else {$ordre=$ordre+1;}

                    $nouveau_id = $wpdb->insert_id;
                    $reussite = $wpdb->insert(
                                        'cdv_editorial', array(
                                        'ID_cdv' => $idcdv,
                                        'titlePost' => $_POST["profile_titre_recit"],
                                        'ordPost'     => $ordre    
                                        ), array(
                                        '%d',
                                        '%s',
                                        '%d'    
                                        )
                                    );
        
    }
    }
}




}











if (isset($_POST["profile_titre_photo"]) && isset($_FILES["user_image"]["type"])) {
                        $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["user_image"]["name"]);
                        $file_extension = end($temporary);
                        if ((($_FILES["user_image"]["type"] == "image/png") || ($_FILES["user_image"]["type"] == "image/jpg") || ($_FILES["user_image"]["type"] == "image/jpeg")) 
                                && in_array($file_extension, $validextensions)) {
                            if (file_exists("upload/" . $_FILES["user_image"]["name"])) {
                                echo $_FILES["user_image"]["name"] . " already exists";
                            } else {
                                if ($_FILES["user_image"]["type"] == "image/png") {
                                    $extension = ".png";
                                } else if ($_FILES["user_image"]["type"] == "image/jpg") {
                                    $extension = ".jpg";
                                } else if ($_FILES["user_image"]["type"] == "image/jpeg") {
                                    $extension = ".jpeg";
                                } else if ($_FILES["user_image"]["type"] == "image/PNG") {
                                    $extension = ".PNG";
                                } else if ($_FILES["user_image"]["type"] == "image/JPG") {
                                    $extension = ".JPG";
                                } else if ($_FILES["user_image"]["type"] == "image/JPEG") {
                                    $extension = ".JPEG";
                                }
                                $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                               // $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                $titre_recit=mysql_real_escape_string($_POST["profile_titre_recit"]);
                                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $idcdv . "' AND titlePost='" . $titre_recit . "'");
                                $deb1 = $idcdv . $idedito;
                                $nouveaunom = $deb1 . date(Y) . date(m) . date(d) . date(H) . date(i) . date(s) . time(). $extension;
                                $content = explode('/themes',get_template_directory());
                                move_uploaded_file($_FILES["user_image"]["tmp_name"], getcwd().'/upload/'. $nouveaunom);
			                    $directory = getcwd().'/upload/' ;
                                $type = wp_check_filetype($nouveaunom);
                                //$ImageFolder = $content[0] .'/plugins/carnet_voyages/upload/';
		                $ImageFolder = $directory;
                                $quality = 60;
                                $w = 1000;
                                $h = 1000;
                                $fi = $nouveaunom;

                                function compress($source, $destination, $quality) {
                                    list($width, $height) = getimagesize($source);
                                    $info = getimagesize($source);
                                    if ($info['mime'] == 'image/jpeg')
                                        $image = imagecreatefromjpeg($source);
                                    elseif ($info['mime'] == 'image/png')
                                        $image = imagecreatefrompng($source);
                                    elseif ($info['mime'] == 'image/jpg')
                                        $image = imagecreatefromjpeg($source);
                                    imagejpeg($image, $destination, $quality);
                                    return $destination;
                                }
                                function verifType($source, $extention) {
                                    $extention = strtolower(strrchr($source, '.'));
                                    return $extention;
                                }
                                $source_img = $ImageFolder . $nouveaunom;
                                $destination_img = $ImageFolder . $nouveaunom;
                                $extention= verifType($source_img, $extention);
                                if($extention=='.jpg'||$extention=='.jpeg')
                                {
                                  $file = compress($source_img, $destination_img, $quality);
                                //fin optimiser image 60% 
                                }
                                else {
                                
                                
                                // *** Include the class
                                include("resize-class.php");
                                // *** 1) Initialize / load image
                                
                                $resizeObj = new resize($ImageFolder . $nouveaunom);
                                
                                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
                                $resizeObj->resizeImage(1000, 1000, 'auto');
                                // *** 3) Save image
                                $resizeObj->saveImage($ImageFolder . $nouveaunom, 60);
                                //fin resize image
                                }
                                
                                $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                //$idcdv = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC);
                                $titleimg = $_POST["profile_titre_photo"];
                                $legende = $_POST["profile_legende"];
								$cpt = $wpdb->get_var("SELECT count(nom_fichier) FROM cdv_media WHERE ID_cdv ='" . $idcdv . "' and nom_fichier LIKE '%$deb1%'");
								
								if($cpt==0){
									 $reussite = $wpdb->insert(
                                        'cdv_media', array(
										'IsPhotoPrincipal' => 1,
                                    'ID_cdv' => $idcdv,
                                    'titleImg' => $titleimg,
                                    'nom_fichier' => $nouveaunom,
                                    'txtImg' => $legende
                                        ), array(
									'%d',
                                    '%d',
                                    '%s',
                                    '%s',
                                    '%s'
                                        )
                                );
								}
								else{
									 $reussite = $wpdb->insert(
                                        'cdv_media', array(
									//	'IsPhotoPrincipal' => 1,
                                    'ID_cdv' => $idcdv,
                                    'titleImg' => $titleimg,
                                    'nom_fichier' => $nouveaunom,
                                    'txtImg' => $legende
                                        ), array(
                                    '%d',
                                    '%s',
                                    '%s',
                                    '%s'
                                        )
                                );
								}
                               
                             if($reussite) { 
								 //$idph = $wpdb->get_var("SELECT ID_media FROM cdv_media where nom_fichier='" . $nouveaunom . "'");
                                 //echo $idph;
                                 echo$nouveaunom;
                             } 
                            }
                            
                        } else {
                            echo "Invalid Type of FILE";
                        }/*   fin database */
                    } 
 
    
          