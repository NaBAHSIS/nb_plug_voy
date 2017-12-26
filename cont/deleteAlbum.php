<?php



include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

$titre_recit=$_POST['titre_recit'];
$source=$_POST['file_name'];
$latT=$_POST['lastTitle'];
$latL= $_POST['lastLegende'];
$source = trim($source);
if (isset($_POST['lastTitle'])&& isset($_POST['lastLegende']))
{
$id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
$idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv_actif . "' AND titlePost='" . $titre_recit . "'");


$idphoto = $wpdb->get_var("SELECT ID_media FROM `cdv_media` WHERE nom_fichier='$source' AND ID_cdv='$id_cdv_actif' AND titleImg='".$latT."' AND txtImg='".$latL."' ");

$reussite= $wpdb->delete('cdv_media', array('ID_media' => $idphoto),array('%d'));
    
if($reussite) 
echo("votre photo ". $idphoto."est supprimé avec succès !");
else {
echo("erreur!");
}
}


if(isset($_POST['Supbloc']))
{
    $idphoto = $_POST['Supbloc'];
    $reussite= $wpdb->delete('cdv_media', array('ID_media' => $idphoto),array('%d'));

    if($reussite) 
echo("votre photo ". $idphoto."est supprimé avec succès !");
else {
echo("erreur!");
}

}  