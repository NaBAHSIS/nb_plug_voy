
<?php


include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
if(isset($_POST['submit_image'])){
	
					$titre_recit_ancien = htmlentities($_POST['profile_titre_recit_ancien']);
                    $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial WHERE titlePost ='".$titre_recit_ancien ."'");
                    $ID_Post = $wpdb->get_var("SELECT ID_cdv FROM cdv_editorial WHERE ID_edito ='".$idedito ."'");
                    $deb1 = $ID_Post . $idedito;
                    $ipt = 1;
                    $pp = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb1%' and ID_cdv ='" . $ID_Post . "'");
                    $id_media=$pp;
					
					$trp = $wpdb->get_var("SELECT DISTINCT titlePost FROM cdv_editorial where titlePost ='". htmlentities($_POST["profile_titre_recit"])."' and  ID_cdv='".$ID_Post . "'");
                    if($trp==htmlentities($_POST["profile_titre_recit"])){
                    }else {
                                $reussite = $wpdb->update(
                                    'cdv_editorial', array(
                                'titlePost' => $_POST["profile_titre_recit"]
                                    ), array(
                                'ID_cdv' => $ID_Post,
                                'ID_edito' => $idedito
                                    )
                            );
                                 }
                    if (isset($_FILES["user_image"]["type"])) {
                        $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["user_image"]["name"]);
                        $file_extension = end($temporary);
                        if ((($_FILES["user_image"]["type"] == "image/png") || ($_FILES["user_image"]["type"] == "image/jpg") || ($_FILES["user_image"]["type"] == "image/jpeg")) 
                                && in_array($file_extension, $validextensions)) {
                            if (file_exists("upload/" . $_FILES["user_image"]["name"])) {
                                echo $_FILES["user_image"]["name"] . " <b>already exists.</b> ";
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
                              $deb1 = $ID_Post . $idedito;
                                $nouveaunom = $deb1 . date(Y) . date(m) . date(d) . date(H) . date(i) . date(s) . time() . $extension;
                                move_uploaded_file($_FILES["user_image"]["tmp_name"], "../wp-content/plugins/Carnet_voyages/upload/" . $nouveaunom);
                                $type = wp_check_filetype($nouveaunom);
                                $ImageFolder = '../wp-content/plugins/Carnet_voyages/upload/';
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
                                        $image = imagecreatefromgif($source);
                                    elseif ($info['mime'] == 'image/jpg')
                                        $image = imagecreatefromjpeg($source);
                                    imagejpeg($image, $destination, $quality);
                                    return $destination;
                                }

                                $source_img = $ImageFolder . $nouveaunom;
                                $destination_img = $ImageFolder . $nouveaunom;
                                $file = compress($source_img, $destination_img, $quality);
                                //fin optimiser image 60%
                                // *** Include the class
                                include("resize-class.php");
                                // *** 1) Initialize / load image
                                $resizeObj = new resize($ImageFolder . $nouveaunom);
                                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
                                $resizeObj->resizeImage(1000, 1000, 'crop');
                                // *** 3) Save image
                                $resizeObj->saveImage($ImageFolder . $nouveaunom, 60);
                                //fin resize image
					
                                $titleimg = $_POST["profile_titre_photo"];
                                $legende = $_POST["profile_legende"];
                               
                                $reussite = $wpdb->insert(
                                        'cdv_media', array(
                                    'ID_cdv' => $ID_Post,
                                    'titleImg' => $titreimg,
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
                        } else {
                            echo "<span>*** Invalid Type of FILE ***<span>";
                        }
                    }	
	header("Location: http://dev-blog.nomade-aventure.com/wp-content/plugins/Carnet_voyages/update.php?postID=$ID_Post&id_media=$pp&idedt=$idedito");
				  
}
        if(isset($_POST['submit'])){
            $titre_recit_ancien = $_POST['profile_titre_recit_ancien'];
            
            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial WHERE titlePost ='".$titre_recit_ancien ."'");
            $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv_editorial WHERE ID_edito ='".$idedito ."'");
           $deb = $idcdv.$idedito;
           $ipt=1;
            $idmedia = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE ID_cdv ='".$idcdv ."' and IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%'");
           
            $titre = $_POST['titre'];
            $ss_titre = $_POST['ss_titre'];
            $pres = $_POST['presentation'];
            $entete = $_POST['entete'];
            $checkbox1 = isset($_POST['profile_checkbox1']) ? 1 : 0;
            $checkbox2 = isset($_POST['profile_checkbox2']) ? 1 : 0;
            $datedpost = $_POST['profile_dated'];
            $datefpost = $_POST['profile_datef'];
            $titre_recit = $_POST['profile_titre_recit'];
            $recit = $_POST['profile_recit'];
            $lieud = $_POST['profile_lieud'];
            $destination = $_POST['profile_destination'];
            $titreimg = $_POST['profile_titre_photo'];
            $legende = $_POST['profile_legende'];
          
   		    $resultats = $wpdb->get_results("SELECT idTypeCircuit FROM cdv WHERE ID_cdv ='".$ID_Post."'");
                foreach ($resultats as $post) {
                $idtypecircuit = $post->idTypeCircuit;
                }
                if ($idtypecircuit == 3) {
            $reussite = $wpdb->update('cdv', array(
                'imgCdv' => $entete,
                'titleCdv' => $titre,
                'subtitleCdv' => $ss_titre,
                'dateModif' => $datemod,
                'txtIntroCdv' => $pres,
                'copyrightCdv' => $checkbox1,
                'droitUtilisation' => $checkbox2
                    ), array(
                'ID_cdv' => $idcdv
                    )
            );
				}else{
					$reussite = $wpdb->update('cdv', array(
                'imgCdv' => $entete,
                'titleCdv' => $titre,
               // 'subtitleCdv' => $ss_titre,
                'dateModif' => $datemod,
                'txtIntroCdv' => $pres,
                'copyrightCdv' => $checkbox1,
                'droitUtilisation' => $checkbox2
                    ), array(
                'ID_cdv' => $idcdv
                    )
            );
				}
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
               $selected_radio = $_POST["radio"];
                            $idp = $wpdb->get_results("SELECT * FROM cdv_media WHERE nom_fichier LIKE '%$deb%' and ID_cdv ='" . $idcdv . "' ORDER BY ID_media DESC");
                            foreach ($idp as $p) {
                                $idph = $p->ID_media;
                                    $reussite = $wpdb->update(
                                            'cdv_media', array(
                                        'IsPhotoPrincipal' => 0
                                            ), array(
                                        'ID_media' => $idph
                                            )
                                    );
                                
                            }
							
                                $reussite = $wpdb->update(
                                        'cdv_media', array(
                                    'IsPhotoPrincipal' => 1
                                        ), array(
                                    'ID_media' => $selected_radio
                                        )
                                );
								$reussite = $wpdb->update(
                                    'cdv_media', array(
                                    'titleImg' => $titreimg,
                                    'txtImg' => $legende
                                    ), array(
                                    'ID_media' => $selected_radio,
                                    'ID_cdv' => $idcdv
                                    )
                                );  
                            
                 
    header("Location: http://dev-blog.nomade-aventure.com/wp-admin/admin.php?page=carnet");
            }   
     ?>  


