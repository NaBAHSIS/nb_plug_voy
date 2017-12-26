<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

$id=$_POST['idedito'];

 $resultats = $wpdb->get_results("SELECT  * FROM  cdv_editorial WHERE ID_edito=$id");
                                     
                                  
 echo (json_encode($resultats));
                                    