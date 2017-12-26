<?php


include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

if(isset($_POST['ID_user'])){
    
     $reussite1 = $wpdb->update('cdv', array(
                    'InscriNewsletter' => 0
                        ), array(
                    'ID_cdv' => $_POST['ID_user']
                        )
                );
}
else if (isset ($_POST['email'])&& isset ($_POST['cdvactif']) )
{
    
    $reussite1 = $wpdb->update('cdv', array(
                    'InscriNewsletter' => 1,
                    'emailContact' =>$_POST['email']
                        ), array(
                    'ID_cdv' => $_POST['cdvactif']
                        )
                );
    
}

