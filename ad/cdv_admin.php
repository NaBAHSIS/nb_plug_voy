<?php
/* Plugin Name: Carnet des voyages pour l'admin
 * Plugin URI: http://www.myplugin.com/
 * Description: Plugin pour l'affichage des CDV Admin.
 * Version: 1.0
 * Author: IFMED
 * Author URI: http://ifmed.net
 * License: 
 */
add_action('admin_menu', 'add_admin_menu_cdv');
?>
<?php

function add_admin_menu_cdv() {
    add_menu_page('Liste CDV', 'Liste CDV', 'manage_options', 'cdv', 'menu_html_liste', 'dashicons-admin-post', 30);
}

function menu_html_liste() {
    global $wpdb;
    ?>
    <style>
        #nav {
            position:relative;
            margin:0 auto;
        }

        ul#navigation {
            margin:0px auto;
            position:relative;
            float:left;
            border-left:1px solid #c4dbe7;
            border-right:1px solid #c4dbe7;
        }

        ul#navigation li {
            display:inline;
            font-size:16px;
            font-weight:normal;
            margin:0;
            padding:0;
            float:left;
            position:relative;
            border-top:1px solid #c4dbe7;
            border-bottom:2px solid #c4dbe7;
        }

        ul#navigation li a {
            padding:10px 25px;
            color:#616161;
            text-shadow:1px 1px 0px #fff;
            text-decoration:none;
            display:inline-block;
            border-right:1px solid #fff;
            border-left:1px solid #C2C2C2;
            border-top:1px solid #fff;
            background: #f5f5f5;

            -webkit-transition:color 0.2s linear, background 0.2s linear;	
            -moz-transition:color 0.2s linear, background 0.2s linear;	
            -o-transition:color 0.2s linear, background 0.2s linear;	
            transition:color 0.2s linear, background 0.2s linear;	
        }

        ul#navigation li a:hover {
            background:#f8f8f8;
            color:#282828;
        }

        ul#navigation li:hover > a {
            background:#fff;
        }

        /* Drop-Down Navigation */
        ul#navigation li:hover > ul
        {
            visibility:visible;
            opacity:1;
        }

        ul#navigation ul, ul#navigation ul li ul {
            list-style: none;
            margin: 0;
            padding: 0;    
            visibility:hidden;
            position: absolute;
            z-index: 99999;
            width:400px;
            background:#f8f8f8;
            box-shadow:1px 1px 3px #ccc;
            opacity:0;
            -webkit-transition:opacity 0.2s linear, visibility 0.2s linear; 
            -moz-transition:opacity 0.2s linear, visibility 0.2s linear; 
            -o-transition:opacity 0.2s linear, visibility 0.2s linear; 
            transition:opacity 0.2s linear, visibility 0.2s linear; 	
        }

        ul#navigation ul {
            top: 43px;
            left: 1px;
        }

        ul#navigation ul li ul {
            top: 0;
            left: 181px;
        }

        ul#navigation ul li {
            clear:both;
            width:100%;
            border:0 none;
            border-bottom:1px solid #c9c9c9;
            color:black;
        }

        ul#navigation ul li a {
            background:none;
            padding:7px 45px;
            color:#616161;
            text-shadow:1px 1px 0px #fff;
            text-decoration:none;
            display:inline-block;
            border:0 none;
            float:right;
            clear:both;
            width:20px;
        }

        ul#navigation li a.first {
            border-left: 0 none;
        }

        ul#navigation li a.last {
            border-right: 0 none;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <div class="wrap">
        <h2>Liste des CDV</h2><br>
        <table class="table table-inverse" cellspacing="0">
            <tbody class="list:fields field-list dropdown">
                <?php
                $tableau = $wpdb->get_results("SELECT ID_cdv, titleCdv, prenomClient, Statut FROM cdv where Statut = 2 OR Statut = 3 ORDER BY dateModif DESC");
                if (!empty($tableau)) {
                    foreach ($tableau as $tableau) {
                        $title = $tableau->titleCdv;
                        $id_cdv = $tableau->ID_cdv;
                        $stat = $tableau->Statut;
                        $prenom = $tableau->prenomClient;
                        $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                        $tab = $wpdb->get_var("SELECT titlePost from cdv_editorial where ID_cdv='" . $id_cdv . "' ORDER BY ID_edito DESC");

                        if (!empty($title)) {
                            ?>
                            <tr>
                                <td width="3%">
                                    <span class="dashicons dashicons-controls-play"></span>
                                </td>
                                <td>
                                    <?php echo $title; ?> par <?php echo $prenom; ?>
                                </td>
                                <td width="3%">
                                    <nav id="nav"><ul id="navigation"><li>
                                                <span class="dashicons dashicons-external"></span><ul>
                                                    <?php
                                                    $ress = $wpdb->get_results("SELECT * FROM cdv_editorial WHERE ID_cdv ='" . $id_cdv . "' ORDER BY ID_edito DESC");

                                                    foreach ($ress as $pt) {

                                                        $titlpost = $pt->titlePost;
                                                        ?>      
                                                        <li>

                                                            <img src="../wp-content/plugins/Carnet_voyages/img/u20.png"></span>
                                                            <?php
                                                            echo $titlpost;
                                                            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id_cdv . "' AND titlePost='" . $titlpost . "'");
                                                            $deb = $id_cdv . $idedito;
                                                            $ipt = 1;
                                                            $pp = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id_cdv . "'");
                                                            ?>
                                                            <a href="../wp-content/plugins/Carnet_voyage_admin/update_admin.php?postID=<?php echo $id_cdv; ?>&titlepost=<?php echo $titlpost; ?>&id_media=<?php echo $pp; ?>" style="color: black;">
                                                                <span class="dashicons dashicons-external"></span>
                                                            </a>
                                                        </li>

                                                    <?php } ?></ul></li></ul></nav>
                                </td>
                                <?php
                                if (isset($cdv_version_actif)) {
                                    echo '<td width="20%">
                                <FORM action="../wp-content/plugins/Carnet_voyage_admin/getcdv.php?id_cdv=' . $id_cdv . '" method="post">
                                <SELECT name="validation" size="1" onChange="this.form.submit();">
                                    <OPTION value="En attente de validation">En attente de validation
                                    <OPTION value="Rejeté" selected>Rejeté
                                    <OPTION value="Validé">Validé 
                                </SELECT>
                                <noscript><input type="submit" value="Submit" /></noscript>
                                </FORM></td>
                                <td> <FORM>
                                <INPUT type="checkbox" disabled="disabled" name="choix1" value="1"> sur le site
                                </FORM></td>';
                                } else if ($stat == 2) {
                                    echo '<td width="20%">
                                <FORM action="../wp-content/plugins/Carnet_voyage_admin/getcdv.php?id_cdv=' . $id_cdv . '" method="post">
                                <SELECT name="validation" size="1" onChange="this.form.submit();">
                                    <OPTION value="En attente de validation" selected>En attente de validation
                                    <OPTION value="Rejeté" >Rejeté
                                    <OPTION value="Validé">Validé 
                                </SELECT>
                                <noscript><input type="submit" value="Submit" /></noscript>
                                </FORM></td>
                                <td> <FORM>
                                <INPUT type="checkbox" name="choix1" disabled="disabled" value="1"> sur le site
                                </FORM></td>';
                                } else if ($stat == 3) {
                                    echo '<td width="20%">
                                <FORM action="../wp-content/plugins/Carnet_voyage_admin/getcdv.php?id_cdv=' . $id_cdv . '" method="post">
                                <SELECT name="validation" size="1" onChange="this.form.submit();">
                                    <OPTION value="En attente de validation">En attente de validation
                                    <OPTION value="Rejeté" >Rejeté
                                    <OPTION value="Validé" selected>Validé 
                                </SELECT>
                                <noscript><input type="submit" value="Submit" /></noscript>
                                </FORM></td>
                                <td> <FORM>
                                <INPUT type="checkbox" name="choix1" value="1"  checked="checked"> sur le site
                                </FORM></td>';
                                }
                                ?>
                            </tr>
                            <?php
                            //}
                        }
                    }
                } else {
                    echo 'Aucuns carnets soumis!!';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

/* cdv */

function get_cdv($atts) {
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget.
        <br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nasetur ridiculus mus. Nam luctus pharetra vulputate, felis tellus.
    </p>
    <div class="row" id="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="row">
                <?php
                $choix = $_POST['pays'];
                $type = $_POST['type'];
                $activite = $_POST['activite'];
                if (isset($_POST['pays'])) {
                    global $wpdb;
                    $tableau = $wpdb->get_results("SELECT ID_cdv, titleCdv, txtIntroCdv, imgCdv, dateDepart FROM cdv where Statut = 3 AND idPaysPrincipal='" . $choix . "' ORDER BY dateModif DESC");
                    foreach ($tableau as $tableau) {
                        $id_cdv = $tableau->ID_cdv;
                        $nice_date = date('d F Y', strtotime($tableau->dateDepart));
                        $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                        /* echo $cdv_version_actif; */
                        if (!($cdv_version_actif)) {
                            ?>
                            <div class="col-sm-6" id="card">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="<?php echo $tableau->imgCdv; ?>" alt="Card image cap">
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="../blog_cdv?id_cdv=<?php echo $id_cdv; ?>"><?php echo $tableau->titleCdv; ?></a></h4>
                                        <p class=""><?php echo $nice_date; ?></p>
                                        <p class="card-text" style="color: #000;"><?php echo substr($tableau->txtIntroCdv, 0, 150) . '[...]'; ?></p>
                                        <a href="../blog_cdv/?id_cdv=<?php echo $id_cdv; ?>" style="color: #9c4425;"><p class="text-right font-weight-bold" style="color: #9c4425;">> Lire la suite</p></a>
                                    </div>
                                </div>	
                            </div>
                            <?php
                        }
                    }
                } else if (isset($_POST['activite'])) {
                    global $wpdb;
                    $tableau = $wpdb->get_results("SELECT ID_cdv, titleCdv, txtIntroCdv, imgCdv, dateDepart FROM cdv where Statut = 3 AND idActivitePrincipale='" . $activite . "' ORDER BY dateModif DESC");
                    foreach ($tableau as $tableau) {
                        $id_cdv = $tableau->ID_cdv;
                        $nice_date = date('d F Y', strtotime($tableau->dateDepart));
                        $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                        /* echo $cdv_version_actif; */
                        if (!($cdv_version_actif)) {
                            ?>
                            <div class="col-sm-6" id="card">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="<?php echo $tableau->imgCdv; ?>" alt="Card image cap">
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="../blog_cdv?id_cdv=<?php echo $id_cdv; ?>"><?php echo $tableau->titleCdv; ?></a></h4>
                                        <p class=""><?php echo $nice_date; ?></p>
                                        <p class="card-text" style="color: #000;"><?php echo substr($tableau->txtIntroCdv, 0, 150) . '[...]'; ?></p>
                                        <a href="../blog_cdv/?id_cdv=<?php echo $id_cdv; ?>" style="color: #9c4425;"><p class="text-right font-weight-bold" style="color: #9c4425;">> Lire la suite</p></a>
                                    </div>
                                </div>	
                            </div>
                            <?php
                        }
                    }
                } else if (isset($_POST['type'])) {
                    global $wpdb;
                    $tableau = $wpdb->get_results("SELECT ID_cdv, titleCdv, txtIntroCdv, imgCdv, dateDepart FROM cdv where Statut = 3 AND idTypeCircuit='" . $type . "' ORDER BY dateModif DESC");
                    foreach ($tableau as $tableau) {
                        $id_cdv = $tableau->ID_cdv;
                        $nice_date = date('d F Y', strtotime($tableau->dateDepart));
                        $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                        /* echo $cdv_version_actif; */
                        if (!($cdv_version_actif)) {
                            ?>
                            <div class="col-sm-6" id="card">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="<?php echo $tableau->imgCdv; ?>" alt="Card image cap">
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="../blog_cdv?id_cdv=<?php echo $id_cdv; ?>"><?php echo $tableau->titleCdv; ?></a></h4>
                                        <p class=""><?php echo $nice_date; ?></p>
                                        <p class="card-text" style="color: #000;"><?php echo substr($tableau->txtIntroCdv, 0, 150) . '[...]'; ?></p>
                                        <a href="../blog_cdv/?id_cdv=<?php echo $id_cdv; ?>" style="color: #9c4425;"><p class="text-right font-weight-bold" style="color: #9c4425;">> Lire la suite</p></a>
                                    </div>
                                </div>	
                            </div>
                            <?php
                        }
                    }
                } else {
                    global $wpdb;
                    $tableau = $wpdb->get_results("SELECT ID_cdv, titleCdv, txtIntroCdv, imgCdv, dateDepart FROM cdv where Statut = 3 ORDER BY dateModif DESC");
                    foreach ($tableau as $tableau) {
                        $id_cdv = $tableau->ID_cdv;
                        $nice_date = date('d F Y', strtotime($tableau->dateDepart));
                        $cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                        /* echo $cdv_version_actif; */
                        if (!($cdv_version_actif)) {
                            ?>
                            <div class="col-sm-6" id="card">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="<?php echo $tableau->imgCdv; ?>" alt="Card image cap">
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="../blog_cdv?id_cdv=<?php echo $id_cdv; ?>"><?php echo $tableau->titleCdv; ?></a></h4>
                                        <p class=""><?php echo $nice_date; ?></p>
                                        <p class="card-text" style="color: #000;"><?php echo substr($tableau->txtIntroCdv, 0, 150) . '[...]'; ?></p>
                                        <a href="../blog_cdv/?id_cdv=<?php echo $id_cdv; ?>" style="color: #9c4425;"><p class="text-right font-weight-bold" style="color: #9c4425;">> Lire la suite</p></a>
                                    </div>
                                </div>	
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <h5 style="border-bottom:  1px dashed #000; line-height: 2;">RERCHERCHER UN CARNET :</h5>
            <!-- SELECT DISTINCT id,nom,prenom FROM matable -->
            <div class="col-md-12 col-sm-12">
                <form method="post" action="">
                    <select name="pays" onChange="this.form.submit();" style="min-width: 100% !important; padding: 5px 5px 5px 10px !important;"> 
                        <option value="" selected="selected">Par pays</option>
                        <?php
                        global $wpdb;
                        $req = $wpdb->get_results("SELECT DISTINCT libPaysPrincipal, idPaysPrincipal FROM cdv");
                        foreach ($req as $requete) {
                            $pays = $requete->libPaysPrincipal;
                            $id_pays = $requete->idPaysPrincipal;
                            if (isset($pays)) {
                                ?>                   
                                <option value="<?php echo $id_pays; ?>"><?php echo $pays; ?></option>
                                <?php
                            }
                        }
                        ?>  
                    </select>
                </form>
                <br>
                <form name="recherche" method="post" action="">
                    <select name="activite" onChange="this.form.submit();" class="activite" style="min-width: 100% !important; padding: 5px 5px 5px 10px !important;">
                        <option value="" selected="selected">Par activité</option>
                        <?php
                        global $wpdb;
                        $req = $wpdb->get_results("SELECT DISTINCT idActivitePrincipale, libActivitePrincipale FROM cdv");
                        foreach ($req as $requete) {
                            $activite = $requete->libActivitePrincipale;
                            $id_activite = $requete->idActivitePrincipale;
                            if (!empty($activite)) {
                                ?>                   
                                <option value="<?php echo $id_activite; ?>"><?php echo $activite; ?></option>
                                <?php
                            }
                        }
                        ?>  
                    </select>
                </form>
                <br>
                <form name="recherche" method="post" action="">
                    <select name="type" onChange="this.form.submit();" class="type" style="min-width: 100% !important; padding: 5px 5px 5px 10px !important;"> 
                        <option value="" selected="selected">Par type</option>
                        <?php
                        global $wpdb;
                        $req = $wpdb->get_results("SELECT DISTINCT idTypeCircuit, libTypeCircuit FROM cdv");
                        foreach ($req as $requete) {
                            $type = $requete->libTypeCircuit;
                            $id_type = $requete->idTypeCircuit;
                            if (!empty($type)) {
                                ?>                   
                                <option value="<?php echo $id_type; ?>"><?php echo $type; ?></option>
                                <?php
                            }
                        }
                        ?>  
                    </select>
                </form>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('carnet', 'get_cdv');

function get_cdv_blog($args) {
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../wp-content/plugins/Carnet_voyage_admin/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/plugins/Carnet_voyage_admin/slick/slick-theme.css">
    <style>
        .slider {
            width: 50%;
            margin: 100px auto;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }
        .mk-zindex-fix
        {
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> 
    <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
    <style>
        #fancybox-title{
             margin-left: 10px !important;
             width: 542px !important;
        }
    </style>
    <script type="text/javascript">
                        $(function ($) {
                            var addToAll = false;
                            var gallery = true;
                            //var titlePosition = 'over';
                            $(addToAll ? 'img' : 'img.fancybox').each(function () {
                                var $this = $(this);
                                var title = $this.attr('title');
                                var src = $this.attr('data-big') || $this.attr('src');
                                var a = $('<a href="#" class="fancybox"></a>').attr('href', src).attr('title', title);
                                $this.wrap(a);
                            });
                            if (gallery)
                                $('a.fancybox').attr('rel', 'fancyboxgallery');
                            $('a.fancybox').fancybox({
                                'transitionIn': 'elastic',
                                'transitionOut': 'none',
                                'titlePosition': 'over',
                                'titleFormat': function (title) {
                                    return '<span id="fancybox-title-over">' + (title.length ? '   ' + title : '') + '</span>';
                                }
                            });
                        });
                        $.noConflict();
    </script>
    <?php
    $id = $_GET['id_cdv'];
    $folder = '../wp-content/plugins/Carnet_voyages/upload/';
    global $wpdb;
    $st = 3;
    $requete_post = $wpdb->get_results("SELECT * FROM cdv_editorial WHERE ID_cdv ='" . $id . "'");
    foreach ($requete_post as $post) {
        $lieuDepPost = $post->lieuDepPost;
        $lieuArrPost = $post->lieuArrPost;
        $dateDepartPost = $post->dateDepartPost;
        $dateFinPost = $post->dateFinPost;
        $titlePost = $post->titlePost;
        $txtPost = $post->txtPost;
    }
    $requete = $wpdb->get_results("SELECT titleCdv, txtIntroCdv, imgCdv, dateDepart, subtitleCdv FROM cdv where ID_cdv = '" . $id . "' ");
    foreach ($requete as $tableau) {
        $titleCdv = $tableau->titleCdv;
        $txtIntroCdv = $tableau->txtIntroCdv;
        $imgCdv = $tableau->imgCdv;
        $dateDepart = $tableau->dateDepart;
        $date = date('F Y', strtotime($dateDepart));
        $subtitleCdv = $tableau->subtitleCdv;
    }
    ?>
    <h1 class="display-1 text-center" style="color: #4F2601;"><?php echo $titleCdv; ?></h1>
    <?php
    if (empty($subtitleCdv)) {
        echo '<h5 class="display-4 text-center" style="color: #996600;">' . $date . '</h5>';
    } else if (isset($subtitleCdv)) {
        echo '<h5 class="display-4 text-center" style="color: #996600;">' . $subtitleCdv . ' - ' . $date . '</h5>';
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <img src="<?php echo $imgCdv; ?>" class="img-fluid" alt="Responsive image" style="width: 100% !important; height: 303px !important;">
        </div>
        <br>
        <p><?php echo $txtIntroCdv; ?></p>
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <?php
            $datefin = $wpdb->get_var("SELECT dateFin FROM cdv WHERE ID_cdv ='" . $id . "' ORDER BY ID_cdv ASC");
            $datedebutpost = $wpdb->get_var("SELECT dateDebutPost FROM cdv_editorial WHERE ID_cdv ='" . $id . "' ORDER BY ID_edito ASC");
            $datefinpost = $wpdb->get_var("SELECT dateFinPost FROM cdv_editorial WHERE ID_cdv ='" . $id . "' ORDER BY ID_edito ASC");
            $datedepart = $wpdb->get_var("SELECT dateDepart FROM cdv WHERE ID_cdv ='" . $id . "' ORDER BY ID_cdv ASC");
            $datedebut = strtotime($datedebutpost);
            $datedep = strtotime($datedepart);
            $numero_du_jour = ($datedebut - $datedep) / 86400;   // 86400 est égale 60(1 minute)*60( 1 Heure)*24(1 jours)
            $tabDate = explode('-', $datedebutpost);
            $mois = date("F", strtotime($datedebutpost)); // affiche le mois d'une date
            ?>
            <div class="row">
                <div class="col-md-4 col-sm-4"></div>
                <div class="col-md-4 col-sm-4">
                    <h5 class="text-center display-5" style="color: #666666; border-bottom: 1px dashed #afafaf;">Départ</h5>
                    <h6 class="text-center display-6" style="color: #9E836B;"><?php echo date('d F Y', strtotime($datedepart)); ?></h6>
                </div>
                <div class="col-md-4 col-sm-4"></div>
            </div>
            <div class="row">
                <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                <div class="col-6" style= "height : 80px;"></div>
            </div>
            <?php
            $folder = '../wp-content/plugins/Carnet_voyages/upload/';
            $rst = $wpdb->get_results("SELECT * FROM cdv_editorial WHERE ID_cdv ='" . $id . "' and dateDebutPost='" . $datedepart . "' order by ID_edito ASC");
            foreach ($rst as $tp) {
                $titlepost = $tp->titlePost;
                $txtp = $tp->txtPost;
                $lieudeppost = $tp->lieuDepPost;
                $lieuarrpost = $tp->lieuArrPost;
                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                 $deb = $id. $idedito;
                $cpt = $wpdb->get_var("SELECT count(nom_fichier) FROM cdv_media WHERE ID_cdv ='" . $id . "' and nom_fichier LIKE '%$deb%'");
                if ($cpt > 1) {
                    ?>
                    <div class="row" style="border: 1px solid #afafaf;">

                        <p>
                            &nbsp;&nbsp;<img src="../wp-content/plugins/Carnet_voyage_admin/images/dep.png" >&nbsp;&nbsp;<b><?php echo $lieudeppost; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="../wp-content/plugins/Carnet_voyage_admin/images/fin.png" >&nbsp;&nbsp;<b><?php echo $lieuarrpost; ?></b>
                        </p>

                        <?php
                        $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                         $deb = $id . $idedito;
                        $ipt = 1;
                        $phtp = $wpdb->get_var("SELECT nom_fichier  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id . "' ORDER BY ID_media ASC");

                        // affichage d'une photo principale
                        echo'<img src="' . $folder . $phtp . '" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                        ?>
                        <div><p class="font-weight-bold" style="color: #4F2601;"><?php echo $titlepost; ?></p></div>
                        <br><br>
                        <div style="width: 100%;" ><p><?php echo $txtp; ?></p></div>
                        <section class="center slider col-md-8 col-sm-8">
                            <?php
                            $noms = $wpdb->get_results("SELECT NomClient, prenomClient FROM cdv WHERE ID_cdv ='" . $id . "'");
                            foreach ($noms as $p)
                            {
                                $nom = $p->NomClient;
                                $prenom = $p->prenomClient;
                            }
                            $ra = $wpdb->get_results("SELECT titleImg, txtImg, nom_fichier  FROM cdv_media WHERE ID_cdv ='" . $id . "'  and nom_fichier LIKE '%$deb%' ORDER BY ID_cdv ASC");
                            foreach ($ra as $pa) {
                                $nom_fichier = $pa->nom_fichier;
                                $legende = $pa->txtImg;
                                $titleimg = $pa->titleImg;
                                echo '<div>       
                             <img class="fancybox" src="' . $folder . $nom_fichier . '" title="<div><h4>' . $titleimg . ' - &copy; '.$nom.$prenom.'</h4></div><div><p>' . $legende . '</p></div>"/>
                        </div>';
                            }
                            ?>
                        </section>

                    </div>
                    <div class="row">
                        <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                        <div class="col-6" style= "height : 80px;"></div>
                    </div>
                    <?php
                }
            } //////////////////end depart  slider*********************************
            ?>
            <?php
            $folder = '../wp-content/plugins/Carnet_voyages/upload/';
            $rst = $wpdb->get_results("SELECT * FROM cdv_editorial WHERE ID_cdv ='" . $id . "' and dateDebutPost='" . $datedepart . "' order by ID_edito ASC");
            foreach ($rst as $tp) {
                $titlepost = $tp->titlePost;
                $txtp = $tp->txtPost;
                $lieudeppost = $tp->lieuDepPost;
                $lieuarrpost = $tp->lieuArrPost;
                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                $deb = $id . $idedito;
                $cpt = $wpdb->get_var("SELECT count(nom_fichier) FROM cdv_media WHERE ID_cdv ='" . $id . "' and nom_fichier LIKE '%$deb%'");
                if ($cpt == 1) {
                    ?>
                    <div class="row" style="border: 1px solid #afafaf;">
                        <p>
                            &nbsp;&nbsp;<img src="../wp-content/plugins/Carnet_voyage_admin/images/dep.png" >&nbsp;&nbsp;<b><?php echo $lieudeppost; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="../wp-content/plugins/Carnet_voyage_admin/images/fin.png" >&nbsp;&nbsp;<b><?php echo $lieuarrpost; ?></b>
                        </p> 
                        <div class="col-md-12 col-sm-12">
                            <?php
                            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                            $deb = $id . $idedito;
                            $ipt = 1;
                            $phop = $wpdb->get_var("SELECT nom_fichier  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id . "'");

                            // affichage d'une photo principale
                            if (substr($phop, -4) == ".jpg" || substr($phop, -4) == ".JPG") {
                                $rest = substr($phop, 0, -4);
                                echo'<img src="' . $folder . $rest . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            } elseif (substr($phop, -4) == ".png" || substr($phop, -4) == ".PNG") {
                                $rest = substr($phop, 0, -4);
                                echo'<img src="' . $folder . $rest . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            } elseif (substr($phop, -5) == ".jpeg" || substr($phop, -5) == ".JPEG") {
                                $rest = substr($phop, 0, -5);
                                echo'<img src="' . $folder . $rest . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            }
                            ?>
                        </div>
                        <div><p class="font-weight-bold" style="color: #4F2601;"><?php echo $titlepost; ?></p></div>
                        <br><br>
                        <div style="width: 100%;" ><p><?php echo $txtp; ?></p></div>

                    </div>
                    <div class="row">
                        <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                        <div class="col-6" style= "height : 80px;"></div>
                    </div>
                    <?php
                }
            }
            //          ******************* end depart photo ***********************
            $folder = '../wp-content/plugins/Carnet_voyages/upload/';
            $folder = '../wp-content/plugins/Carnet_voyages/upload/';
            $datedepart = $wpdb->get_var("SELECT dateDepart FROM cdv WHERE ID_cdv ='" . $id . "' ORDER BY ID_cdv ASC");
            $rst = $wpdb->get_results("SELECT * FROM cdv_editorial WHERE ID_cdv ='" . $id . "'  and dateDebutPost <>'" . $datedepart . "' order by dateDebutPost ASC");
            foreach ($rst as $tp) {
                $datedebutpost = $tp->dateDebutPost;
                $datedebut = strtotime($datedebutpost);
                $datedep = strtotime($datedepart);
                $numero_jour = ($datedebut - $datedep) / 86400;   // 86400 est égale 60(1 minute)*60( 1 Heure)*24(1 jours)
                $tabD = explode('-', $datedebutpost);
                $mois = date("F", strtotime($datedebutpost)); // affiche le mois d'une date

                $journee = $datedebutpost;
                ?>
                <div class="row">
                    <div class="col-md-4 col-sm-4"></div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-12 col-sm-12 text-center" style="color: #666666;">Jour <?php echo $numero_jour . " / " . $tabD[2] . "   " . $mois . "   " . $tabD[0]; ?></div>
                    </div>
                    <div class="col-md-4 col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                    <div class="col-6" style= "height : 80px;"></div>
                </div>
                <?php
                $titlepost = $tp->titlePost;
                $txtp = $tp->txtPost;
                $lieudeppost = $tp->lieuDepPost;
                $lieuarrpost = $tp->lieuArrPost;
                $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                $deb = $id . $idedito;
                $cpt = $wpdb->get_var("SELECT count(nom_fichier) FROM cdv_media WHERE ID_cdv ='" . $id . "' and nom_fichier LIKE '%$deb%'");
                if ($cpt > 1) {
                    ?>
                    <div class="row" style="border: 1px solid #afafaf;">
                        <?php
                        $ipt = 1;
                        $photop = $wpdb->get_var("SELECT nom_fichier  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id . "'  ORDER BY ID_media ASC");
                        ?>
                        <p>
                            &nbsp;&nbsp;<img src="../wp-content/plugins/Carnet_voyage_admin/images/dep.png" >&nbsp;&nbsp;<b><?php echo $lieudeppost; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="../wp-content/plugins/Carnet_voyage_admin/images/fin.png" >&nbsp;&nbsp;<b><?php echo $lieuarrpost; ?></b>
                        </p>
                        <?php
                        // affichage d'une photo principale

                        if (substr($photop, -4) == ".jpg" || substr($photop, -4) == ".JPG") {
                            $rest1 = substr($photop, 0, -4);
                            echo'<img src="' . $folder . $rest1 . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                        } elseif (substr($photop, -4) == ".png" || substr($photop, -4) == ".PNG") {
                            $rest1 = substr($photop, 0, -4);

                            echo'<img src="' . $folder . $rest1 . '.png" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                        } elseif (substr($photop, -5) == ".jpeg" || substr($photop, -5) == ".JPEG") {
                            $rest1 = substr($photop, 0, -5);
                            echo'<img src="' . $folder . $rest1 . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                        }
                        ?>
                        <div><p class="font-weight-bold" style="color: #4F2601;"><?php echo $titlepost; ?></p></div>
                        <br><br>
                        <div style="width: 100%;" ><p><?php echo $txtp; ?></p></div>
                        <section class="center slider col-md-8 col-sm-8">
                            <?php
                            $r = $wpdb->get_results("SELECT nom_fichier  FROM cdv_media WHERE ID_cdv ='" . $id . "'  and nom_fichier LIKE '%$deb%' ORDER BY ID_cdv ASC");
                            foreach ($r as $p) {
                                $nom_fichier = $p->nom_fichier;

                                echo '<div>';

                                if (substr($nom_fichier, -4) == ".jpg" || substr($nom_fichier, -4) == ".JPG") {
                                    $rest12 = substr($nom_fichier, 0, -4);
                                    echo'<img class="fancybox" src="' . $folder . $rest12 . '.jpg" title="<div><h4>' . $titleimg . ' - &copy; '.$nom.$prenom.'</h4></div><div><p>' . $legende . '</p></div>" />';
                                } elseif (substr($nom_fichier, -4) == ".png" || substr($nom_fichier, -4) == ".PNG") {
                                    $rest12 = substr($nom_fichier, 0, -4);
                                    echo'<img class="fancybox" src="' . $folder . $rest12 . '.png" title="<div><h4>' . $titleimg . ' - &copy; '.$nom.$prenom.'</h4></div><div><p>' . $legende . '</p></div>" />';
                                } elseif (substr($nom_fichier, -5) == ".jpeg" || substr($nom_fichier, -5) == ".JPEG") {
                                    $rest12 = substr($nom_fichier, 0, -5);
                                    echo'<img class="fancybox" src="' . $folder . $rest12 . '.jpg" title="<div><h4>' . $titleimg . ' - &copy; '.$nom.$prenom.'</h4></div><div><p>' . $legende . '</p></div>" />';
                                }
                                //    <img class="fancybox" src="'.$folder.$rest1 . '" />
                                echo '</div>';
                            }
                            ?>
                        </section>
                    </div>
                    <div class="row">
                        <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                        <div class="col-6" style= "height : 80px;"></div>
                    </div>
                    <?php
                } elseif ($cpt == 1) {
                    ?>
                    <div class="row" style="border: 1px solid #afafaf;">
                        <p>
                            &nbsp;&nbsp;<img src="../wp-content/plugins/Carnet_voyage_admin/images/dep.png" >&nbsp;&nbsp;<b><?php echo $lieudeppost; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="../wp-content/plugins/Carnet_voyage_admin/images/fin.png" >&nbsp;&nbsp;<b><?php echo $lieuarrpost; ?></b>
                        </p>

                        <div class="col-md-12 col-sm-12">
                            <?php
                            $idedito = $wpdb->get_var("SELECT ID_edito FROM cdv_editorial  WHERE ID_cdv='" . $id . "' AND titlePost='" . $titlepost . "'");
                            $deb = $id . $idedito;
                            $ipt = 1;
                            $phop = $wpdb->get_var("SELECT nom_fichier  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $id . "'");
                            // affichage d'une photo principale
                            if (substr($phop, -4) == ".jpg" || substr($phop, -4) == ".JPG") {
                                $rest = substr($phop, 0, -4);
                                echo'<img src="' . $folder . $rest . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            } elseif (substr($phop, -4) == ".png" || substr($phop, -4) == ".PNG") {
                                $rest = substr($phop, 0, -4);

                                echo'<img src="' . $folder . $rest . '.png" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            } elseif (substr($phop, -5) == ".jpeg" || substr($phop, -5) == ".JPEG") {
                                $rest = substr($phop, 0, -5);
                                echo'<img src="' . $folder . $rest . '.jpg" class="img-responsive" style="width: 800px ; height: 427px ;" />';
                            }
                            ?>
                        </div>

                        <div><p class="font-weight-bold" style="color: #4F2601;"><?php echo $titlepost; ?></p></div>
                        <br><br>
                        <div style="width: 100%;" ><p><?php echo $txtp; ?></p></div>

                    </div>
                    <div class="row">
                        <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                        <div class="col-6" style= "height : 80px;"></div>
                    </div>
                    <?php
                }
            }
            // ******************    Fin Journee *********************************************
            $datefin = $wpdb->get_var("SELECT dateRetour FROM cdv WHERE ID_cdv ='" . $id . "'");
            $tabDat = explode('-', $datefin);
            $mm = date("F", strtotime($datefin)); // affiche le mois d'une date
            $j = $tabDat[2];
            $y = $tabDat[0];
            ?>
            <div class="row">
                <div class="col-md-4 col-sm-2"></div>
                <div class="col-md-4 col-sm-4">
                    <h5 class="text-center display-5" style="color: #666666; border-bottom: 1px dashed #afafaf;">Retour</h5>
                    <h6 class="text-center display-6" style="color: #9E836B;"><?php echo $j . "  " . $mm . "   " . $y; ?></h6>
                </div>
                <div class="col-md-4 col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-6" style= "border-right: 1px solid #afaeae; height : 80px;"></div>
                <div class="col-6" style= "height : 80px;"></div>
            </div>
        </div> 
        <div class="col-md-1"></div>
        <div class="col-md-3 col-sm-12" style="height: 450px; border: 1px solid #afafaf;">MODULE GMAP</div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/Carnet_voyage_admin/slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
                        $(document).on('ready', function () {
                            $(".center").slick({
                                dots: true,
                                infinite: true,
                                centerMode: true,
                                slidesToShow: 1,
                                slidesToScroll: 2
                            });
                        });
    </script> 
    <?php
}

add_shortcode('blog_cdv', 'get_cdv_blog');
?>
