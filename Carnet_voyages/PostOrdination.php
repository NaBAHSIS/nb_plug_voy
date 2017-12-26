<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;
$OrdPost = $_POST['newpos'];
$lastpos=$_POST['lastpos']; 
$id_edito= $_POST['IDedito'];
$id_de_remp= $_POST['idremp'];
 
//*************************************
  
if (isset($OrdPost)&& isset($lastpos)&& isset($id_edito)&& isset($id_de_remp)) {
    
     $cdv_actif=$wpdb->get_var("SELECT  ID_cdv FROM  cdv_editorial where ID_edito =".$id_edito); 
     $resultatdropped = $wpdb->get_results("SELECT  dateDebutPost, dateFinPost,ordPost,titlePost FROM  cdv_editorial WHERE ID_edito =".$id_edito);
     $resultatremplaçant = $wpdb->get_results("SELECT  dateDebutPost, dateFinPost,ordPost FROM  cdv_editorial WHERE ID_edito =".$id_de_remp);                          
     $lastord = $wpdb->get_var("SELECT  ordPost FROM  cdv_editorial where ID_cdv=$cdv_actif ORDER BY ordPost DESC limit 1 "); 

  
     foreach ($resultatdropped as $post) {
             
         $dateDropped=$post->dateDebutPost; 
         $datefinDropped=$post->dateFinPost;
         $NOM_DU_POST=$post->titlePost; 
         $dropped_in_ord=$post->ordPost;
        }
    foreach ($resultatremplaçant as $post) {
            
         $dateremplaçant=$post->dateDebutPost;
		 $datefinremplaçant=$post->dateFinPost;
    }
    
    $resultall = $wpdb->get_results("SELECT  * FROM  cdv_editorial WHERE ID_cdv=$cdv_actif AND ordPost<$dropped_in_ord AND ordPost >=".$OrdPost); 
    $resultalldec = $wpdb->get_results("SELECT  * FROM  cdv_editorial where ID_cdv=$cdv_actif  AND ordPost>".$dropped_in_ord ); 
    $resultbetwin = $wpdb->get_results("SELECT  * FROM  cdv_editorial where ID_cdv=$cdv_actif AND ordPost <$OrdPost AND ordPost >=".$dropped_in_ord );     
    if ($dateremplaçant == $dateDropped) {
        if($dateDropped == "0000-00-00")
        {
           if($OrdPost==$lastord){
          
               foreach ($resultalldec as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                    );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
               
           }else{
            
               if($OrdPost <$dropped_in_ord){
                foreach ($resultall as $post) {
                  
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost+1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                     
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
           }
           else if($OrdPost >$dropped_in_ord){
              
                foreach ($resultbetwin as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
           }
           }
              
           
        }
        elseif ($dateDropped != "0000-00-00") {
            
             if($datefinDropped !="0000-00-00" || $datefinDropped < $datefinremplaçant){
               echo "vous ne pouvez pas déplacer $NOM_DU_POST à cet endroit car cela ne respecte pas la chronologie des événements. Nous vous suggérons de vérifier les dates des publications concernées, puis de réessayer";    
             }
             else{   
              if($OrdPost==$lastord){
               foreach ($resultalldec as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
               
           }else{
         
                if($OrdPost <$dropped_in_ord){
                foreach ($resultall as $post) {
            
                   
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost+1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                   
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
           }
           else if($OrdPost <$dropped_in_ord){
              
                foreach ($resultbetwin as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
           }
           }
        }  
        }    
        
    }
	elseif ($dateDropped == "0000-00-00"  && (strtotime($dateDropped) < strtotime($dateremplaçant))){
		
         
            
              if($OrdPost==$lastord){
               foreach ($resultalldec as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
               
           }else{
             
                if($OrdPost <$dropped_in_ord){
                foreach ($resultall as $post) {
            
                   
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost+1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                   
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
           }
           else if($OrdPost <$dropped_in_ord){
              
                foreach ($resultbetwin as $post) {
            
                    $reussite2 = $wpdb->update('cdv_editorial', array(
                    'ordPost' =>  ($post->ordPost-1)
                        ), array(
                    'ID_edito' => $post->ID_edito
                        )
                );
                }
                 $reussite1 = $wpdb->update('cdv_editorial', array(
                    'ordPost' => $OrdPost
                        ), array(
                    'ID_edito' => $id_edito
                        )
                );
               
           }
           }
        
            
            
            
	}
    elseif ((strtotime($dateDropped) > strtotime($dateremplaçant))&&$lastpos<$OrdPost  && $dateDropped != "0000-00-00") {
           echo "vous ne pouvez pas déplacer $NOM_DU_POST à cet endroit car cela ne respecte pas la chronologie des événements. Nous vous suggérons de vérifier les dates des publications concernées, puis de réessayer"; 
    }
    elseif ((strtotime($dateDropped) > strtotime($dateremplaçant))&&$lastpos>$OrdPost && $dateDropped != "0000-00-00"  ) {
           echo "vous ne pouvez pas déplacer $NOM_DU_POST à cet endroit car cela ne respecte pas la chronologie des événements. Nous vous suggérons de vérifier les dates des publications concernées, puis de réessayer"; 
        
    }
    elseif ((strtotime($dateDropped) < strtotime($dateremplaçant))&& $dateDropped =="0000-00-00" ) {
           echo "vous ne pouvez pas déplacer $NOM_DU_POST à cet endroit car cela ne respecte pas la chronologie des événements. Nous vous suggérons de vérifier les dates des publications concernées, puis de réessayer"; 
    }
    elseif ((strtotime($dateDropped) < strtotime($dateremplaçant))&& $dateDropped !="0000-00-00" ) {
           echo "vous ne pouvez pas déplacer $NOM_DU_POST à cet endroit car cela ne respecte pas la chronologie des événements. Nous vous suggérons de vérifier les dates des publications concernées, puis de réessayer"; 
    }
  
    
    
            
                
                
}


?>     