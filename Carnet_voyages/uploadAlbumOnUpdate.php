<?php

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;

 if(isset($_POST["idcdvactif"]))
 {
     $idcdv=$_POST["idcdvactif"];
 }
 else{
   $idcdv = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
 } 
 
if (isset($_POST["profile_titre_photo_update"]) && isset($_FILES["image"]["type"])) {
   
      

                       $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["image"]["name"]);
                        $file_extension = end($temporary);
                        if ((($_FILES["image"]["type"] == "image/png") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/jpeg")) 
                                && in_array($file_extension, $validextensions)) {
                            if (file_exists("upload/" . $_FILES["image"]["name"])) {
                                echo $_FILES["image"]["name"] . " already exists";
                            } else {
                                if ($_FILES["image"]["type"] == "image/png") {
                                    $extension = ".png";
                                } else if ($_FILES["image"]["type"] == "image/jpg") {
                                    $extension = ".jpg";
                                } else if ($_FILES["image"]["type"] == "image/jpeg") {
                                    $extension = ".jpeg";
                                } else if ($_FILES["image"]["type"] == "image/PNG") {
                                    $extension = ".PNG";
                                } else if ($_FILES["image"]["type"] == "image/JPG") {
                                    $extension = ".JPG";
                                } else if ($_FILES["image"]["type"] == "image/JPEG") {
                                    $extension = ".JPEG";
                                }
                               
                                $idedito = $_POST['idedito']; 
                                $deb1 = $idcdv . $idedito;
                                $nouveaunom = $deb1 . date(Y) . date(m) . date(d) . date(H) . date(i) . date(s) . time(). $extension;
                                $content = explode('/themes',get_template_directory());
                                move_uploaded_file($_FILES["image"]["tmp_name"], getcwd().'/upload/'. $nouveaunom);
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
                                
                                
                              
                                $titleimg = $_POST["profile_titre_photo_update"];
                                $legende = $_POST["profile_legende_update"];
                              $cpt = $wpdb->get_var("SELECT count(nom_fichier) FROM cdv_media WHERE ID_cdv ='" . $idcdv . "' and nom_fichier LIKE '%$deb1%'");
							  
							if($cpt==0){
							  $reussite = $wpdb->insert(
                                        'cdv_media', array(
                                        'ID_cdv' => $idcdv,
										'IsPhotoPrincipal' => 1,
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
                                 $idph = $wpdb->get_var("SELECT ID_media FROM cdv_media where nom_fichier='" . $nouveaunom . "'");
                                 echo $idph;
                             }
                                else {  echo "erreur lors de l'enregistrement de l'image!";}
                            }
                              
                        } else {
                            echo "Invalid Type of FILE";
                        }/*   fin database */
                    }  
					   
 
      
   