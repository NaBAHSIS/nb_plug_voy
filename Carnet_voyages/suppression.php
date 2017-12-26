<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
$idedito = $_GET['idedt'];
$titlepost = $wpdb->get_var("SELECT titlePost FROM cdv_editorial  WHERE ID_edito='" . $idedito . "'");
$idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv_editorial WHERE ID_edito='" . $idedito . "'");
 $deb=$idcdv.$idedito;
    $res = $wpdb->get_results("SELECT * FROM cdv_media WHERE nom_fichier LIKE '%$deb%' and ID_cdv='".$idcdv."' ORDER BY ID_media DESC");
    foreach($res as $post){
   $wpdb->delete('cdv_media', array('ID_media' => $post->ID_media),array('%d'));
    }
    $wpdb->delete('cdv_editorial', array('ID_edito' => $idedito),array('%d')); 
    echo("<h2>votre recit est supprimé avec succès !</h2>");
   
   header("Location: http://dev-blog.nomade-aventure.com/wp-admin/admin.php?page=carnet");

