<?php

	include_once('../../../wp-config.php');
	include_once('../../../wp-load.php');
	include_once('../../../wp-includes/wp-db.php');
	global $wpdb;
	global $current_user;

	get_currentuserinfo();
	$user = $current_user->user_login;
	$titre = $_POST['titre'];
	$ss_titre = $_POST['ss_titre'];
	$pres = $_POST['presentation'];
	$datedpost = $_POST['profile_dated'];
	$datefpost = $_POST['profile_datef'];
	$titre_recit = $_POST['profile_titre_recit'];
	$recit = $_POST['profile_recit'];
	$lieud = $_POST['profile_lieud'];
	$destination = $_POST['profile_destination'];
	$titreimg = $_POST['profile_titre_photo'];
	$legende = $_POST['profile_legende'];
	$entete = $_POST['entetecache'];// image cdv name
	$checkbox1 =$_POST['profile_checkbox1'];//isset($_POST['profile_checkbox1']) ? 1 : 0;
	$checkbox2 =$_POST['profile_checkbox2'];// isset($_POST['profile_checkbox2']) ? 1 : 0;
	$datemod = date('Y-m-d');
	$id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
	$cdv_version_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv_version) AS cpt FROM cdv, cdv_version WHERE cdv_version.ID_cdv_version = ($id_cdv_actif + (-2)) AND cdv.ID_contact = $user ORDER BY ID_cdv_version DESC");
	$statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $id_cdv_actif ");
	$date= date("Y-m-d");

	$contentt=content_url();
	
	if($_POST['cropped_image']!=""){
		
		$imgData = str_replace(' ','+',$_POST['cropped_image']);
		$imgData =  substr($imgData,strpos($imgData,",")+1);
		$imgData = base64_decode($imgData);

		 $extension = ".jpeg";
		$nouveaunom = 'imageCDV_'.$id_cdv_actif.'_'.$user. $extension;
		$content = explode('/themes',get_template_directory());

		$filePath = getcwd().'/upload/'. $nouveaunom;

		if (!file_exists('../wp-content/plugins/carnet_voyages/upload/'. $nouveaunom)) 
		{                   
		 
		   unlink('../wp-content/plugins/carnet_voyages/upload/'. $nouveaunom);
		} 

		$file = fopen($filePath, 'w');
		fwrite($file, $imgData);
		fclose($file);
		$entete=$contentt.'/plugins/carnet_voyages/upload/'. $nouveaunom; 
	}



	 
//********************************************************************************

 if ( $statut == 0 || $statut == 1 || $statut == 2) {
	  
	 
	 
	 
    
     if($checkbox1==1 && $checkbox2==1){
        $idlib = $wpdb->get_var("SELECT idTypeCircuit FROM cdv WHERE ID_cdv = '" . $id_cdv_actif . "' ORDER BY ID_cdv DESC");
        if ($idlib != 3) {
            if (isset($entete) && isset($titre) && isset($pres)) {
                $reussite = $wpdb->update('cdv', array(
                    'imgCdv' => $entete,
                    'titleCdv' => $titre,
                    'Statut' =>2,
                    'txtIntroCdv' => $pres,
                    'copyrightCdv' => $checkbox1,
                    'droitUtilisation' => $checkbox2,
                    'dateModif'      =>$date
                        ), array(
                    'ID_cdv' => $id_cdv_actif
                        )
                );
            }
        } else {
            if (isset($entete) && isset($titre) && isset($pres) && isset($ss_titre)) {
                $reussite = $wpdb->update('cdv', array(
                    'imgCdv' => $entete,
                    'titleCdv' => $titre,
                    'Statut' =>2,
                    'subtitleCdv' => $ss_titre,
                    'txtIntroCdv' => $pres,
                    'copyrightCdv' => $checkbox1,
                    'droitUtilisation' => $checkbox2,
                     'dateModif'      =>$date
                        ), array(
                    'ID_cdv' => $id_cdv_actif
                        ) 
                );
            }
        }
       if($reussite) {
         
       // echo ('votre demande est bien enregistré ! ');  
       }
        else {
			if($_POST['cropped_image']!=""){}
			else{
           echo "une erreur se produite lors de l'enregistrement!";
			}
       }  
     }
 else {
     
      $idlib = $wpdb->get_var("SELECT idTypeCircuit FROM cdv WHERE ID_cdv = '" . $id_cdv_actif . "' ORDER BY ID_cdv DESC");
        if ($idlib != 3) {
            if (isset($entete) && isset($titre) && isset($pres)) {
                $reussite = $wpdb->update('cdv', array(
                    'imgCdv' => $entete,
                    'titleCdv' => $titre,
                    'Statut' =>1,
                    'txtIntroCdv' => $pres,
                    'copyrightCdv' => $checkbox1,
                    'droitUtilisation' => $checkbox2,
                    'dateModif'      =>$date
                        ), array(
                    'ID_cdv' => $id_cdv_actif
                        )
                );
            }
        } else {
            if (isset($entete) && isset($titre) && isset($pres) && isset($ss_titre)) {
                $reussite = $wpdb->update('cdv', array(
                    'imgCdv' => $entete,
                    'titleCdv' => $titre,
                    'Statut' =>1,
                    'subtitleCdv' => $ss_titre,
                    'txtIntroCdv' => $pres,
                    'copyrightCdv' => $checkbox1,
                    'droitUtilisation' => $checkbox2,
                     'dateModif'      =>$date
                        ), array(
                    'ID_cdv' => $id_cdv_actif
                        )
                );
            }
        }
     
     
     
     
     
            if($reussite) {

                 echo "checked!"; 
              }
               else {
                  echo "une erreur se produite lors de l'enregistrement!";
              }
          
         
     }
      
}

?>