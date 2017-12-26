<?php
	
	
wp_enqueue_script('customadminjs', get_template_directory_uri() . '/js/admin.js');
wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/custom-script.js');

add_action('admin_menu', 'add_admin_menu');
function add_admin_menu() {
    add_menu_page('Mon carnet', 'Mon carnet', 'contributor', 'carnet', 'menu_html_ajout', 'dashicons-admin-post', 30);
}

function menu_html_ajout() {
    wp_enqueue_media();
    ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6VH6G_0bNHHKfenV6Eo3KWUuL5ozmcpg&callback=initMap"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $(function () {
            $("#popupconfirmation").dialog({
                autoOpen: false,
                width: 400
            });
            $(".boutonsupprimer").click(function (event) {
                event.preventDefault();
                var targetUrl = $(this).attr("href");
                $("#popupconfirmation").dialog({
                    buttons: [
                        {
                            text: "Supprimer",
                            name: 'delete',
                            click: function () {
                                window.location.href = targetUrl;
                            }
                        },
                        {
                            text: "Annuler",
                            click: function () {
                                $(this).dialog("close");
                            }
                        }
                    ]
                });
                $("#popupconfirmation").dialog("open");
            });
        });
    </script>
    <script>
        function calculateRoute(from, to) {
            // Center initialized to Naples, Italy
            var myOptions = {
                zoom: 3,
                center: new google.maps.LatLng(51.50, -0.12),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            // Draw the map
            var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

            var directionsService = new google.maps.DirectionsService();
            var directionsRequest = {
                origin: from,
                destination: to,
                travelMode: google.maps.DirectionsTravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC
            };
            directionsService.route(
                    directionsRequest,
                    function (response, status)
                    {
                        if (status == google.maps.DirectionsStatus.OK)
                        {
                            new google.maps.DirectionsRenderer({
                                map: mapObject,
                                directions: response
                            });
                        } else
                            $("#error").append("Unable to retrieve your route<br />");
                    }
            );
        }

        $(document).ready(function () {
            // If the browser supports the Geolocation API
            if (typeof navigator.geolocation == "undefined") {
                $("#error").text("Your browser doesn't support the Geolocation API");
                return;
            }

            $("#from-link, #to-link").click(function (event) {
                event.preventDefault();
                var addressId = this.id.substring(0, this.id.indexOf("-"));

                navigator.geolocation.getCurrentPosition(function (position) {
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
                    },
                            function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK)
                                    $("#" + addressId).val(results[0].formatted_address);
                                else
                                    $("#error").append("Unable to retrieve your address<br />");
                            });
                },
                        function (positionError) {
                            $("#error").append("Error: " + positionError.message + "<br />");
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 10 * 1000 // 10 seconds
                        });
            });

            $("#calculate-route").click(function (event) {
                event.preventDefault();
                calculateRoute($("#from").val(), $("#to").val());
            });
        });
    </script>

    <div id="wpbody" role="main">
        <div id="wpbody-content" aria-label="Contenu principal" tabindex="0" style="overflow: hidden;">
            <div class="wrap">
                <?php
                global $wpdb;
                global $current_user;
                get_currentuserinfo();
                $user = $current_user->user_login;
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
                $datemod = date('Y-m-d');
                $id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
                //  echo $id_cdv_actif;
                $cdv_version_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv_version) AS cpt FROM cdv, cdv_version WHERE cdv_version.ID_cdv_version = ($id_cdv_actif + (-2)) AND cdv.ID_contact = $user ORDER BY ID_cdv_version DESC");
                $statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $id_cdv_actif ");
            //     if ( $statut != 3) {
				if ($cdv_version_actif == NULL && $statut != 3) {
                    if ($statut == 0) {
                        //statut = 1 et bouton soumettre

                        if (isset($_POST['enregistrer'])) {
                            /*   if (isset($titre_recit) && isset($_POST["radio"])) { */
                            $reussite = $wpdb->update('cdv', array(
                                'Statut' => 1
                                    ), array(
                                'ID_cdv' => $id_cdv_actif
                                    )
                            );
                            if ($reussite) {
                                
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
                                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv_actif . "' AND titlePost='" . $titre_recit . "'");
                                $deb = $id_cdv_actif . $idedito;
                                $selected_radio = $_POST["radio"];
                                $idp = $wpdb->get_results("SELECT ID_cdv FROM cdv_media WHERE nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id_cdv_actif . "' ORDER BY ID_media DESC");
                                foreach ($idp as $p) {
                                    $idph = $p->ID_cdv;
                                    if ($idph == $id_cdv_actif) {
                                        $reussite = $wpdb->update(
                                                'cdv_media', array(
                                            'IsPhotoPrincipal' => 0
                                                ), array(
                                            'ID_cdv' => $idph
                                                )
                                        );
                                    }
                                }
                                $isphotop = $wpdb->get_results("SELECT ID_media FROM cdv_media WHERE ID_media ='" . $selected_radio . "' ORDER BY ID_media DESC");
                                $isidphoto = $wpdb->get_var("SELECT ID_media FROM cdv_media WHERE ID_media = '" . $selected_radio . "' ORDER BY ID_media DESC");
                                if ($selected_radio == $isidphoto) {
                                    $reussite = $wpdb->update(
                                            'cdv_media', array(
                                        'IsPhotoPrincipal' => 1
                                            ), array(
                                        'ID_media' => $isidphoto
                                            )
                                    );
                                }
								/*								$deb=$id_cdv_actif.$idedito;
									$rp = $wpdb->get_var("SELECT ID_media FROM cdv_media WHERE nom_fichier LIKE '%$deb%' and ID_cdv = '" . $id_cdv_actif . "' ORDER BY ID_media DESC");
									if ($selected_radio == "") {
									$reussite = $wpdb->update(
                                            'cdv_media', array(
                                        'IsPhotoPrincipal' => 1
                                            ), array(
                                        'ID_media' => $rp
                                            )
                                    );
								}*/
							   
                            }

                            $titre_recit = "";
                            $_POST["photop"] = "";
                        }
                    }
                } else {
                    //creéation version
                    $idd_cdv_version = $wpdb->get_results("SELECT ID_cdv_version FROM cdv_version");
                    $id_cdv_version = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version");
                    if ($id_cdv_version == null) {
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
                    }
                    //édition version
                    else {
                        $deux = (-2);
                        $idcv = $id_cdv_actif + $deux;

                        $reussite = $wpdb->update('cdv_version', array(
                            'ID_cdv_version' => $idcv
                                ), array(
                            'ID_cdv' => $id_cdv_actif
                                )
                        );
                    }
                    //enregistrement version
                    $reussite = $wpdb->update('cdv', array(
                        'Statut' => 1
                            ), array(
                        'ID_cdv' => $id_cdv_actif
                            )
                    );
                }
                //*************************************
                if ($statut == 1) {
                    //statut = 2 et bouton enregistrer
                    if (isset($_POST['enregistrer'])) {
                        if (isset($titre_recit) && isset($_POST["radio"])) {

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

                            $selected_radio = $_POST["radio"];
					 if(isset($selected_radio)){  
							$idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv_actif . "' AND titlePost='" . htmlentities($titre_recit) . "'");
                            $deb = $id_cdv_actif . $idedito;
                            $idp = $wpdb->get_results("SELECT ID_cdv FROM cdv_media WHERE ID_cdv ='" . $id_cdv_actif . "' AND nom_fichier LIKE %$deb% ORDER BY ID_media DESC");
                            foreach ($idp as $p) {
                                $idph = $p->ID_cdv;
                                if ($idph == $id_cdv_actif) {
                                    $reussite = $wpdb->update(
                                            'cdv_media', array(
                                        'IsPhotoPrincipal' => 0
                                            ), array(
                                        'ID_cdv' => $idph
                                            )
                                    );
                                }
                            }
                            $isphotop = $wpdb->get_results("SELECT ID_media FROM cdv_media WHERE ID_media ='" . $selected_radio . "' ORDER BY ID_media DESC");
                            $isidphoto = $wpdb->get_var("SELECT ID_media FROM cdv_media WHERE ID_media = '" . $selected_radio . "' ORDER BY ID_media DESC");
                            if ($selected_radio == $isidphoto) {
                                $reussite = $wpdb->update(
                                        'cdv_media', array(
                                    'IsPhotoPrincipal' => 1
                                        ), array(
                                    'ID_media' => $isidphoto
                                        )
                                );
                            }
								
					     	}
                        }

                        $titre_recit = "";
                    }
                }
                if (isset($_POST['submit_image']) && isset($_POST["profile_titre_recit"])) {
                    $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                    $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                    $trp = $wpdb->get_var("SELECT DISTINCT titlePost FROM cdv_editorial where titlePost ='". htmlentities($_POST["profile_titre_recit"])."' and  ID_cdv='".$idcdv . "'");

                    if($trp==htmlentities($_POST["profile_titre_recit"])){
                       
                    }else {
                    $nouveau_id = $wpdb->insert_id;
                                $reussite = $wpdb->insert(
                                    'cdv_editorial', array(
                                'ID_cdv' => $idcdv,
                                'titlePost' => $_POST["profile_titre_recit"],
                                    ), array(
                                '%d',
                                '%s'
                                    )
                            );
                                 }
                //    }
                    if (isset($_POST["profile_titre_photo"]) && isset($_FILES["user_image"]["type"])) {
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
                                $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                $titre_recit=$_POST["profile_titre_recit"];
                                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $idcdv . "' AND titlePost='" . $titre_recit . "'");
                               $deb1 = $idcdv . $idedito;
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
                                $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                $titleimg = $_POST["profile_titre_photo"];
                                $legende = $_POST["profile_legende"];
                              /* $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv_actif . "' AND titlePost='" . $titre_recit . "'");
                                $deb = $id_cdv_actif . $idedito;
                                $selected_radio = $_POST["radio"];
                                $idp = $wpdb->get_results("SELECT ID_cdv FROM cdv_media WHERE nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id_cdv_actif . "'");
                                foreach ($idp as $p) {
                                    $idph = $p->ID_cdv;
                                    if ($idph == $id_cdv_actif) {
                                        $reussite = $wpdb->update(
                                                'cdv_media', array(
                                            'IsPhotoPrincipal' => 0
                                                ), array(
                                            'ID_cdv' => $idph
                                                )
                                        );
                                    }
                                }*/
                                $reussite = $wpdb->insert(
                                        'cdv_media', array(
									//	'IsPhotoPrincipal' => 1,
                                    'ID_cdv' => $idcdv,
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
                        }/*   fin database */
                    }
                }
/*}else{?>
			 <div class="alert alert-danger">
    <strong>impossible d\'ajouer dans mon carnet.</strong>
  </div>
<?php }*/
                ?>
                <form action="" method="post" id="post" enctype="multipart/form-data" >
                    <h1>Au sujet de mon carnet de voyage</h1>
                    <p style="border-bottom: 1px solid;"></p>
                    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
                    <script>
        angular.module('app', []).controller('appc', ['$scope', function ($scope) {
                $scope.selected = 'other';
            }]);
                    </script>
                    <script type="text/javascript">
                        function MaxLengthTextarea(objettextarea, maxlength) {
                            if (objettextarea.value.length > maxlength) {
                                objettextarea.value = objettextarea.value.substring(0, maxlength);
                                alert('Votre texte ne doit pas dépasser ' + maxlength + ' caractères!');
                            }
                        }
                    </script>
                    <table class="form-table">
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <label for="profile_titre"><?php _e('Titre du carnet', 'carnet-post-type'); ?>
                                </label><label>*</label><br>
                                <input type="text" name="titre" class="regular-text titleCdv" value="<?php echo $titre; ?>"  >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorTitlecdv"></label>
                            </td>
                        </tr>
                        <?php
                        $resultats = $wpdb->get_results("SELECT libTypeCircuit FROM cdv WHERE ID_contact = $user");
                        foreach ($resultats as $post) {
                            $libtypecircuit = $post->libTypeCircuit;
                        }
                        if ($libtypecircuit == 'Libre & No') {
                            ?>
                            <tr>
                                <td class="carnet_meta_box_td" colspan="2">
                                    <label for="profile_ss_titre"><?php _e('Sous-titre', 'carnet-post-type'); ?>
                                    </label><label style="color: red;">(uniquement si voyage L&N)</label><br>
                                    <input type="text" name="ss_titre" class="regular-text " value="<?php echo $sous_titre; ?>"  >
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <label for="profile_image"><?php _e('Image principale', 'carnet-post-type'); ?>
                                </label><label style="color: #a5a4a4;">(photo d'entete - largeur min 2000px)</label><label> *</label><br>
                                <input type="text" class="regular-text" id="header" name="entete" value="<?php echo get_option('header', ''); ?>"  >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorImgCdv"></label>
                                <a href="#" class="button customaddmedia">Parcourir</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <label for="profile_presentation"><?php _e('Présentation de mon aventure', 'carnet-post-type'); ?>
                                </label><label style="color: #a5a4a4;">(max: 1000 signes)</label><label> *</label><br>
                                <textarea class="presentation" rows="6" name="presentation"  onkeyup="javascript:MaxLengthTextarea(this, 1000);" cols="150" value="<?php echo $presentation; ?>"  >
                                </textarea>
                                <label style="padding: 5px; color: red; font-size: 12px" class="errortxtIntroCdv"></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <input type="checkbox" name="profile_checkbox1" checked="checked" value="<?php echo $checkbox1; ?>"  >
                                Je certifie être l’auteur ou/et avoir les droits d’utilisation des photos qui apparaitront dans mon carnet de voyage<br>
                                <input type="checkbox" name="profile_checkbox2" checked="checked" value="<?php echo $checkbox2; ?>"  >
                                Je souhaite participer au jeu concours (et tenter de gagner un bon d'achat de xxx€) et accepte que mon carnet soit diffusé sur le site de Nomade Aventure    
                            </td>
                        </tr>
                    </table>
                    <h1>Mon récit</h1>
                    <p style="border-bottom: 1px solid;"></p>
                    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
                    <script src="http://malsup.github.com/jquery.form.js"></script> 
					<?php $datedep = $wpdb->get_var("SELECT  dateDepart FROM cdv WHERE ID_contact = $user");
                          $dateret = $wpdb->get_var("SELECT  dateRetour FROM cdv WHERE ID_contact = $user");
                                            ?>
                    <script>
					var min=new Date(<?php echo "'".$datedep."'"; ?>);
					var max=new Date(<?php echo "'".$dateret."'"; ?>);
                                    $(document).ready(function () {
                                        $("#datepickerdebut").datepicker({dateFormat: 'yy-mm-dd',minDate: min,maxDate: max, navigationAsDateFormat: true});
                                    });
                                    $(document).ready(function () {
                                        $("#datepickerfin").datepicker({dateFormat: 'yy-mm-dd',minDate: min,maxDate: max, navigationAsDateFormat: true});
									
                                    $('.presentation').val("");
                                    // script for control required title of album
                                    $(".submit_image").click(function (event) {

                                        if ($('.titleImg').val() == "")
                                        {
                                            $('.errorTitleImg').text('Vous devez saisir le titre de votre album!, Ce champ est obligatoire!')
                                            $('.errorTitleImg').css("display", "block");

                                            event.preventDefault();
                                        } else
                                        {
                                            $('.errorTitleImg').css("display", "none");
                                        }
                                    });
                                    $("#btn_enregistrer").click(function (event) {
                                        verification(event);
										
                                    });
									
                                    $('.div_datepickerfin').css('visibility', 'hidden');
                                    $('.tableLocation').css('visibility', 'hidden');
                                    $('#datepickerdebut').change(function () {
                                        //Change code!
                                        $('.div_datepickerfin').css('visibility', 'visible');
                                        $('.tableLocation').css('visibility', 'visible');
                                        $('.div_to').css('visibility', 'hidden');
                                        $('.div_from').css('visibility', 'visible');
                                    });
                                    $('#datepickerfin').change(function () {
                                        // control of date
                                        $debutPost = $('#datepickerdebut').datepicker('getDate');
                                        $finPost = $('#datepickerfin').datepicker('getDate');
                                        if ($debutPost > $finPost)
                                        {
                                            //alert('debut doit etre inf');
                                            $('.errordateFin').text('La date doit etre supérieur au date debut!');
                                            $('.errordateFin').css("display", "block");
                                            $('#datepickerfin').val("");
                                        } else
                                        {
                                            $('.errordateFin').css("display", "none");
                                        }
                                    });
                                    // control of depart and destination
                                    $('#from').change(function () {
                                        //Change code!
                                        if ($(this).val() != "") {
                                            $('.div_to').css('visibility', 'visible');
                                        }
                                    });
                                    // btn publier carnet 
                                    $('#btn_publier').click(function (e) {
                                        // AU SUJET DE MON CARNET DE VOYAGE
                                        $titlecdv = $('.titleCdv').val();
                                        $imgCdv = $('#header').val();
                                        $introCdv = $('.presentation').val();
                                        var statverif = true;
                                        if ($titlecdv == "")
                                        {
                                            $('.errorTitlecdv').text('Vous devez saisir le titre de Poste!, Ce champ est obligatoire!');
                                            $('.errorTitlecdv').css("display", "block");
                                            statverif = false;
                                            event.preventDefault();
                                        } else
                                        {
                                            $('.errorTitlecdv').css("display", "none");
                                            statverif = true;
                                        }
                                        if ($imgCdv == "")
                                        {
                                            $('.errorImgCdv').text('choisissez une image, Ce champ est obligatoire!');
                                            $('.errorImgCdv').css("display", "block");
                                            statverif = false;
                                            event.preventDefault();
                                        } else
                                        {
                                            $('.errorImgCdv').css("display", "none");
                                            statverif = true;
                                        }
                                        if ($introCdv == "")
                                        {
                                            $('.errortxtIntroCdv').text('Vous devez saisir une presentation!, Ce champ est obligatoire!');
                                            $('.errortxtIntroCdv').css("display", "block");
                                            statverif = false;
                                            event.preventDefault();
                                        } else
                                        {
                                            $('.errortxtIntroCdv').css("display", "none");
                                            statverif = true;
                                        }
                                        var formData = $("#post").serialize();
                                        $.ajax({
                                            url: '../wp-content/plugins/Carnet_voyages/publier.php',
                                            type: 'POST',
                                            data: formData,
                                            success: function (result_href, statut) { // success est toujours en place, bien sûr !
                                                if (result_href != "")
                                                {
                                                    $('.errorTitlecdv').parent().append('<p style="display: block;"><span style="float: left;">Permalien :  </span><span><a target="_blank" href="' + result_href + '" style="display: block; font-size=14 ">' + result_href + '</a></span></p>');
                                                }

                                                $('html, body').animate({scrollTop: 0}, 'slow');
                                            },
                                            error: function (resultat, statut, erreur) {
                                                alert(erreur);
                                            }
                                        });
                                        e.preventDefault();
                                    });
                                    // fonction de controle et vérification des champs du formulaire
                                    function verification(event)
                                    {   
                                        // Mon recit
                                        $title = $('.titlePost').val();
                                        //title POst
                                        if ($title == "")
                                        {
                                            $('.errorTitlePost').text('Vous devez saisir le titre de Poste!, Ce champ est obligatoire!')
                                            $('.errorTitlePost').css("display", "block");
                                            statverif = false;
                                            event.preventDefault();
                                        } else
                                        {
                                            $('.errorTitlePost').css("display", "none");
                                            statverif = true;
                                        }
                                        return statverif;
                                    }
     });
                    </script>
                    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                    <script>tinymce.init({selector: '#recit'});</script>
                    <style>
                        #mceu_12
                        {
                            display: none;
                        }
                        input[type="file"] {
                            height: 0;
                            width: 0;
                            overflow: hidden;
                        }

                        input[type="file"] + label {
                            border: 1px solid rgba(0,0,0,.2);
                            padding: 5px;
                            background: lavender;
                        }
                    </style>
                    <table width="100%" >
                        <?php
                        $resultats = $wpdb->get_results("SELECT  cdv.ID_cdv, titleCdv, titlePost, dateModif, dateDebutPost, dateFinPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user ORDER BY dateDebutPost DESC  ");
                        $i = 0;
                        foreach ($resultats as $post) {
                            if ($post->dateDebutPost != "0000-00-00") {
                                $tab[$i]['dateDebutPost'] = $post->dateDebutPost;
                                $tab[$i]['dateFinPost'] = $post->dateFinPost;
                                $tab[$i]['titleCdv'] = $post->titleCdv;
                                $tab[$i]['titlePost'] = $post->titlePost;
                                $tab[$i]['dateModif'] = $post->dateModif;
                                $tab[$i]['titlePost'] = $post->titlePost;
                                $tab[$i]['ID_cdv'] = $post->ID_cdv;
                            }
                            $i++;
                        }
                        for ($j = 0; $j <= count($tab); $j++) {
                            $dateavecajout = date('Y-m-d', strtotime($tab[$j]['dateDebutPost'] . "+1 days"));
                            $datefin = date('Y-m-d', strtotime($tab[$j]['dateFinPost']));

                            if ($datefin != 0) {
                                if ($dateavecajout < $datefin) {
                                    if ((date('Y-m-d', strtotime($tab[$j + 1]['dateDebutPost'])) > date('Y-m-d', strtotime($tab[$j]['dateDebutPost'])))) {
                                        $x[0] = $tab[$j];
                                        $tab[$j] = $tab[$j + 1];
                                        $tab[$j + 1] = $x[0];
                                    }
                                }
                            }
                        }
                        for ($k = 0; $k < count($tab); $k++) {
                            $datepp = $tab[$k]['dateDebutPost'];
                            $datefp = $tab[$k]['dateFinPost'];
                            $title = $tab[$k]['titlePost'];
                            $idP = $tab[$k]['ID_cdv'];
                            $nice_date = date('d F', strtotime($datepp));
                            $titlpost = $tab[$k]['titlePost'];
                            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $idP . "' and titlePost='" . $titlpost . "'");
                            $deb = $idP . $idedito;
                            $ipt = 1;
                            $pp = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $idP . "'");
                            ?>
                            <tr class="draggable" draggable="true" ondragstart="drag(event)" width="100%" style="height: 30px; background: #000; color: #fff;">
                                <td class="pres" style="float: left;"><img src="../wp-content/plugins/Carnet_voyages/img/u20.png">&nbsp;&nbsp;<?php echo $nice_date . ' - ' . $titlpost; ?> </td>
                                <td style="float: right;">
                                    <a href="../wp-content/plugins/Carnet_voyages/update.php?postID=<?php echo $idP; ?>&idedt=<?php echo $idedito; ?>" style="color: #fff;">
                                        <span class="dashicons dashicons-welcome-write-blog" name="update"></span></a>
                                    <span class="dashicons dashicons-menu"></span>
                                    <a href="../wp-content/plugins/Carnet_voyages/suppression.php?postID=<?php echo $idP; ?>&idedt=<?php echo $idedito; ?>" style="color: #fff;" class="lienstylebouton boutonsupprimer" name="ddelete"><span class="dashicons dashicons-no"></span></a>
                                    <div id="popupconfirmation" title="Confirmation du suppression" style="display: none;">
                                        <p>Êtes-vous sûr de vouloir supprimer ce post ?</p>
                                    </div>                            
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr  width="100%" style="height: 30px; background: #000; color: #fff;">
                            <td style="float: left;"><span class="dashicons dashicons-controls-play"></span>&nbsp;&nbsp;Nouveau post</td>
                            <td style="float: right;">
                                <span class="dashicons dashicons-menu"></span>
                                <a href="" style="color: #fff;"><span class="dashicons dashicons-no"></span></a>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td>
                                <table class="form-table">
                                    <tr>
                                        <td class="carnet_meta_box_td" colspan="1">
                                            <label for="profile_dated"><?php _e('Date de l\'étape', 'carnet-post-type'); ?>
                                            </label><br>
                                            <input id="datepickerdebut" name="profile_dated" value="<?php echo $datedeb; ?>"><img style="position: absolute;" src="../wp-content/plugins/Carnet_voyages/img/u54.png">
                                       
										<input type="hidden" id="datedep" name="datedep" value="<?php echo $datedep; ?>">
                                        </td>
                                        <td class="carnet_meta_box_td div_datepickerfin" colspan="1">
                                            <label for="profile_datef"><?php _e('Date de fin', 'carnet-post-type'); ?>
                                            </label><br>
                                            <input id="datepickerfin" name="profile_datef" value="<?php echo $datef; ?>"><img style="position: absolute;" src="../wp-content/plugins/Carnet_voyages/img/u54.png">
                                       <input type="hidden" id="dateret" name="dateret" value="<?php echo $dateret; ?>">
										</td>
                                    </tr>
                                    <tr> <label style="padding: 5px; color: red; font-size: 12px" class="errordateFin"></label></tr>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <label for="profile_titre_recit"><?php _e('Titre', 'carnet-post-type'); ?>
                                </label><label>*</label><br>
                                <input type="text" name="profile_titre_recit" size="30" class="regular-text titlePost" value="<?php echo $titre_recit; ?>" >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorTitlePost"></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                                <label for="profile_recit"><?php _e('Récit', 'carnet-post-type'); ?>
                                </label><br>
                                <textarea rows="10" name="profile_recit" id="recit" value="<?php echo $txt_recit; ?>"></textarea>

                            </td>
                        </tr>
                        <tr>
                            <td class="carnet_meta_box_td" colspan="2">
                            </td>
                        </tr>
                    </table>
                    </td>
                    <td>
                        <table class="tableLocation" style="background: #fff;">
                            <tr>
                                <td class="carnet_meta_box_td div_from" colspan="2">
                                    <label for="profile_lieud"><?php _e('Lieu (ou point de départ)', 'carnet-post-type'); ?>
                                    </label><br>
                                    <input id="from" type="text" name="profile_lieud" size="30" class="regular-text" value="<?php echo $lieu; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="carnet_meta_box_td div_to" colspan="2">
                                    <label for="profile_destination"><?php _e('Destination', 'carnet-post-type'); ?>
                                    </label><br>
                                    <input id="to" type="text" name="profile_destination" size="30" class="regular-text" value="<?php echo $destination; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input id="calculate-route" type="submit" />
                                    <input type="reset" />
                                </td>
                            </tr>
                            <tr>
                                <td class="carnet_meta_box_td" colspan="2">
                                    <div class="map" id="map" style="height: 350px;"></div>
                                    <p id="error"></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    </tr>
                    </table>
                    <h1>Album photo</h1>
                    <p style="border-bottom: 1px dotted;"></p>
                    <table class="form-table" style="border-bottom: 1px dotted;">
                        <tr>
                            <td>
                                <label for="profile_album"><?php _e('Album photo', 'carnet-post-type'); ?></label><br>
                                <input type="text" class="regular-text " name="options[album]" value="" >
                                <input type="file" id="file" name="user_image" multiple/><label for="file">Parcourir</label><br>
                                <label for="profile_titre_photo"><?php _e('Titre de la photo', 'carnet-post-type'); ?>
                                </label><label>*</label><br>
                                <input type="text" name="profile_titre_photo" size="30" class="regular-text titleImg" value="<?php echo $titre_photo; ?>" >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorTitleImg"></label>
                                <br>
                                <label for="profile_legende"><?php _e('Légende de la photo', 'carnet-post-type'); ?>
                                </label><br>
                                <textarea rows="4" cols="53" name="profile_legende" class="" value="<?php echo $legende; ?>"></textarea><br><br>
                                <input type="submit" class="submit_image" name='submit_image' id="imageenrg" value="Enregistrer"/>
                            </td>
                        </tr>

                    </table>
                    <style>
                        div.img {
                            margin: 5px;
                            border: 1px solid #ccc;
                            float: left;
                            width: 100px;
                            height:100px;

                        }
                        div.img:hover {
                            border: 1px solid #777;
                        }
                        div.img img {
                            width: 100%;
                            height: auto;
                        }
                        div.desc {
                            padding: 15px;
                            text-align: center;
                        }
                    </style>
                    <table>
                        <tr>
                            <td>
                                <?php
                                if ($titre_recit != "") {
                                    $result = $wpdb->get_results("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                    $idcdv = $wpdb->get_var("SELECT ID_cdv FROM cdv where ID_contact='" . $user . "'");
                                    $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $idcdv . "' AND titlePost='" . htmlentities($titre_recit) . "'");
                                       $deb = $idcdv . $idedito;
                                    $results = $wpdb->get_results("SELECT * FROM cdv_media where ID_cdv='" . $idcdv . "' and nom_fichier LIKE '%$deb%'  order by ID_media  DESC LIMIT 6  ");
                                    foreach ($results as $posts) {
                                        ?>
                                        <div class="img">
                                            <?php
                                            $file = $posts->nom_fichier;
                                            echo '<img name="photop" src="../wp-content/plugins/Carnet_voyages/upload/' . $file . '"/>';
                                            ?>
                                            <input id="radio" type="radio" name="radio"  class="radio" value="<?php echo $posts->ID_media; ?>" />Photo principale</div>
                                        

                                        <?php
                                    } echo '<label style="padding: 5px; color: red; font-size: 12px" class="errorRadio"></label>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr><td style="height: 50px;"></td></tr>
                        <tr>
                            <td>
                                <input id="btn_enregistrer" type="submit" value="Enregistrer et ajouter un nouveau post" name="enregistrer">
                                <input id="btn_publier" type="submit" value="Publier dans mon carnet" name="publier">
                            </td>
                        </tr>
                    </table>
                    <h1>Mes posts non-datés (apparaitront à la fin de mon carnet)</h1>
                    <p style="border-bottom: 1px dotted;"></p>
                    <table width="100%">
                        <?php
                        $resultats = $wpdb->get_results("SELECT cdv.ID_cdv, titlePost, dateDebutPost, ID_edito FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND  ID_contact = $user  ");
                        foreach ($resultats as $post) {
                            if ($post->dateDebutPost == "0000-00-00") {
								$idedito=$post->ID_edito;
								$idP=$post->ID_cdv;
								$deb = $idP . $idedito;
                                $ipt = 1;
                                $pp = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $idP . "'");
                               
                                ?>
                                <tr class="draggable" draggable="true" ondragstart="drag(event)" width="100%" style="height: 30px; background: #000; color: #fff;">
                                    <td class="pres" style="float: left;"><span class="dashicons dashicons-controls-play"></span>&nbsp;&nbsp;<?php echo $post->titlePost; ?> </td>
                                    <td style="float: right;">
                                    <a href="../wp-content/plugins/Carnet_voyages/update.php?postID=<?php echo $idP; ?>&idedt=<?php echo $idedito; ?>" style="color: #fff;">
                                        <span class="dashicons dashicons-welcome-write-blog" name="update"></span></a>
                                    <span class="dashicons dashicons-menu"></span>
                                    <a href="../wp-content/plugins/Carnet_voyages/suppression.php?postID=<?php echo $idP; ?>&idedt=<?php echo $idedito; ?>" style="color: #fff;" class="lienstylebouton boutonsupprimer" name="ddelete"><span class="dashicons dashicons-no"></span></a>
                                    <div id="popupconfirmation" title="Confirmation du suppression" style="display: none;">
                                        <p>Êtes-vous sûr de vouloir supprimer ce post ?</p>
                                    </div>                            
                                </td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                    </table>
                </form>
<?php 
				?>
            </div>
        </div>
    </div>
    <?php
}

?>