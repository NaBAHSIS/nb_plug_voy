<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
        if(isset($_POST['update'])){
            $titre_recit_ancien = $_POST['profile_titre_recit_ancien'];
            
            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial WHERE titlePost ='".$titre_recit_ancien ."'");
            $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv_editorial WHERE ID_edito ='".$idedito ."'");
           $deb = $idcdv.$idedito;
           $ipt=1;
            $idmedia = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE ID_cdv ='".$idcdv ."' and IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%'");
           
           
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
            $entete = $_POST['entete'];
            $checkbox1 = isset($_POST['profile_checkbox1']) ? 1 : 0;
            $checkbox2 = isset($_POST['profile_checkbox2']) ? 1 : 0;
            $datemod = date(Y.'-'.m.'-'.d);
            $reussite = $wpdb->update('cdv', array(
                'imgCdv' => $entete,
                'titleCdv' => $titre,
              //  'subtitleCdv' => $ss_titre,
                'dateModif' => $datemod,
                'txtIntroCdv' => $pres,
                'copyrightCdv' => $checkbox1,
                'droitUtilisation' => $checkbox2
                    ), array(
                'ID_cdv' => $idcdv
                    )
            );
            $cpt = $wpdb->get_results("SELECT * FROM cdv_media WHERE ID_cdv ='" . $idcdv . "' and nom_fichier LIKE '%$deb%'");
                  /* foreach($cpt as $cp){ 
                    $nf = $wpdb->get_var("SELECT nom_fichier  FROM cdv_media WHERE ID_media='".$cp->ID_media."' and ID_cdv ='" . $idcdv . "' and nom_fichier LIKE '%$deb%'");
                    $longeur=strlen($deb);
                    $rest = substr($nf,$longeur);
                   echo $rest;
                   
                   $newtitle=$idcdv.$titre_recit.$rest;
              //   if(rename("../wp-content/plugins/Carnet_voyages/upload/".$cp->nom_fichier, "../wp-content/plugins/Carnet_voyages/upload/".$newtitle)){
              $reussite = $wpdb->update(
                        'cdv_media', array(
                    'nom_fichier' => $newtitle
                        ), array(
                    'ID_media' => $cp->ID_media,
                    'ID_cdv' => $idcdv
                        )
                );
        }*/
                $reussite = $wpdb->update(
                        'cdv_editorial', array(
                    'titlePost' => $titre_recit,
                    'txtPost' => $recit,
                    'dateDebutPost' => $datedpost,
                    'dateFinPost' => $datefpost,
                    'lieuDepPost' => $lieud,
                    'lieuArrPost' => $destination
                        ), array(
                    'ID_edito'=>$idedito,
                    'ID_cdv' => $idcdv
                        )
                );
                $reussite = $wpdb->update(
                    'cdv_media', array(
                    'titleImg' => $titreimg,
                    'txtImg' => $legende
                    ), array(
                    'ID_media' => $idmedia,
                    'ID_cdv' => $idcdv
                    )
                );              
    header("Location: http://localhost/cdv/wp-admin/admin.php?page=cdv");
            }   
     ?>  

