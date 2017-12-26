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
if($_POST['profile_dated']!=""){
$datedpost=date("Y-m-d", strtotime($_POST['profile_dated']));
}else{
$datedpost=$_POST['profile_dated'];
}
if($_POST['profile_datef']!=""){
$datefpost=date("Y-m-d", strtotime($_POST['profile_datef']));
}else{
$datefpost=$_POST['profile_datef'];
}

$titre_recit = $_POST['profile_titre_recit'];
$recit = $_POST['profile_recit'];
$lieud = $_POST['from'];
$destination = $_POST['to'];
$titreimg = $_POST['profile_titre_photo'];
$legende = $_POST['profile_legende'];
$entete = $_POST['entete'];
$checkbox1 = $_POST['profile_checkbox1'] ;//isset($_POST['profile_checkbox1']) ? 1 : 0;
$checkbox2 = $_POST['profile_checkbox2'];//isset($_POST['profile_checkbox2']) ? 1 : 0;
$datemod = date('Y-m-d');

$id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
//$cdv_version_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv_version) AS cpt FROM cdv, cdv_version WHERE cdv_version.ID_cdv_version = ($id_cdv_actif + (-2)) AND cdv.ID_contact = $user ORDER BY ID_cdv_version DESC");


$cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version AS cpt FROM cdv_version WHERE cdv_version.ID_cdv = $id_cdv_actif ");

$statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $id_cdv_actif ");
$ordre = $wpdb->get_var("SELECT ordPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user  ORDER BY ordPost DESC ");

if($ordre==Null)
    {
        $ordre=1;
    }
else {$ordre=$ordre+1;}


 $trp = $wpdb->get_var("SELECT DISTINCT titlePost FROM cdv_editorial where titlePost ='".mysql_real_escape_string($_POST["profile_titre_recit"])."' and  ID_cdv='".$id_cdv_actif . "'");


if ($cdv_version_actif == NULL && $statut != 3) { 
     
   
    
    if ($statut == 0) {
        $reussite = $wpdb->update('cdv', array(
                                'Statut' => 1
                                    ), array(
                                'ID_cdv' => $id_cdv_actif
                                    )
                            );
        if ($reussite) {
                         
        //if( stripcslashes($trp) !=$_POST["profile_titre_recit"]){
      if(empty($trp)){
    $nouveau_id = $wpdb->insert_id;
    $reussite = $wpdb->insert(
                        'cdv_editorial', array(
                        'ID_cdv' => $id_cdv_actif,
                        'titlePost' => $_POST["profile_titre_recit"],
                        'txtPost' => $recit,
                        'dateDebutPost' => $datedpost,
                        'dateFinPost' => $datefpost,
                        'lieuDepPost' => $lieud,
                        'lieuArrPost' => $destination,
                        'ordPost'     => $ordre   
                        ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d' 
                        )
                    );
                    echo 'created';
    }
    //elseif (( stripcslashes($trp) ==$_POST["profile_titre_recit"])) {
		else{
        $reussite = $wpdb->update(
                'cdv_editorial', array(
                'txtPost' => $recit,
                'dateDebutPost' => $datedpost,
                'dateFinPost' => $datefpost,
                'lieuDepPost' => $lieud,
                'lieuArrPost' => $destination
                ), array(
                'titlePost' => $titre_recit,
                'ID_cdv' =>  $id_cdv_actif  
                )
            );  
        
        
            echo 'updated';   
    
}        
           
							   
    }

}
    
else {
   
    //if(stripcslashes($trp)!=($_POST["profile_titre_recit"])){
    if(empty($trp)){  
    $nouveau_id = $wpdb->insert_id;
    $reussite = $wpdb->insert(
                        'cdv_editorial', array(
                        'ID_cdv' => $id_cdv_actif,
                        'titlePost' => $_POST["profile_titre_recit"],
                        'txtPost' => $recit,
                        'dateDebutPost' => $datedpost,
                        'dateFinPost' => $datefpost,
                        'lieuDepPost' => $lieud,
                        'lieuArrPost' => $destination,
                        'ordPost'     => $ordre   
                        ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d' 
                        )
                    );
                    echo 'created';
    }
    //else if(stripcslashes($trp) ==($_POST["profile_titre_recit"])){
     else{   
            $reussite = $wpdb->update(
                                'cdv_editorial', array(
                                'txtPost' => $recit,
                                'dateDebutPost' => $datedpost,
                                'dateFinPost' => $datefpost,
                                'lieuDepPost' => $lieud,
                                'lieuArrPost' => $destination
                                    ), array(
                                'titlePost' => $titre_recit,
                                'ID_cdv' =>  $id_cdv_actif  
                                    )
            );
            echo 'updated';
    }
    
}


}
else{
        //cre�ation version
       // $idd_cdv_version = $wpdb->get_results("SELECT ID_cdv_version FROM cdv_version");
        //$id_cdv_version = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version");
        if ($cdv_version_actif == NULL) {
            $deux = (-2);
        $ID_cdv_version = $id_cdv_actif + $deux;
        $reussite = $wpdb->insert('cdv_version', array(
                            'ID_cdv_version' => $ID_cdv_version,
                            'ID_cdv' => $id_cdv_actif
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
                        'ID_cdv' => $id_cdv_actif
                            )
                    );
                if($reussite1)
                {
                       // if(stripcslashes($trp) !=($_POST["profile_titre_recit"])){
						if(empty($trp)){
                        $nouveau_id = $wpdb->insert_id;
                        $reussite = $wpdb->insert(
                                            'cdv_editorial', array(
                                            'ID_cdv' => $id_cdv_actif,
                                            'titlePost' => $_POST["profile_titre_recit"],
                                            'txtPost' => $recit,
                                            'dateDebutPost' => $datedpost,
                                            'dateFinPost' => $datefpost,
                                            'lieuDepPost' => $lieud,
                                            'lieuArrPost' => $destination,
                                            'ordPost'     => $ordre   
                                            ), array(
                                            '%d',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%d' 
                                            )
                                        );
                                        echo 'created';
                        }
                       // else if(stripcslashes($trp) ==($_POST["profile_titre_recit"])){
						else{
                                $reussite = $wpdb->update(
                                                    'cdv_editorial', array(
                                                    'txtPost' => $recit,
                                                    'dateDebutPost' => $datedpost,
                                                    'dateFinPost' => $datefpost,
                                                    'lieuDepPost' => $lieud,
                                                    'lieuArrPost' => $destination
                                                        ), array(
                                                    'titlePost' => $titre_recit,
                                                    'ID_cdv' =>  $id_cdv_actif  
                                                        )
                                );
                                echo 'updated';
                        }
                        
                    
                   // echo 'updated';
                }
        }
        
        
        
        }
        //�dition version
        else {
        
       if($statut == 3){
        $reussite1 = $wpdb->update('cdv', array(
                        'Statut' => 1
                            ), array(
                        'ID_cdv' => $id_cdv_actif
                            )
                    );
        if($reussite1)
        {
                        //if(stripcslashes($trp) !=($_POST["profile_titre_recit"])){
						if(empty($trp)){
                        $nouveau_id = $wpdb->insert_id;
                        $reussite = $wpdb->insert(
                                            'cdv_editorial', array(
                                            'ID_cdv' => $id_cdv_actif,
                                            'titlePost' => $_POST["profile_titre_recit"],
                                            'txtPost' => $recit,
                                            'dateDebutPost' => $datedpost,
                                            'dateFinPost' => $datefpost,
                                            'lieuDepPost' => $lieud,
                                            'lieuArrPost' => $destination,
                                            'ordPost'     => $ordre   
                                            ), array(
                                            '%d',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%d' 
                                            )
                                        );
                                        echo 'created';
                        }
                        //else if(stripcslashes($trp) ==($_POST["profile_titre_recit"])){
						else{
                            
                                $reussite = $wpdb->update(
                                                    'cdv_editorial', array(
                                                    'txtPost' => $recit,
                                                    'dateDebutPost' => $datedpost,
                                                    'dateFinPost' => $datefpost,
                                                    'lieuDepPost' => $lieud,
                                                    'lieuArrPost' => $destination
                                                        ), array(
                                                    'titlePost' => $titre_recit,
                                                    'ID_cdv' =>  $id_cdv_actif  
                                                        )
                                );
                                echo 'updated';
                        }
                   
            
            
            
            
            
           // echo 'updated';
        }
        //}
        }
        else{
            //if(stripcslashes($trp) !=($_POST["profile_titre_recit"])){
			if(empty($trp)){
                        $nouveau_id = $wpdb->insert_id;
                        $reussite = $wpdb->insert(
                                            'cdv_editorial', array(
                                            'ID_cdv' => $id_cdv_actif,
                                            'titlePost' => $_POST["profile_titre_recit"],
                                            'txtPost' => $recit,
                                            'dateDebutPost' => $datedpost,
                                            'dateFinPost' => $datefpost,
                                            'lieuDepPost' => $lieud,
                                            'lieuArrPost' => $destination,
                                            'ordPost'     => $ordre   
                                            ), array(
                                            '%d',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%s',
                                            '%d' 
                                            )
                                        );
                                        echo 'created';
                        }
                      //  else if(stripcslashes($trp) ==($_POST["profile_titre_recit"])){
						else{
                            
                                $reussite = $wpdb->update(
                                                    'cdv_editorial', array(
                                                    'txtPost' => $recit,
                                                    'dateDebutPost' => $datedpost,
                                                    'dateFinPost' => $datefpost,
                                                    'lieuDepPost' => $lieud,
                                                    'lieuArrPost' => $destination
                                                        ), array(
                                                    'titlePost' => $titre_recit,
                                                    'ID_cdv' =>  $id_cdv_actif  
                                                        )
                                );
                                echo 'updated';
                        }
        }
        }
    //echo'vous pouvez pas ajoutez de nouveaux post! ';    
}

    //*************************************

   


// reordonner les postes 

 $resultats = $wpdb->get_results("SELECT  cdv.ID_cdv, titleCdv, titlePost, dateDebutPost, dateFinPost,ID_edito,ordPost,txtPost, lieuDepPost,lieuArrPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user ORDER BY ordPost ASC  ");
                                     
                                    $i =0;
                                    foreach ($resultats as $post) {
                                        
                                        if ($post->dateDebutPost != "0000-00-00") {
                                         
                                            $tab[$i]['dateDebutPost'] = $post->dateDebutPost;
                                            $tab[$i]['dateFinPost'] = $post->dateFinPost;
                                            $tab[$i]['titleCdv'] = $post->titleCdv;
                                            $tab[$i]['titlePost'] = $post->titlePost;
                                            $tab[$i]['txtPost'] = $post->txtPost;
                                            $tab[$i]['ID_cdv'] = $post->ID_cdv;
                                            $tab[$i]['ID_edito'] = $post->ID_edito;
                                            $tab[$i]['lieuDepPost'] = $post->lieuDepPost;
                                            $tab[$i]['lieuArrPost'] = $post->lieuArrPost;
                                        
                                         $i++;
                                        }
                                    
                                    }
                                   
                                    // tri de tableau
                                   
                                    //*****************************************
									 
									function cmpd($a,$b)
									{
										$dateavecajout = date('Y-m-d', strtotime($a['dateDebutPost'] . "+1 days"));
                                        $datefin = date('Y-m-d', strtotime($a['dateFinPost']));
										if($a['dateDebutPost'] == $b['dateDebutPost'])
										{ 
											   
											return 0;
											
										}	
										return $a['dateDebutPost'] >$b['dateDebutPost']?1:-1;
										
									}
									function cmpf($a,$b)
									{
										
										if($a['dateDebutPost'] == $b['dateDebutPost'])
										{ 
											
											
											return $a['dateFinPost'] < $b['dateFinPost']?1:-1;
											
										}	
										return 0;
										
									}
//*****************************************************************									

                                      usort($tab,'cmpd');
									  for ( $ctreg=0; $ctreg < count($tab)-1; $ctreg++) {
										  
										  if($tab[$ctreg]['dateDebutPost'] == $tab[$ctreg+1]['dateDebutPost'])
											{ 
												if(($tab[$ctreg]['dateFinPost']> $tab[$ctreg+1]['dateFinPost'])|| $tab[$ctreg+1]['dateFinPost']=="0000-00-00")
												{
													$x=$tab[$ctreg];
													$tab[$ctreg]=$tab[$ctreg+1];
													$tab[$ctreg+1]=$x;
												}
													
											}
										  
										  
										  
									  }
									  
									  
									  
									  
									 // usort($tab,'cmpf');
                                        $t=count($tab);
                                        foreach ($resultats as $post) {
                                        
                                        if ($post->dateDebutPost == "0000-00-00") {
                                         
                                            $tab[$t]['dateDebutPost'] = $post->dateDebutPost;
                                            $tab[$t]['dateFinPost'] = $post->dateFinPost;
                                            $tab[$t]['titleCdv'] = $post->titleCdv;
                                            $tab[$t]['titlePost'] = $post->titlePost;
                                            $tab[$t]['txtPost'] = $post->txtPost;
                                            $tab[$t]['ID_cdv'] = $post->ID_cdv;
                                            $tab[$t]['ID_edito'] = $post->ID_edito;
                                            $tab[$t]['lieuDepPost'] = $post->lieuDepPost;
                                            $tab[$t]['lieuArrPost'] = $post->lieuArrPost;
                                        
                                         $t++;
                                        }
                                    
                                    }
                                        
                                        
                                   for ($k = 0; $k < count($tab); $k++) {
                                        
                                        $idP = $tab[$k]['ID_cdv'];
                                        
                                        $titlpost = $tab[$k]['titlePost'];
                                        
                                        $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $idP . "' and titlePost='" . $titlpost . "'");
                                       
                                         $reussite1 = $wpdb->update('cdv_editorial', array(
                                                           'ordPost' => ($k+1)
                                                            ), array(
                                                            'ID_edito' => $idedito
                                                            )
                                                            );                    
                                    }       