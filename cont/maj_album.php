   <?php 
   include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb; 
//$ID_Post = $_GET['postID'];
//$idedito = $_GET['idedt'];
//$id_media = $_GET['id_media']; 
//$titre_post = $wpdb->get_var("SELECT titlePost FROM cdv_editorial  WHERE ID_edito='" . $idedito . "'");
//$tit = $wpdb->get_var("SELECT titlePost FROM cdv_editorial  WHERE ID_edito='" . $idedito . "'");
 echo "test vrai";
			/*		$titre_recit_ancien = $_POST['profile_titre_recit_ancien'];
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
								header("Location: http://dev-blog.nomade-aventure.com/wp-content/plugins/Carnet_voyages/update.php?postID=$ID_Post&id_media=$pp&idedt=$idedito");
				  
                            }
                        } else {
                            echo "<span>*** Invalid Type of FILE ***<span>";
                        }
                    }	
	*/
								?>
