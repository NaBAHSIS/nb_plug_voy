<?php
/* Plugin Name: Carnet des voyages Contributor
 * Plugin URI: http://www.myplugin.com/
 * Description: Plugin pour la creation des CDV Contributor.
 * Version: 1.0
 * Author: IFMED
 * Author URI: http://ifmed.net
 * License: 
 */
	
	
wp_enqueue_script('customadminjs','/wp-content/plugins/Carnet_voyages/js/admin.js');
/*wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/custom-script.js');*/
wp_enqueue_script('carnetscript','/wp-content/plugins/Carnet_voyages/js/carnetScript.js');
//wp_enqueue_style( 'stylecss',' ../wp-content/themes/jupiter/css/style.css');

add_action('admin_menu', 'add_admin_menu');
function add_admin_menu() {
    add_menu_page('Mon carnet', 'Mon carnet', 'contributor', 'carnet', 'menu_html_ajout', 'dashicons-admin-post', 30);
}

function menu_html_ajout() {
    wp_enqueue_media();
    ?>

    <link rel='stylesheet' id='stylecss-css'  href='../wp-content/plugins/Carnet_voyages/css/style.css' type='text/css' media='all'>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"-->
   
     <link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />
     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        
  <script src="http://malsup.github.com/jquery.form.js"></script>
 <!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
  <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script-->
  <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script-->
  <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
  
  
   <script>
       function initMap() {
       /* var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });*/
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 48.50, lng: 2.20},
          zoom: 3
        });
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('from'));
        var inputdest = /** @type {!HTMLInputElement} */(
            document.getElementById('to'));    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var autocompletedest = new google.maps.places.Autocomplete(inputdest);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
        
        var markerdest = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div style="width:100px;"><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        autocompletedest.addListener('place_changed', function() {
          infowindow.close();
          markerdest.setVisible(false);
          var place = autocompletedest.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          markerdest.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          markerdest.setPosition(place.geometry.location);
          markerdest.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div style="width:100px;"><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, markerdest);
        });

    }
       
   </script>
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6VH6G_0bNHHKfenV6Eo3KWUuL5ozmcpg&libraries=places&callback=initMap"></script>
   
   
       
     <script>
	 
	 function clearjQueryCache(){
    for (var x in jQuery.cache){
        delete jQuery.cache[x];
    }
}
			   $(document).ready(function(){
				  
				         clearjQueryCache();
			                var crop_max_width = 600;
                            var crop_max_height = 600; 
                            var jcrop_api;
                            var canvas;
                            var context;
                            var image;
                            var file, img,w,h;
                            var prefsize;
				            var filename='';
							
                            $("#IMG_CDV").change(function(event) {
                                   var tt=this;
                                 
                                   var files = $(this)[0].files;
                                   var urrl=event.target.files[0];
									if ((file = this.files[0])) {
										img = new Image();
										img.onload = function() {
											//alert(this.width + " " + this.height);
											w=this.width;
											h=this.height;
										};
										img.onerror = function() {
											alert( "c'est pas un fichier valide: " + file.type);
										};
										img.src = URL.createObjectURL(file);
										setTimeout(function(){
											
											if(w >=1600 && h>=550){
												
																 	
																 filename=files[0].name;
																 loadImage(tt);
																 $('#btn_publier').val(" Enregistrer Brouillon");
																// $("#IMG_CDV").val(null); 
																 
																}
															   else{
																	alert( "la taille de votre image est "+ w+"x"+h +" ! C'est moins que la taille min (1600x550) ");
																}
										},300);
									}          
                            });
                              
                            function loadImage(input) {
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                canvas = null;
                                reader.onload = function(e) {
                                  image = new Image();
                                  image.onload = validateImage;
                                  image.src = e.target.result;
                            
                                }
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
							
							
							function dataURLtoBlob(dataURL) {
							  var BASE64_MARKER = ';base64,';
							  if (dataURL.indexOf(BASE64_MARKER) == -1) {
								var parts = dataURL.split(',');
								var contentType = parts[0].split(':')[1];
								var raw = decodeURIComponent(parts[1]);

								return new Blob([raw], {
								  type: contentType
								});
							  }
							  var parts = dataURL.split(BASE64_MARKER);
							  var contentType = parts[0].split(':')[1];
							  var raw = window.atob(parts[1]);
							  var rawLength = raw.length;
							  var uInt8Array = new Uint8Array(rawLength);
							  for (var i = 0; i < rawLength; ++i) {
								uInt8Array[i] = raw.charCodeAt(i);
							  }

							  return new Blob([uInt8Array], {
								type: contentType
							  });
							}
							
							
						
							function validateImage() {
							  if (canvas != null) {
								image = new Image();
								image.onload = restartJcrop;
								image.src = canvas.toDataURL('image/jpeg');
							  } else restartJcrop();
							}

                            function restartJcrop() {
                              if (jcrop_api != null) {
                                jcrop_api.destroy();
                              }
                            /* $("#popupPhotoLandscape").children().find('.modal-body').find('#views').empty();
                             $("#popupPhotoLandscape").children().find('.modal-body').find('#views').append("<canvas id=\"canvas\">");
                           */
						   
						   
						   
						   
							 if( $('#popupPhotoLandscape').css('display')=='none'){
                                  $('#popupPhotoLandscape').css('display','block') ;
							     }
						     $("#views").empty();
                             $("#views").append("<canvas id=\"canvas\">");
                               var    x = w/2-400 ;
                                var   y = h/5 ;
                                var  x1 = 200;
                                var  y1 = 100;
                             
                                
                               canvas = $(" #popupPhotoLandscape #canvas")[0]; 
							   //canvas = $("#canvas")[0]; 
                              context = canvas.getContext("2d");
                              canvas.width = image.width;
                              canvas.height = image.height;
                              context.drawImage(image, 0, 0);
                          
                              $("#canvas").Jcrop({
                                onSelect: selectcanvas,
                                onChange: selectcanvas,
                                //setSelect:   [ x, y, x1, y1 ],
                                onRelease: clearcanvas,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true,
                                boxWidth: crop_max_width,
                                boxHeight: crop_max_height,
                                trueSize:  [canvas.width, canvas.height],
                                aspectRatio : 2.18//(w-772/h-433)  
							  
							 }, function() {
                                jcrop_api = this;
								
								
                              });
                             
				
						  
							  clearcanvas();
							/* setTimeout(function(){   },800);*/
                            
							   
                            }

                            function clearcanvas() {
                              prefsize = {
                                x: 0,
                                y: 0,
                                w: canvas.width,
                                h: canvas.height,
                              };
                              $('.info #w').val('');
                              $('.info #h').val('');
                            }

                            function selectcanvas(coords) {
                              prefsize = {
                                x: Math.round(coords.x),
                                y: Math.round(coords.y), 
                                w: Math.round(coords.w),
                                h: Math.round(coords.h)
                              };
                                $('#x1').val(coords.x);
                                $('#y1').val(coords.y);
                                $('#x2').val(coords.x2);
                                $('#y2').val(coords.y2);
                                $('#w').val(coords.w);
                                $('#h').val(coords.h);
                              if (parseInt(coords.w) > 0) {
									// Show image preview
									var imageObj = jQuery("#canvas")[0];
									var canvasprv = jQuery("#viewIMPp")[0];
									var contextt = canvasprv.getContext("2d");

									contextt.beginPath();
									//contextt.arc(50, 50, 50, Math.PI * 2, 0, true); // you can use any shape
									contextt.arc(50, 50, 90, Math.PI * 4, 0, true); // you can use any shape
									// contextt.rect(188, 50, 200, 100);
									contextt.clip();
									contextt.closePath();
									contextt.drawImage(imageObj, coords.x, coords.y, coords.w, coords.h, 0, 0, 100, 100);
								  }
                              
                            } 
		
							function applyCrop() {
							  canvas.width = prefsize.w;
							  canvas.height = prefsize.h;
							  context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
							  validateImage();
							}
							
							
                            function applyScale(scale) {
                                if (scale == 1) return;
                                canvas.width = canvas.width * scale;
                                canvas.height = canvas.height * scale;
                                context.drawImage(image, 0, 0, canvas.width, canvas.height);
                                validateImage();
                              }

                              function applyRotate() {
                                canvas.width = image.height;
                                canvas.height = image.width;
                                context.clearRect(0, 0, canvas.width, canvas.height);
                                context.translate(image.height / 2, image.width / 2);
                                context.rotate(Math.PI / 2);
                                context.drawImage(image, -image.width / 2, -image.height / 2);
                                validateImage();
                              }
                          
                           $("#scalebutton").click(function(e) {
                                var scale = prompt("Scale Factor:", "1");
                                applyScale(scale);
                              });
                              $("#rotatebutton").click(function(e) {
                                applyRotate();
                              });

                            $("#cropbutton").click(function(e) {
                           
                             
                                if($('.info #w').val()=='') {
                                    $('#popupPhotoLandscape .errorhh').text('Selectionner la region à cropper!');
                                }
                                else{
                                     $('#popupPhotoLandscape .errorhh').text('');
                                    canvas.width = prefsize.w;
                                    canvas.height = prefsize.h;
                                    context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
                                    var blob = dataURLtoBlob(canvas.toDataURL('image/jpeg'));
                             
                                    setTimeout(function(){  $('#viewIMP').attr('src',canvas.toDataURL('image/jpeg')); $('#popupPhotoLandscape').hide();},800);
                                    
                                    $('#cropped_image').val(canvas.toDataURL('image/jpeg'));
									$('#header').val(filename);
							        $('#header').focus();
                                }
                            });

						// btn publier
						 // initialiser les inputs hidden
        $('.recitupdate').each(function(e){
		  $(this).next().val($(this).val());
	    });
    // btn publier carnet 
	var requestRunningpub = false;
	var postattente=false;
    $('#btn_publier').click(function (e) {
		if (requestRunningpub) { // don't do anything if an AJAX request is pending
        return;
    }
	
	
	// verif if there is some post not saved!
	
	$('.datepickerdebutHidden').each(function(e){
		if($(this).val()!= $(this).next().val()){
			postattente=true;
		
		}
		if(postattente === true) {
        return false; 
        }
	});
	$('.datepickerfinHidden').each(function(e){
		if($(this).val()!= $(this).next().val()){
			postattente=true;
			
		}
		if(postattente === true) {
        return false; 
        }
	});
	$('.titrerecitHidden').each(function(e){
		if($.trim($(this).val())!= $.trim($(this).next().val())){
			postattente=true;
			
		}
		if(postattente === true) {
        return false; 
        }
	});
	 $('.recitHidden').each(function(e){
		if($.trim($(this).val())!= $.trim($(this).prev().val())){
			postattente=true;
			
		}
		
		if(postattente === true) {
        return false; 
        }
	}); 
	$('.fromHidden').each(function(e){
		if($(this).val()!= $(this).prev().val()){
			postattente=true;
			
		}
		if(postattente === true) {
        return false; 
        }
	});
	$('.toHidden').each(function(e){
		if($(this).val()!= $(this).prev().val()){
			postattente=true;
			
		}
		if(postattente === true) {
        return false; 
        }
	});
	if(postattente === true){
		
		$('#dialogSavePost').modal('show');
		//$('#dialogSavePost').addClass('in'); 
	    e.preventDefault(); 
	}
	else{	
       
         var    $titlecdv = $('.titleCdv').val();
        var    $imgCdv = $('#header').val();
        var    $introCdv = $('.presentation').val();
       var  $introCdvtest = $introCdv.replace(/\s+/g, '');//suppression des espaces vides!
       if( $introCdvtest==""){
           $introCdv= $introCdvtest;
        }
        
            var statverif = false;
            if ($titlecdv == "")
            {
                $('.errorTitlecdv').text('Vous devez saisir le titre de Poste!, Ce champ est obligatoire!');
                $('.errorTitlecdv').css("display", "block");
                //statverif = false;
                event.preventDefault();
            } else
            {
                $('.errorTitlecdv').css("display", "none");
               // statverif = true;
            }
            if ($imgCdv == "")
            {
                $('.errorImgCdv').text('choisissez une image, Ce champ est obligatoire!');
                $('.errorImgCdv').css("display", "block");
              
                event.preventDefault();
            } else
            {
                $('.errorImgCdv').css("display", "none");
              
            }
            
            if ($introCdvtest == "")
            {
                
                $('.errortxtIntroCdv').text('Vous devez saisir une presentation!, Ce champ est obligatoire!');
                $('.errortxtIntroCdv').css("display", "block");
               
                event.preventDefault();
            } else
            {
                $('.errortxtIntroCdv').css("display", "none");
            }
            
            if($introCdvtest != "" && $imgCdv != "" && $titlecdv != "" ){
                statverif=true;
            }
            else{
                statverif = false;
            }
                
           
            if(statverif==true){
            

             
              var formdata = new FormData(document.getElementById('post'));
            
                requestRunningpub = true;    
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/publier.php',
                        type: 'POST',
                        data: formdata,
                        dataType: 'text',  
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result, statut) { 
                        
						
                            if(result!="une erreur se produite lors de l'enregistrement!"){
                            result = result.replace(/\s+/g, ''); 
                            }
                            if (result !="")
                                {
                                    if (result==="checked!"){
                                    //do some thing here
                                            if(($('#profile_checkbox2').val()==0) &&($('#profile_checkbox1').val()==0) ){
                                                   $('#profile_checkbox2').css('border-color','#d61f16');
                                                   $('#profile_checkbox1').css('border-color','#d61f16');
                                              }
                                           else if($('#profile_checkbox1').val()==0 ){
                                                 $('#profile_checkbox1').css('border-color','#d61f16');
                                              }
                                              else if($('#profile_checkbox2').val()==0 ){
                                                   $('#profile_checkbox2').css('border-color','#d61f16');
                                              }

                                            $('.notif').show();
                                }
                                   else{
                                        alert(result);
                                    
                                   }
                                }
                                else{
                                    location.reload(true);
                                    
                                }
                            
                        },
						complete: function() {
							requestRunningpub = false;
						},
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        } 
                });
            
        
   
                e.preventDefault();
            }
	}  
    });
    
	
	$('#btnno').click(function(e){
		//postattente=false;
		$('#dialogSavePost').modal('hide');
		
         var    $titlecdv = $('.titleCdv').val();
        var    $imgCdv = $('#header').val();
        var    $introCdv = $('.presentation').val();
       var  $introCdvtest = $introCdv.replace(/\s+/g, '');//suppression des espaces vides!
       if( $introCdvtest==""){
           $introCdv= $introCdvtest;
        }
        
            var statverif = false;
            if ($titlecdv == "")
            {
                $('.errorTitlecdv').text('Vous devez saisir le titre de Poste!, Ce champ est obligatoire!');
                $('.errorTitlecdv').css("display", "block");
                //statverif = false;
                event.preventDefault();
            } else
            {
                $('.errorTitlecdv').css("display", "none");
               // statverif = true;
            }
            if ($imgCdv == "")
            {
                $('.errorImgCdv').text('choisissez une image, Ce champ est obligatoire!');
                $('.errorImgCdv').css("display", "block");
              
                event.preventDefault();
            } else
            {
                $('.errorImgCdv').css("display", "none");
              
            }
            
            if ($introCdvtest == "")
            {
                
                $('.errortxtIntroCdv').text('Vous devez saisir une presentation!, Ce champ est obligatoire!');
                $('.errortxtIntroCdv').css("display", "block");
               
                event.preventDefault();
            } else
            {
                $('.errortxtIntroCdv').css("display", "none");
            }
            
            if($introCdvtest != "" && $imgCdv != "" && $titlecdv != "" ){
                statverif=true;
            }
            else{
                statverif = false;
            }
                
           
            if(statverif==true){
            

             
              var formdata = new FormData(document.getElementById('post'));
            
                requestRunningpub = true;    
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/publier.php',
                        type: 'POST',
                        data: formdata,
                        dataType: 'text',  
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result, statut) { 
                        
						
                            if(result!="une erreur se produite lors de l'enregistrement!"){
                            result = result.replace(/\s+/g, ''); 
                            }
                            if (result !="")
                                {
                                    if (result==="checked!"){
                                    //do some thing here
                                            if(($('#profile_checkbox2').val()==0) &&($('#profile_checkbox1').val()==0) ){
                                                   $('#profile_checkbox2').css('border-color','#d61f16');
                                                   $('#profile_checkbox1').css('border-color','#d61f16');
                                              }
                                           else if($('#profile_checkbox1').val()==0 ){
                                                 $('#profile_checkbox1').css('border-color','#d61f16');
                                              }
                                              else if($('#profile_checkbox2').val()==0 ){
                                                   $('#profile_checkbox2').css('border-color','#d61f16');
                                              }

                                            $('.notif').show();
                                }
                                   else{
                                        alert(result);
                                    
                                   }
                                }
                                else{
                                    location.reload(true);
                                    
                                }
                            
                        },
						complete: function() {
							requestRunningpub = false;
						},
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        } 
                });
            
        
   
                e.preventDefault();
            }
		
	});
	$('#btnyes').click(function(e){
		
		$('#dialogSavePost').modal('hide');
		
	}); 

			//****************************************************************************************************************************************************//
			//***********************       Block modification      ***********************************************************************************//
			//************************************************************************************************************************************************//      
			 

			var idedit;
			$('.submitUpdate').each(function(){
				
				$(this).click(function(e){
					
					 idedit=$(this).attr('id').split('submitUpdate')[1];
					var title_im= $('#titleImg'+idedit).val();
					var file= $('#fileupdate'+idedit).val();
					if(file !="" || title_im !="")
					{
						$('#dialogSaveImage').modal('show');
						e.preventDefault();
					}
					else{
							
							
							var parent=$(this).parent().parent().parent();
							
							var datedebut=$(parent).find('.datepickerdebutUpdate').val(); 
							var datedefin=$(parent).find('.datepickerfinUpdate').val();
							var title=$(parent).find('input[name=profile_titre_recit_update]').val(); 
							var recit=$(parent).find('textarea.recitupdate').val();
							var addep=$(parent).find('input[name=fromUpdate]').val();
							var addest=$(parent).find('input[name=toUpdate]').val()
							
							var formdata ={ID_recit:idedit,titre_recit: title,datedebut:datedebut,datedefin:datedefin,recit:recit,addep:addep,addest:addest};
							
								   $.ajax({
											url: '../wp-content/plugins/Carnet_voyages/update.php',
											type: 'POST',
											data: formdata,
											success: function (result, statut) { // success est toujours en place, bien sûr !
												   if(result!="erreur!")
												   {  
													  // alert(result);
													  location.reload();
												   }
												   
											},
											error: function (resultat, statut, erreur) {
													alert(erreur);
											}
									}); 
					}     
				});
			});

			$('#btnoui').click(function(e){
		
		         $('#dialogSaveImage').modal('hide');
				  
						
						var idbtn=idedit;
						
						
						 var permition=false;
						if ($('#titleImg'+idbtn).val()== "")
						{
							$('.errorTitleImg'+idbtn).text('Saisir le titre de votre album!, Ce champ est obligatoire!')
							$('.errorTitleImg'+idbtn).css("display", "block");
							permition=false;
							event.preventDefault();
						} else
						{
							$('.errorTitleImg'+idbtn).css("display", "none");
							permition=true;
						}
					 
						
						if(permition==true){
						  
							
							var files = $('#fileupdate'+idbtn)[0].files;
							var legpho=$('#legendeup'+idbtn).val();
						  
							if (files.length > 0) {
						   
							var tmppath = URL.createObjectURL(files[0]);
							  
							
							
							
							var formdata=new FormData();
							formdata.append('image',$('#fileupdate'+idbtn)[0].files[0]);
							formdata.append('idedito',idbtn);
							formdata.append('profile_titre_photo_update',$('#titleImg'+idbtn).val());
							formdata.append('profile_legende_update',legpho);
							requestRunningupd = true;
							
								$.ajax({
										url: '../wp-content/plugins/Carnet_voyages/uploadAlbumOnUpdate.php',
										type: 'POST',
										data: formdata,
										dataType: 'text',  // what to expect back from the PHP script, if anything
										cache: false,
										contentType: false,
										processData: false,
										success: function (result, statut) { // success est toujours en place, bien sûr !
										  var matches = result.match(/\d+/g);
										  
											if (result !="" && result.length > 3 && matches == null ){
												alert(result);
											} 
											else if (result !="" && matches != null)
											{
											   var counter=result;    
											   var eltch=$('#preview'+idbtn).children().children().length;
												$('#preview'+idbtn).css('display','block');
												
												$('#imageenrg'+idbtn).parent().next().children('div').append('<div id="parent'+counter+'" style="background-color: #ddd;margin:5px;width: 115px; height: 270px;font-size:11px;float:left; " >\n\
																			<img style="width: 105px;height: 105px; float:left;margin:5px;" src="'+tmppath+'" alt="" class="img-responsive"></img>\n\
																			<input type="hidden" class="myTitle" id="titrePho'+counter+'" value="'+$('#titleImg'+idbtn).val()+'" >\n\
																			<input class="mylegende" id="mylegende'+counter+'" type="hidden" value="'+legpho+'">\n\
																			<input class="myfile" id="myfile'+counter+'" type="hidden" value="">\n\
																			<input class="chekboxupdate" id="check'+counter+'-'+idbtn+'" style="    margin-bottom: 15px; margin-left: 4px;font-size: 8px;margin-right: 0px;margin-top: 11px;" type="radio" name="radio" class="radio" value=""> Photo principale</input><br>\n\
																			<span id="'+counter+'"  style="padding: 5px; color:#72777c; text-decoration: underline;margin-bottom:8px;    cursor: pointer;" class="ModifPhotoAlbum" data-toggle="modal" data-target="#myModal'+counter+'" > Modifier la photo</span><br><br>\n\
																			 <span  id="idSup'+counter+'"  style="padding: 5px;color:#72777c;  cursor: pointer;"  class="SupPhotoAlbumBlocUPd " > Supprimer la photo</span><br>\n\
																			<div class="container">\n\
																			<div class="modal fade myModal " id="myModal'+counter+'"  role="dialog">\n\
																			<div class="modal-dialog">\n\
																			<div class="modal-content">\n\
																			<div class="modal-header">\n\
																			<button type="button" class="close" data-dismiss="modal">&times;</button>\n\
																			<h3 class="modal-title">Modifier les informations de votre photo </h3></div>\n\
																			<div class="modal-body">\n\
																			<div>\n\
																			<label for="profile_titre_photo"> Titre de la photo </label><br>\n\
																			<input type="text" size="30" class="regular-text titleImg" value="'+$('#titleImg'+idbtn).val()+'" >\n\
																			<br>\n\
																			</div>\n\
																			<label for="profile_legende">Légende de la photo </label><br>\n\
																			<textarea rows="4" cols="40" id="legendeUp'+counter+'" value="'+legpho+'">'+legpho+'</textarea><br><br>\n\
																			<input type="submit" class="btnModifBloc"  id="modif'+counter+'"  value="Modifier"/>\n\
																			<div id="success" style=" padding-left: 15px; color: #fff; font-size:12px; background-color: greenyellow; margin-top: 10px;"></div>\n\
																			</div>\n\
																			<div class="modal-footer">\n\
																			<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>\n\
																			</div> \n\
																			</div> \n\
																			</div> \n\
																			</div>\n\
																			</div>\n\
																			</div>');
												  
												  if(eltch==0){
															setTimeout(function(){  $('#preview'+idbtn).children().children().find('#check'+counter+'-'+idbtn).attr('checked', 'checked');},400); 
														 }
												  
												$('#titleImg'+idbtn).val("");
												$('.file_name').val("");
												$('#legendeup'+idbtn).val("");
												$('#fileup'+idbtn).val(""); 
												$('#fileupdate'+idbtn).val("");  
												   
											}
										  
											  
										},
										complete: function() {
											requestRunningupd = false;
										},
										error: function (resultat, statut, erreur) {
												alert(erreur);
										}
								}); 
						   
						
						}
						else{
							alert('choisir la photo à ajouter!');
						}
					
					}
					
						event.preventDefault();
        
 
 
  
		
	        });  

			$('#btnnon').click(function(e){
		
		        $('#dialogSaveImage').modal('hide');
				
				
							var parent=$('#submitUpdate'+idedit).parent().parent().parent();
							
							var datedebut=$(parent).find('.datepickerdebutUpdate').val(); 
							var datedefin=$(parent).find('.datepickerfinUpdate').val();
							var title=$(parent).find('input[name=profile_titre_recit_update]').val(); 
							var recit=$(parent).find('textarea.recitupdate').val();
							var addep=$(parent).find('input[name=fromUpdate]').val();
							var addest=$(parent).find('input[name=toUpdate]').val()
							
							var formdata ={ID_recit:idedit,titre_recit: title,datedebut:datedebut,datedefin:datedefin,recit:recit,addep:addep,addest:addest};
							
								   $.ajax({
											url: '../wp-content/plugins/Carnet_voyages/update.php',
											type: 'POST',
											data: formdata,
											success: function (result, statut) { // success est toujours en place, bien sûr !
												   if(result!="erreur!")
												   {  
													  // alert(result);
													  location.reload();
												   }
												   
											},
											error: function (resultat, statut, erreur) {
													alert(erreur);
											}
									});
		
	        }); 


							
				  	  
			   });
			   
        </script>
        
   
   
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 
   <script>
       /* $(function () {
			var origContainer='';
            $("#popupconfirmation").dialog({
                autoOpen: false,
                width: 400,
                modal: true,
             
        });
		
            $(".boutonsupprimer").click(function (event) {
                event.preventDefault();
				 origContainer=$(this).parent();
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
        });*/
		
		$(function () {
					$(".popupconfirmation").each(function (index) {

						var origContainer = $(this).parent();

						$(this).dialog({
							autoOpen: false,
							width: 400, 
						}).parent().appendTo(origContainer);
					});

					$('.boutonsupprimer').click(function (event) {
						
						 event.preventDefault();
							
							var targetUrl = $(this).attr("href");
							var popup= $(this).parent().find("div").find(".popupconfirmation");

						$(popup).dialog({
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
						$(popup).dialog("open"); 
					});
				}); 
		
		
		
    </script>
    <script>
        

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
            
            
            
            
            
     
        });
    </script>

    
    
    
    <script> 
                 
              $(document).ready(function () {
                 
              
                
               $('#datepickerdebut').change(function () {
                    //Change code!
                    $('.div_datepickerfin').css('visibility', 'visible');
                    //$('.tableLocation').css('visibility', 'visible');
                   // $('.tableLocation').css('display', 'block');
                    $('#btn_enregistrer').val('Enregistrer cette étape');
                    //initMap();
                });
				 
				 setTimeout(function() {
				// Do something after 2 seconds
				    initMap();
				}, 3000);
                $('.localisation .markerlink').on('click',function(){
                    
                     var elt='';
                        if($(this).attr('id')=="markerlinkfrom" ){
                            elt='from';
                        }
                        else {
                            elt='to';
                        }
        
                        initAddress(elt); 
                    
                });   
                
                 $('.localisationUpdate .markerlink').on('click',function(){
                    
                     var idmap='';
                       var idmarker=$(this).attr('id').split('markerlink')[1];
                       var suffix = $(this).attr('id').match(/\d+/)[0];
                        
                         idmap='mapUpdate'+suffix;
                         
                        initAddressUpdate(idmarker,idmap); 
                      
                    
                });   
                
                
                
                $('.dashiconsUpdate').each(function(){
                    
                    $(this).click(function(){
    
                   var thispost = $(this).attr('id').split('update')[1];
                   var from='fromupdate'+thispost;
                   var to='toUpdate'+thispost;
                   var map='mapUpdate'+thispost;
                  
                   initMapUpdate(from,to,map);
                    
                 });   
                });
            $('.reset').click(function(){
               $(this).parent().parent().find('input[type=text]').each(function(){
                  $(this).attr('value','');  
                   
               });
               
            });    
                
                
                
                
        });
                
            
        function  initAddress(elt){
       
            var geocoder;
            var map;
           var markersArray = [];
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(48.50, 2.20);
            var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById("map"), myOptions);
             $("#"+elt).val(''); 
            
        function geocodePosition(pos,idelt) 
            {
               geocoder = new google.maps.Geocoder();
               geocoder.geocode
                ({
                    latLng: pos
                }, 
                    function(results, status) 
                    {
                        if (status == google.maps.GeocoderStatus.OK) 
                        {
                            $("#"+idelt).val(results[0].formatted_address);
                            //$("#mapErrorMsg").hide(100);
                        } 
                        else 
                        {
                           // $("#mapErrorMsg").html('Cannot determine address at this location.'+status).show(100);
                           alert('Cannot determine address at this location.'+status);
                        }
                    }
                );
            }
          
            var pays= document.getElementById("pays").value;  
           // var address = document.getElementById(elt).value;
            geocoder.geocode( { 'address': pays}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);

            
            
            map.addListener('click', function(e) {
               placeMarkerAndPanTo(e.latLng, map);
            });
            function placeMarkerAndPanTo(latLng, map) {
            /*  var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });*/
            // place a marker
             placeMarker(latLng);
            map.panTo(latLng);
            
            }
             function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });
            map.setCenter(marker.position);
            marker.setMap(map);
            geocodePosition(marker.getPosition(),elt);
            // add marker in markers array
            markersArray.push(marker);

            //map.setCenter(location);
        }
                // Deletes all markers in the array by removing references to them
                function deleteOverlays() {
                    if (markersArray) {
                        for (i in markersArray) {
                            markersArray[i].setMap(null);
                        }
                        markersArray.length = 0;
                     }
                }
             
         
               } 
               else {
                 alert("Geocode was not successful for the following reason: " + status);
                 }
                  });  
        }
        
         function  initAddressUpdate(elt,IDmap){
       
            var geocoder;
            var map;
           var markersArray = [];
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(48.50, 2.20);
            var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById(IDmap), myOptions);
             $("#"+elt).val(''); 
            
        function geocodePosition(pos,idelt) 
            {
               geocoder = new google.maps.Geocoder();
               geocoder.geocode
                ({
                    latLng: pos
                }, 
                    function(results, status) 
                    {
                        if (status == google.maps.GeocoderStatus.OK) 
                        {
                            $("#"+idelt).val(results[0].formatted_address);
                            //$("#mapErrorMsg").hide(100);
                        } 
                        else 
                        {
                           // $("#mapErrorMsg").html('Cannot determine address at this location.'+status).show(100);
                           alert('Cannot determine address at this location.'+status);
                        }
                    }
                );
            }
          
            var pays= document.getElementById("pays").value;  
           // var address = document.getElementById(elt).value;
            geocoder.geocode( { 'address': pays}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);

            
            
            map.addListener('click', function(e) {
               placeMarkerAndPanTo(e.latLng, map);
            });
            function placeMarkerAndPanTo(latLng, map) {
            /*  var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });*/
            // place a marker
             placeMarker(latLng);
            map.panTo(latLng);
            
            }
             function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });
            map.setCenter(marker.position);
            marker.setMap(map);
            geocodePosition(marker.getPosition(),elt);
            // add marker in markers array
            markersArray.push(marker);

            //map.setCenter(location);
        }
                // Deletes all markers in the array by removing references to them
                function deleteOverlays() {
                    if (markersArray) {
                        for (i in markersArray) {
                            markersArray[i].setMap(null);
                        }
                        markersArray.length = 0;
                     }
                }
             
         
               } 
               else {
                 alert("Geocode was not successful for the following reason: " + status);
                 }
                  });

            
            
            
        }
        
        
        
        function initMapUpdate(fromelt,toelt,mapelt)
        {
            
            
            var map = new google.maps.Map(document.getElementById(mapelt), {
          center: {lat: 48.50, lng: 2.20},
          zoom: 3
        });
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById(fromelt));
        var inputdest = /** @type {!HTMLInputElement} */(
            document.getElementById(toelt));    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var autocompletedest = new google.maps.places.Autocomplete(inputdest);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
        
        var markerdest = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
       
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div style="width:100px;"><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        autocompletedest.addListener('place_changed', function() {
          infowindow.close();
          markerdest.setVisible(false);
          var place = autocompletedest.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          markerdest.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          markerdest.setPosition(place.geometry.location);
          markerdest.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div style="width:100px;"><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, markerdest);
        });
            
            
            
            
            
        }
                
    </script>
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
  
 
        
    <div id="wpbody" role="main">
        <div id="wpbody-content" aria-label="Contenu principal" tabindex="0" style="overflow: hidden;">
            <div class="wrap">
                <?php
                global $wpdb;
                global $current_user;
                get_currentuserinfo();
                $user = $current_user->user_login;
                $id_cdv_actif = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
                $pays = $wpdb->get_var("SELECT libPaysPrincipal FROM cdv WHERE ID_cdv=$id_cdv_actif");
		        $statut = $wpdb->get_var("SELECT Statut FROM cdv WHERE ID_cdv = $id_cdv_actif ");		
                ?>
		<div id="loading" class="col-md-12 col-sm-12 col-xs-12" >
		    <!--img src='/wp-content/plugins/Carnet_voyages/images/Loading_icon.gif' alt="loading"/-->
		</div>		
		<div class="col-md-9 col-sm-9 col-xs-12 formulaire ">

    <form action="" method="post" id="post" enctype="multipart/form-data" >
        <h1> Mon carnet de voyage</h1>
        <p  class="indicObj" > *Champ de saisie obligatoire</p>
        <div class="bloc_cdv row">
            <?php
                $resultatscdv = $wpdb->get_results("SELECT titleCdv,imgCdv,txtIntroCdv,subtitleCdv,copyrightCdv,droitUtilisation,InscriNewsletter FROM cdv WHERE ID_contact = ".$user." AND ID_cdv=".$id_cdv_actif);
                 $email_cdv=  $wpdb->get_var("SELECT `emailContact` FROM cdv WHERE ID_contact = ".$user." AND ID_cdv=".$id_cdv_actif );
                foreach ($resultatscdv as $val) {
                        $titleval = $val->titleCdv;
                        $imvalurl = $val->imgCdv;
                        $introval = $val->txtIntroCdv;
                        $sous_titre_val=$val->subtitleCdv;
                        $checkbox1=$val->copyrightCdv;
                        $checkbox2= $val->droitUtilisation;
                        $checkbox3=$val->InscriNewsletter;
						$exxxx=explode('upload/',$imvalurl);
						$directorycdv = '/wp-content/plugins/Carnet_voyages/upload/';
						if($imvalurl !=""){
                        $imval=$directorycdv.$exxxx[1];
						}
						else{
							$imval="";
						}
						
                        }
                        
                   if($statut==3) {
                       $checkbox1=0;
                       $checkbox2=0;
                   }

              $time= new DateTime();
			  $time=$time->getTimestamp();			   
            ?>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="profile_titre"><?php _e('Titre du carnet', 'carnet-post-type'); ?>
            </label><label>*</label>
            <br>
            <input type="text"  spellcheck="true" name="titre" placeholder="Saisissez votre titre ici" class="regular-text titleCdv" value="<?php echo stripslashes($titleval); ?>"  >
            <label style="padding: 5px; color: red; font-size: 12px" class="errorTitlecdv"></label>   
           </div>
             <?php
                $resultats = $wpdb->get_results("SELECT libTypeCircuit FROM cdv WHERE ID_contact = $user");
                    foreach ($resultats as $post) {
                        $libtypecircuit = $post->libTypeCircuit;
                        }
                        if ($libtypecircuit == 'Libre & No') {
                    ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="profile_ss_titre"><?php _e('Sous-titre', 'carnet-post-type'); ?>
                    </label><label style="color: red;">(uniquement si voyage L&N)</label><br>
                    <input type="text" name="ss_titre" class="regular-text " value="<?php echo stripslashes($sous_titre_val); ?>"  >
                </div>
                                        
                     <?php
                    }
                    ?>
           <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="col-md-6 col-sm-12 col-xs-12 imcdv">
                   <label for="profile_image"><?php _e('Image principale', 'carnet-post-type'); ?>
                    </label><label class="grey" style="color: #a5a4a4;">(photo d'entete - min 1600x550 px)</label><label> *</label><br>
                    <input type="text"  class="regular-text" id="header" name="entete" value="<?php echo $imval; ?>"  >
                    <input type="hidden" name="entetecache" value="<?php echo $imval; ?>">
                    <!--a href="#" class="button customaddmedia">Parcourir</a-->
                    <input type="file" id="IMG_CDV" name="cdv_image" accept="image/*"/><label id="labelIMG_CDV" for="IMG_CDV">Parcourir</label>
                    <label style="padding: 5px; color: red; font-size: 12px" class="errorImgCdv"></label>
                    <input type="hidden" value="" id="cropped_image" name="cropped_image"/>
                     
 
                    <br>
					
                    
               </div>
               <div class="col-md-6 col-sm-12 col-xs-12 impreview">
                   <img id="viewIMP" src="<?php echo '..'.$imval.'?xxx='.$time; ?>" alt="" >
               </div>
			   
			   	<div id="popupPhotoLandscape" class="col-md-12 col-sm-12 col-xs-12"> 
                  	<div class="col-md-8 col-sm-8 col-xs-12"> 
					   <h4>Placer la fenetre pour recadrer l'image !</h4>
					  <div id="views"></div>
					    <div class="info">
                                                                   
                                    <label>W</label> <input type="text" id="w" name="w" />
                                    <label>H</label> <input type="text" id="h" name="h" />
                                    <button id="scalebutton" class="btn btn-primary" type="button">Echelle</button>
                                    <button id="rotatebutton" class="btn btn-primary" type="button">Tourner</button>
                                    <div class="errorhh"></div>
                                    </div>
						<button class="btn btn-primary" id="cropbutton" type="button">télécharger</button>  			
					</div>  
					<div class="col-md-4 col-sm-4 col-xs-12"> 
						<canvas id="viewIMPp" ></canvas>
						<!-- hidden crop params -->
                                                                <input type="hidden" id="x1" name="x1" />
                                                                <input type="hidden" id="y1" name="y1" />
                                                                <input type="hidden" id="x2" name="x2" />
                                                                <input type="hidden" id="y2" name="y2" />
					</div>  
                                                          
															   
                                                            
                                  
                                    
                    </div>
           </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="profile_presentation"><?php _e('Introduction de mon récit', 'carnet-post-type'); ?>
                </label><label style="color: #a5a4a4;">(max: 1000 signes)</label><label> *</label><br>
                <textarea class="presentation" rows="6" name="presentation" placeholder="Présenter votre experience!" onkeyup="javascript:MaxLengthTextarea(this, 1000);" cols="80" value="<?php echo stripslashes ($introval); ?>"  ><?php echo stripslashes ($introval); ?>
                </textarea>
                <label style="padding: 5px; color: red; font-size: 12px" class="errortxtIntroCdv"></label>
            </div> 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input class="profile_checkbox"  id="profile_checkbox1" type="checkbox" name="profile_checkbox1" <?php if ($checkbox1==1){echo ('checked="checked"'); } ?> value="<?php echo $checkbox1; ?>"  >
                        Je certifie être l’auteur ou/et avoir les droits d’utilisation des photos qui apparaitront dans mon carnet de voyage<br>
                <input class="profile_checkbox" id="profile_checkbox2" type="checkbox" name="profile_checkbox2" <?php if ($checkbox2==1){echo ('checked="checked"'); } ?>  value="<?php echo $checkbox2; ?>"  >
                    Je souhaite participer au jeu concours (et tenter de gagner un bon d'achat de xxx€) et accepte que mon carnet soit diffusé sur le site de Nomade Aventure <br>   
                <input class="profile_checkbox"  id="profile_checkbox3" type="checkbox" name="profile_checkbox3" data-toggle="modal" data-target="#popupconfirmationNewsletter"  <?php if ($checkbox3==1){echo ('checked="checked"'); } ?> value="<?php echo $checkbox3; ?>"  >
                        Je souhaite m’abonner, a la newsletter nomade. 
                       
                        <div class="modal fade  " id="popupconfirmationNewsletter"  role="dialog">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           <h4>Voulez-vous partager avec nous nos dernières nouvelles ?</h4></div>
                                                            <div class="modal-body">
                                                              <div class="form-group">
                                                                    <label for="exampleInputEmail1">Adresse Email </label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir votre émail" value="<?php echo $email_cdv;?>">
                                                                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre courrier électronique avec quelqu'un d'autre.</small>
                                                                    <label id="errorNewsl" style="padding: 5px; color: red; font-size: 12px; margin-top: 10px;"></label>
                                                                    <input type="hidden" id="ID_userN" value="<?php echo $id_cdv_actif?>">
                                                                </div>
                                                        
                                                                <button type="submit"  id="newsletterAdd" class="btn btn-primary">S'abonner</button>  
                                                                <button type="submit" id="newsletterAnnul" class="btn btn-primary">Désabonner</button> 
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                                            </div> 
                                                            </div> 
                                                            </div> 
                                                            </div>
            </div>
        </div>
        <div class="etapes_notes row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <h1>Mes étapes et mes notes</h1>
                <p class="desc">
                    Décriver les endroits et/ou les moments qui ont composé votre voyages.Les Blocs "étapes" doivent contenir au moins une date,ils seront illustrés par une carte si vous les localisez.
                    Vous pauvez aussi choisir de ne pas mettre une date et ainsi faire de simples blocs "notes" pour parler de thématique culturel ou d'impréssions générales qui apparaiteront automatiquement à la fin du récit.
                </p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 posts">
                <?php
                                    $resultats = $wpdb->get_results("SELECT  cdv.ID_cdv, titleCdv, titlePost, dateDebutPost, dateFinPost,ID_edito,ordPost,txtPost, lieuDepPost,lieuArrPost FROM cdv, cdv_editorial WHERE cdv.ID_cdv = cdv_editorial.ID_cdv AND ID_contact = $user ORDER BY ordPost ASC  ");
                                     
                          $i=0;
                          
                      
                                    foreach ($resultats as $post) {
                                        $i++; 
                                     //   if ($post->dateDebutPost != "0000-00-00") {
                                        
                                            $idedito=$post->ID_edito;
                                            $idP=$post->ID_cdv;
                                            $deb = $idP . $idedito;
                                            $ipt = 1;
                                            //$pp = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $idP . "'");
                                            $datepp = $post->dateDebutPost;
                                            $datefp = $post->dateFinPost;
                                            $depart=$post->lieuDepPost;
                                            $destinat=$post->lieuArrPost;
                                            $nice_date = date('d F', strtotime($datepp));
                                            $titlpost = $post->titlePost;
                                            $txtpost = $post->txtPost;
                                            $id_media = $wpdb->get_var("SELECT ID_media  FROM cdv_media WHERE IsPhotoPrincipal='" . $ipt . "' and nom_fichier LIKE '%$deb%' and ID_cdv ='" . $idP . "'");
                                            $ord=$post->ordPost;

                ?>
                <div id="post-<?php echo "".$ord."-".$idedito; ?>" class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px !important;">
                <div id="droppable-<?php echo "".$ord."-".$idedito; ?>" class="col-md-12 col-sm-12 col-xs-12 droppable over"   style=" display: none;">
                    <div class="col-md-9 col-sm-9 col-xs-9 overchild" >
                         
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0px !important; height: 100%;" >
                       
                            <span class="indicSup">Supprimer ce post</span>
                            <a href="" style="color: black;" class="lienstylebouton boutonsupprimerover" name="ddelete"><span class="dashicons dashicons-no"></span></a>
                            <span class="indicdrag"></span>
                            <span class="dashicons dashicons-menu"></span>
                              
                        <div class="firstupdate">
                            <span class="indicUpadate">Modifier le contenu </span> 
                            <span class="dashicons  dashicons-controls-play dashiconsUpdateover" id="" name="update"></span>
                        </div> 
                    </div>
                </div> 
                <div id="<?php echo "".$ord."-".$idedito; ?>" class="col-md-12 col-sm-12 col-xs-12 draggable" draggable="true"  style="border: 1px solid #ddd;">
                    <div class="col-md-9 col-sm-9 col-xs-9 pres" >
                      <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;
                          <?php 
							if($datepp != "0000-00-00"){
						   if(($datefp=='0000-00-00')||($datefp==$datepp) ){
                              echo '<em> '.stripslashes($titlpost).' : </em> <span>' .date("d-m-Y", strtotime($datepp)).'</span>';
							  }else 
								  echo '<em> '.stripslashes($titlpost).' : </em> <span>' .date("d-m-Y", strtotime($datepp)).' - '.date("d-m-Y", strtotime($datefp)) .'</span>'; 
							}
							else{
								echo'<em> '.stripslashes($post->titlePost).'  </em>' ;
							}
							
                           ?>   
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0px !important; height: 100%; position:relative;" >
                       
                            <span class="indicSup">Supprimer ce post</span>
                            <a href="../wp-content/plugins/Carnet_voyages/suppression.php?postID=<?php echo $idP; ?>&idedt=<?php echo $idedito; ?>" style="color: black;" class="lienstylebouton boutonsupprimer" name="ddelete"><span class="dashicons dashicons-no"></span></a>
                            <span class="indicdrag">Modifier l'ordre de mes contenus</span>
                            <span class="dashicons dashicons-menu"></span>
                            <div class="popupconfirmation" title="Confirmation du suppression" style="display: none;">
                                 <p>Êtes-vous sûr de vouloir supprimer ce post ?</p>
                            </div>  
                        <div class="firstupdate">
                            <span class="indicUpadate">Modifier le contenu </span> 
                            <span class="dashicons  dashicons-controls-play dashiconsUpdate" id="update<?php echo $idedito ?>" name="update"></span>
                        </div> 
                    </div>
                </div>  
           
                <div class="col-md-12 col-sm-12 col-xs-12 secondupdate" style=" background-color: #fff; border: 1px solid #ddd;">
                    <div>
                        <div class="col-md-7 col-sm-7 col-xs-12 " style="padding-right:0px !important; padding-left: 0px !important; padding-top: 30px; ">
                            <div class=" postupdate" style='width: 100%;'>
                                <div>
                                    <label for="profile_datedupdate"><?php _e('Date de l\'étape', 'carnet-post-type'); ?>
                                    </label><br>
									<input type="hidden" class="datepickerdebutHidden" value="<?php if($datepp!="0000-00-00")echo date("d-m-Y", strtotime($datepp)); ?>">
                                    <input id="datepickerdebutUpdate<?php echo $idedito ?>" class="datepickerdebutUpdate" name="profile_datedupdate" style="height: 30px;" value="<?php if($datepp!="0000-00-00")echo date("d-m-Y", strtotime($datepp)); ?>">
                                    
									<br>
                                    <label id='lab_datefupdate' for="profile_datefupdate"><?php _e('Date de fin', 'carnet-post-type'); ?>
                                    </label><br>
									<input type="hidden" class="datepickerfinHidden" value="<?php if($datefp!="0000-00-00")echo date("d-m-Y", strtotime($datefp)); ?>">
                                    <input id="datepickerfinUpdate<?php echo $idedito ?>" class="datepickerfinUpdate" name="profile_datefupdate" style="height: 30px;" value="<?php if($datefp!="0000-00-00")echo date("d-m-Y", strtotime($datefp)); ?>">
                                    
									<div>
				    <label style="padding: 5px; color: red; font-size: 12px; margin-top: 10px;" class="errordateFinupdate"></label>
				    </div>                
                                </div> 
                                <div style="margin-bottom: 30px; margin-top: 30px;">
                                    <label for="profile_titre_recit_update" style="margin-top:20px;"><?php _e('Titre', 'carnet-post-type'); ?>
                                    </label><label style="margin-top:20px;">*</label><br>
									<input type="hidden" class="titrerecitHidden" value="<?php echo stripslashes($titlpost);//utf8_encode($titlpost); ?>">
                                    <input id="titrerecit<?php echo $idedito ?>" type="text" name="profile_titre_recit_update"  style="font-size: 1.7em; width: 95%; " size="30" class="regular-text" value="<?php echo stripslashes($titlpost);//utf8_encode($titlpost); ?>" >                    
									
								</div>
                                <div>
                                    <label for="profile_titre_recit_ancien"></label>
                                    <input  type="hidden" name="profile_titre_recit_ancien" size="30" class="regular-text" value="<?php echo stripslashes($info->titlePost);//utf8_encode($info->titlePost); ?>" > 
                                </div>
                                <div>
                                   <label for="profile_recitupdate"><?php _e('Récit', 'carnet-post-type'); ?>
                                    </label><label>*</label><br>
									
                                    <textarea id="recitintr<?php echo $idedito ?>" rows="10" cols="35" name="profile_recitupdate" class="recitupdate" value=""> <?php echo stripslashes($txtpost); ?></textarea>
                                    <input type="hidden" class="recitHidden" value="<?php echo  stripslashes($txtpost);?>">                 
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 tableLocationUpdate" style="padding-right:0px !important; padding-left: 0px !important; padding-top: 10px; ">
                            <div  class="localisationUpdate">
                            
                                <div style=" background: #ccc; margin: 10px; height: 115px;">   
                                    <label for="fromUpdate"><?php _e('Saisir lieu ou point de départ', 'carnet-post-type'); ?>  <sup>*</sup>
                                    </label><br>
                                    <input id="fromupdate<?php echo $idedito ?>" class="fromupdate" placeholder="Entrer lieu " name="fromUpdate" size="30" style="font-size: 1.7em;width: 90%; margin-left: 10px;" class="placepicker form-control" required=""  type="text" placeholder="Indiquez un lieu" value="<?php echo stripslashes($depart); //htmlentities($depart)  ?>" />
									<input type="hidden" class="fromHidden" value="<?php echo  stripslashes($depart); ?>"> 
                                    <!--i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span id="markerlink">ou cliquer ici,puis pointer sur la carte </span-->
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span class="markerlink" id="markerlinkfromupdate<?php echo $idedito ?>" >ou cliquer ici, puis pointer un endroit sur la carte </span>
                                </div>
                                <div style=" background: #ccc; margin: 10px; height: 115px;">    
                                    <label for="toUpdate"> <?php _e("Saisir lieu ou point d'arrivée", 'carnet-post-type'); ?>  <sup>*</sup>
                                    </label><br>
                                    <input  id="toUpdate<?php echo $idedito ?>" class="toUpdate"  name="toUpdate" size="30" class="placepicker2 form-control" required=""  type="text" placeholder="Indiquez un lieu" style="font-size: 1.7em;width: 90%; margin-left: 10px;" value="<?php echo stripslashes($destinat); //htmlentities($destinat)  ?>"  /> 
                                    <input type="hidden" class="toHidden" value="<?php echo  stripslashes($destinat); ?>"> 
									<i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="markerlink" id="markerlinktoUpdate<?php echo $idedito ?>" >ou cliquer ici, puis pointer un endroit sur la carte </span>
                                </div>
                                <div id="mapUpdate<?php echo $idedito ?>" style="height: 341px; margin-left: 9px;margin-right: 9px;"></div>                              
                                <div id="mapAct">
							
                                <!--input  type="submit" style="font-size: 9px;float: left; margin-top: 10px;"class="" value="Enregistrer les localisations de ce post" /-->
                                <input class="reset" style="font-size: 10px;float: right;text-decoration: underline;background: #eee;  margin-top: 7px;" type="reset" class="buttonreset"/>
                                <p id="error"></p>
                                </div>
                            </div>
                            
                        </div>  
                    </div>
                
                    <div class="col-md-12 col-sm-12 col-xs-12" style="  margin-top: 14px;padding: 0px !important;">
                            <div style="height:  37px; background: #fff; color: #000; border: 1px solid #ddd; ">
                               <div style="float:left;padding: 5px;">&nbsp;&nbsp;<em> Album photo de ce post</em> </div>

                                <div style="float:right; padding: 0px 10px;">
                                <span class="dashicons  dashicons-controls-play dashiconsPhoto" ></span>
                                </div>
                            </div>
                           <div class="AlbumForm" style=" margin-bottom: 16px; background: #fff; color: #000; border: 1px solid #ddd;overflow: auto; ">
                               <div class="col-md-6 col-sm-12 col-xs-12" style="/*width:50%;*/ /*border:1px solid #ddd; */   float: left;   padding: 15px;">
                                <div style="overflow: hidden;">
                                <label for="profile_album"><?php _e('Album photo', 'carnet-post-type'); ?></label><br>
                                <input type="text" class="regular-text file_name " name="addupdatephoto" value="">
                                <input type="file" class="fileupdate" id="fileupdate<?php echo$idedito?>" name="user_image" accept="image/*"/><label style="background: #eee;" for="fileupdate<?php echo$idedito?>">Parcourir</label><br>
                                </div>
                                <div>
                                <label for="profile_titre_photo"><?php _e('Titre de la photo', 'carnet-post-type'); ?>
                                </label><label>*</label><br>
                                <input type="text" id="titleImg<?php echo$idedito?>" class="titleImg" name="profile_titre_photo_update" size="30" class="regular-text titleImg" value="<?php echo $titre_photo; ?>" >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorTitleImg<?php echo$idedito?>"></label>
                                <br>
                                </div>
                                <label for="profile_legende"><?php _e('Légende de la photo', 'carnet-post-type'); ?>
                                </label><br>
                                <textarea rows="4" cols="40" name="profile_legende_update" id="legendeup<?php echo$idedito?>" class="legende" value="<?php echo $legende; ?>"></textarea><br><br>
                                <input type="submit" class="submit_image_update" name='submit_image' id="imageenrg<?php echo$idedito?>" value="Ajouter l'image à la galerie de ce poste"/>
                               </div> 
                                <?php
                                $id_cdv_actif_im = $wpdb->get_var("SELECT LAST_INSERT_ID(ID_cdv) as id FROM cdv WHERE ID_contact = $user  ORDER BY ID_cdv DESC");
                                $idp = $wpdb->get_results("SELECT * FROM cdv_media WHERE nom_fichier LIKE '$deb%' and ID_cdv ='" . $id_cdv_actif_im. "' ORDER BY ID_media ASC");

                                ?>
                               
                                <div class="col-md-6 col-sm-12 col-xs-12 previewalbum" id="preview<?php echo$idedito?>" style="/*width:50%;*/float: right; padding: 15px;    border-left: 1px solid #ddd;  overflow: auto;">
                                    <div>
                                         <?php  
                                         
                                                        foreach ($idp as $p) {
                                                         $directory = '/wp-content/plugins/Carnet_voyages/upload/';	
                                                         $url=$directory.$p->nom_fichier;
                                                         $counter= $p->ID_media;
                                                         $ph_princ=$p->IsPhotoPrincipal;
                                         
                                                         ?>
                                                        <div id="parent<?php echo $counter;?>" style="background-color: #ddd;margin:5px;width: 115px; height: 240px; margin-bottom: 44px;font-size:11px;float:left; " >
                                                            <img style="width: 105px;height: 105px; float:left;margin:5px;" src="<?php echo $url;?>" alt="" class="img-responsive"></img>
                                                            <!--h4 class="myTitle" id="titrePho<?php echo $counter;?>" style="padding: 5px;text-align:center; margin-bottom:5px;width: 95px;margin: auto;height: 130px;font-weight: bold;font-style: normal;color: #666666;"><?php echo stripslashes($p->titleImg);?></h4--><br>
                                                            <input type="hidden" class="myTitle" id="titrePho<?php echo $counter;?>"  value="<?php echo stripslashes($p->titleImg);?>"> 
															<input class="mylegende" id="mylegende<?php echo $counter;?>" type="hidden" value="<?php echo stripslashes($p->txtImg);?>">
                                                            <!--input class="myfile" id="myfile<?php echo $counter;?>" type="hidden" value="'+dateajout+'"-->
                                                            <input class="chekboxupdate" id="check<?php echo$counter.'-'.$idedito ?>" style="    margin-bottom: 15px; margin-left: 4px;font-size: 8px;margin-right: 0px;margin-top: 11px;" type="radio" name="radio<?php echo$idedito; ?>" class="radio" value="" <?php if($ph_princ==1){ echo ('checked="true"'); }?> > Photo principale</input><br>
                                                            <span id="<?php echo $counter;?>"  style="padding: 5px; color:#72777c; text-decoration: underline;margin-bottom:8px;    cursor: pointer;" class="ModifPhotoAlbum" data-toggle="modal" data-target="#myModal<?php echo $counter;?>" > Modifier la photo</span><br><br>
                                                            <!--span   style="padding: 5px;color:#72777c;  cursor: pointer;" class="SupPhotoAlbum" > Supprimer la photo</span><br-->
                                                             <span  id="idSup<?php echo$counter ?>"  style="padding: 5px;color:#72777c;  cursor: pointer;"  class="SupPhotoAlbumBlocUPd " > Supprimer la photo</span><br>
                                                            <div class="container">
                                                            <div class="modal fade myModal " id="myModal<?php echo $counter;?>"  role="dialog">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h3 class="modal-title">Modifier les informations de votre photo </h3></div>
                                                            <div class="modal-body">
                                                            <div>
                                                            <label for="profile_titre_photo"> Titre de la photo </label><br>
                                                            <input type="text" size="30" class="regular-text titleImg" value="<?php echo stripslashes($p->titleImg)?>" >
                                                            <br>
                                                            </div>
                                                            <label for="profile_legende">Légende de la photo </label><br>
                                                            <textarea rows="4" cols="40" id="legendeUp<?php echo $counter;?>" value="<?php echo stripslashes($p->txtImg)?>"><?php echo stripslashes($p->txtImg)?></textarea><br><br>
                                                            
                                                            <input type="submit" class="btnModifBloc"  id="modif<?php echo$counter ?>"  value="Modifier" style="background-color: #0085ba; color:#fff; font-size: 13px; border-radius: 3px;"/>
                                                            <div id="success" style=" padding-left: 15px; color: #fff; font-size:12px; background-color: greenyellow; margin-top: 10px;"></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                                            </div> 
                                                            </div> 
                                                            </div> 
                                                            </div>
                                                            </div>
                                                            </div>
                                        
                                        <?php
                                       
                                        } 
                                        ?>
                                    </div>
                                </div>
                           </div>
                           
                       </div>
                        
                   <div class="col-md-12 col-sm-12 col-xs-12 ActionUpdateRecit" style="background-color: #f1f1f1;height: 70px; border: 1px solid #ddd;padding: 0px !important; margin-bottom: 15px" >
                        <div style="width:50%; margin: auto; text-align: center;padding-top: 8px;">
                                
                                 <input class="submitUpdate" id="submitUpdate<?php echo$idedito?>" type="submit" value="Modifier Mon Récit" name="submitUpdate">
                                
                                
                                <input class="submitUpdateAnnuler" id="annuler<?php echo$idedito?>" type="button" value="Annuler" name="annuler"/>
                                 
                        </div>
                    </div>
                </div>      
                <div class="col-md-12 col-sm-12 col-xs-12 TRvide"></div>
                 <?php
            if ($i== count($resultats)){
            ?>
              
               <div id="droppable_end-<?php echo "".$ord."-".$idedito; ?>" class="col-md-12 col-sm-12 col-xs-12 droppable over"   style=" display: none;">
                    <div class="col-md-9 col-sm-9 col-xs-9 overchild" >
                         
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0px !important; height: 100%;" >
                       
                            <span class="indicSup">Supprimer ce post</span>
                            <a href="" style="color: black;" class="lienstylebouton boutonsupprimerover" name="ddelete"><span class="dashicons dashicons-no"></span></a>
                            <span class="indicdrag"></span>
                            <span class="dashicons dashicons-menu"></span>
                              
                        <div class="firstupdate">
                            <span class="indicUpadate">Modifier le contenu </span> 
                            <span class="dashicons  dashicons-controls-play dashiconsUpdateover" id="" name="update"></span>
                        </div> 
                    </div>
                </div>      
              <?php
            }
            ?>
                </div>
                  <?php    
                   // }//end post
                 
                  
                  
                    }     
                        //debut notes                                    
                   ?>         
									 
                
   
   
   
   
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 nouveauContenu">
                <div class="col-md-12 col-sm-12 col-xs-12 nouveauPost" width="100%" style="height: 45px; background: #fff; color: #000; border: 1px solid #ddd; ">  
                    <div class="col-md-9 col-sm-9 col-xs-9 pres">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;<em>Nouveau contenu</em>   
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0px !important; height: 100%;" >
                          <span class="dashicons  dashicons-controls-play dashiconsNouveau" ></span>  
                    </div>  
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12 postRecit">
                    <div class="col-md-7 col-sm-7 col-xs-12" style="padding: 0px !important; margin-top: 15px;">
                       <div class="recitTab">
                           <div style="width: 100%; margin-top: 10px; overflow: hidden;">
                               <div style="float: left; width: 50%;">
                                        <label for="profile_dated"><?php _e('Date de l\'étape', 'carnet-post-type'); ?>
                                        </label><br>
                                        <input id="datepickerdebut" name="profile_dated" style=" height: 32px;" value="<?php echo $datedeb; ?>">
                                        <input type="hidden" id="datedep" name="datedep" value="<?php echo $datedep; ?>">
                                </div>                         
                               <div class=" div_datepickerfin" style="float:right; width: 50%;">
                                <label for="profile_datef"><?php _e('Date de fin', 'carnet-post-type'); ?>
                                </label><br>
                                <input id="datepickerfin" name="profile_datef" style="height: 32px;" value="<?php echo $datef; ?>">
                                <input type="hidden" id="dateret" name="dateret" value="<?php echo $dateret; ?>">
                                <label style="padding: 5px; color: red; font-size: 12px; margin-top: 10px;" class="errordateFin"></label>
                               </div>
                                                              
                           </div>
                           
                           <div style="width: 100%;">
                                <label style="margin-top: 60px;" for="profile_titre_recit"><?php _e('Titre ', 'carnet-post-type'); ?>
                                </label><label style="color: #a5a4a4;margin-top: 60px;"> (unique) </label><label style="margin-top: 60px;">*</label><br>
                                <input type="text" name="profile_titre_recit" size="30" placeholder="titre de récit"class="regular-text titlePost" value="<?php echo $titre_recit; ?>" >
                                <label style="padding: 5px;  margin-bottom: 60px;color: red; font-size: 12px" class="errorTitlePost"></label>
                           </div>
                           <div style="width: 100%;    margin-top: 40px;">
                                
                                <label for="profile_recit"><?php _e('Récit', 'carnet-post-type'); ?> 
                                </label><br>
                                <textarea rows="10" style="margin-bottom: 60px;" name="profile_recit" id="recit" value="<?php echo $txt_recit; ?>"></textarea>
                           </div>
                       </div> 
                       
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 tableLocation" style="padding:0px !important; margin-top: 25px;">
                        
                        <div  style="height: 40px; background: #fff; color: #000; border: 1px solid #ddd; ">
                            <div style="float:left;padding: 5px;">&nbsp;&nbsp;<em>Localisation de ce post</em> </div>
                                <div style="float:right;">
                                    <span class="dashicons  dashicons-controls-play dashiconsMap" ></span>
                                </div>
                        </div>
                        <div class="localisation">
		            <input type="hidden" id="pays" value="<?php echo $pays; ?>"/>
                            <div style=" background: #ccc; margin: 10px; height: 111px;">   
                                <label for="from"> Saisir lieu ou point de départ <sup>*</sup>
                                </label><br>
                                <input id="from" placeholder="Entrer lieu " name="from" size="10" class="placepicker form-control" required=""  type="text" placeholder="Indiquez un lieu" /> 
                                
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="markerlink" id="markerlinkfrom" >ou cliquer ici, puis pointer un endroit sur la carte </span>
                            </div>
                             <div style=" background: #ccc; margin: 10px; height: 111px;">    
                                <label for="adarrivee"> Saisir lieu ou point d'arrivée <sup>*</sup>
                                </label><br>
                                <input id="to" placeholder="Entrer lieu " name="to" size="10" class="placepicker2 form-control" required=""  type="text" placeholder="Indiquez un lieu"  /> 
                                
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="markerlink" id="markerlinkto">ou cliquer ici, puis pointer un endroit sur la carte </span>
                            </div> 
			
                            <div id="map" style="height: 244px; width: 94%; margin: auto;"></div>
                                <div id="mapAct">
							
                                <!--input  type="submit" style="font-size: 9px;float: left; margin-top: 10px;"class="" value="Enregistrer les localisations de ce post" /-->
                                <input class="reset" style="font-size: 10px;float: right;text-decoration: underline;background: #eee;  margin-top: 7px;" type="reset" class="buttonreset"/>
                                <p id="error"></p>
                                </div>
                            
                        </div>
                    
                   
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="  margin-top: 14px;padding: 0px !important;">
                            <div style="height:  37px; background: #fff; color: #000; border: 1px solid #ddd; ">
                               <div style="float:left;padding: 5px;">&nbsp;&nbsp;<em> Album photo de ce post</em> </div>

                                <div style="float:right; padding: 0px 10px;">
                                <span class="dashicons  dashicons-controls-play dashiconsPhoto" ></span>
                                </div>
                            </div>
                           <div class="AlbumForm" style=" margin-bottom: 16px; background: #fff; color: #000; border: 1px solid #ddd;overflow: auto; ">
                               <div class="col-md-6 col-sm-12 col-xs-12" style="/*width:50%;*/ /*border:1px solid #ddd; */   float: left;   padding: 15px;">
                                <div style="overflow: hidden;">
                                <label for="profile_album"><?php _e('Album photo', 'carnet-post-type'); ?></label><br>
                                <input type="text" class="regular-text file_name " name="options[album]" value="">
                                <input type="file" id="file" name="user_image" accept="image/*"/><label style="background: #eee;" for="file">Parcourir</label><br>
                                </div>
                                <div>
                                <label for="profile_titre_photo"><?php _e('Titre de la photo', 'carnet-post-type'); ?>
                                </label><label>*</label><br>
                                <input type="text" id="titleImg" class="titleImg" name="profile_titre_photo" size="30" class="regular-text titleImg" value="<?php echo $titre_photo; ?>" >
                                <label style="padding: 5px; color: red; font-size: 12px" class="errorTitleImg"></label>
                                <br>
                                </div>
                                <label for="profile_legende"><?php _e('Légende de la photo', 'carnet-post-type'); ?>
                                </label><br>
                                <textarea rows="4" cols="40" name="profile_legende" class="legende" value="<?php echo $legende; ?>"></textarea><br><br>
                                <input type="submit" class="submit_image" name='submit_image' id="imageenrg" value="Ajouter l'image à la galerie de ce poste"/>
                               </div>
                                <div class="col-md-6 col-sm-12 col-xs-12" id="preview" style="/*width:50%;*/float: right; padding: 15px;    border-left: 1px solid #ddd; display: none; overflow: auto;">
                                    <div>

                                    </div>
                                </div>
                           </div>
                           
                       </div>
                    
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 postAction" style=" background: #eee; color: #000; border: 1px solid #ddd; height: 60px; ">
                        
                            <input id="btn_enregistrer" type="submit" value="Enregistrer cette note" name="enregistrer"> 

                </div>
                <div id="appendbtn" class="col-md-12 col-sm-12 col-xs-12">
                   
                    <div>
                    <div id="colAjout">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <input id="btn_ajout" type="submit" value="Ajouter une étape ou une note " name="note">
                    </div>
                    </div>

               
                </div>
                
			
                
            </div>
        </div>
       
    
  
                               
    </form>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 enregistrement">
                         <div class='blocENG'>
                             <div class="first">
                               <h6>Enregistrement de mon carnet </h6> 
                                  <span class="dashicons dashicons-engBloc dashicons-controls-play"></span>
                             </div> 
                             <div class="second">
                                 <div class='apercu'>
                                     <?php
									  
                                        $resid = $wpdb->get_results("SELECT  ID_cdv,Statut FROM cdv WHERE ID_contact = '".$user."' ORDER BY ID_cdv DESC LIMIT 1");                             
                                            foreach ($resid as $postid) {
                                                $urlpermalink="../?page_id=10243&id_cdv=".$postid->ID_cdv;
												$id_cdv=$postid->ID_cdv;
                                                $etat=$postid->Statut;
                                            }
					$cdv_version_actif = $wpdb->get_var("SELECT ID_cdv_version FROM cdv_version WHERE ID_cdv_version = ($id_cdv + (-2)) AND ID_cdv_version LIKE '%copie%'");
                                            if($etat==0){
                                                $pubStat='Brouillon';
                                            }
                                            elseif ($etat==1) {
                                                $pubStat='Brouillon';
                                            }
                                            elseif ($etat==2 && $cdv_version_actif==Null) {
                                                $pubStat='Attente de validation';
                                            }
											elseif (isset($cdv_version_actif) && $etat==2 ){
												$pubStat='Rejeté';
											}
                                            else{
                                                $pubStat='Publié';
                                            }
                                          
                                     ?>
                                    <a target="_blank" href="<?php echo ($urlpermalink);  ?>" >Aperçu</a>
                                    <span class='descr'>
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                         <span> <em> Etat : </em><?php echo $pubStat;  ?></span>
                                    </span>
                                    
                                 </div>
                                    <?php
                                        if($pubStat=='Brouillon'||$pubStat=='Attente de validation')
                                        {
                                            ?>
                                            <div class="appBtn">
                                              <input id="btn_publier" class="ENGB" type='button' value=" Demander la publication " name="EnregistrerBrouillon"/>
                                            </div>
                                            <div class="notif"><p>Pour demander la publication de votre carnet sur le blog, vous devez certifier que vous êtes l’auteur des photos, et participer au jeu Nomade Aventure</p></div>
                                            <?php
                                        }
                                      
                                    ?>
                                 
                             </div>              
                         </div> 
						 
						 

    </div>

            </div>
        </div>
    </div>
    
  <!-- modal confirm save edited posts --> 
				<div class="container">
					<div class="modal fade" id="dialogSavePost"  role="dialog">
										    <div class="modal-dialog">
										        <div class="modal-content">
										            <div class="modal-header">
										           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										            </div>
										            <div class="modal-body">
										               <p style="color: #000; text-align:center;">Souhaitez-vous enregistrer le post en cours d’édition avant de publier votre carnet ? </p>
										              
										            <div class="modal-footer">
										               
										                <input type='button'  class="btn btn-primary" value='Oui' id='btnyes' />
										                <input type='button'  class="btn btn-primary" value='Non' id='btnno' />
										            </div>
										        </div>
										    </div>
										</div>
		            </div>
					</div>	    
      <!-- modal confirm save images  --> 
				<div class="container">
					<div class="modal fade" id="dialogSaveImage"  role="dialog">
										    <div class="modal-dialog">
										        <div class="modal-content">
										            <div class="modal-header">
										           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										            </div>
										            <div class="modal-body">
										               <p style="color: #000; text-align:center;">Voulez-vous ajouter l’image en cours à la galerie avant de modifier votre récit ? </p>
										              
										            <div class="modal-footer">
										               
										                <input type='button'  class="btn btn-primary" value='Oui' id='btnoui' />
										                <input type='button'  class="btn btn-primary" value='Non' id='btnnon' />
										            </div>
										        </div>
										    </div>
										</div>
		            </div>
					</div> 	    
    						 
             
        
         
 
        <?php   $datedep = $wpdb->get_var("SELECT  dateDepart FROM cdv WHERE ID_contact = $user");
                $dateret = $wpdb->get_var("SELECT  dateRetour FROM cdv WHERE ID_contact = $user");
        ?>
     
        
        <script>
                var min=new Date(<?php echo "'".$datedep."'"; ?>);
                var max=new Date(<?php echo "'".$dateret."'"; ?>);
                                               
        </script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
          
            
            tinymce.init({
            selector: ".recitupdate",
			height: '190',
            setup: function (editor) {
            editor.on('change', function () {
            editor.save();
            });
            }
            });     
           tinymce.init({
            selector: "#recit",
			height: '190',
            setup: function (editor) {
            editor.on('change', function () {
            editor.save();
            });
            }
            });
		    

		
        </script>
        
        <?php   
         
        $resultatsdates = $wpdb->get_results("SELECT dateDebutPost,dateFinPost FROM cdv_editorial WHERE  ID_cdv=".$id_cdv_actif);
                $array=array();
                $arraydebutdates=array();
                function pad($s) { return ($s < 10) ? '0' + $s : $s; }
                foreach ($resultatsdates as $val) {
                    $postdateFin=date('d-m-Y', strtotime($val->dateFinPost));
                    $postdateDebut=date('d-m-Y', strtotime($val->dateDebutPost));
                    $dateavecajout = date('d-m-Y', strtotime($val->dateDebutPost . "+1 days"));
                     //$dateavecajout = date('Y-m-d', strtotime($dateavecajout . "+1 days"));                
                       
                   while ( $dateavecajout < $postdateFin){
                    if($val->dateFinPost !="0000-00-00" || $val->dateDebutPost < $val->dateFinPost){
						
						array_push($array, $dateavecajout);
						array_push($arraydebutdates, $postdateDebut);  
					}
                    $dateavecajout = date('d-m-Y', strtotime($dateavecajout . "+1 days"));
                   
                 }
                
                }
        

        ?>
       <script>
            
            
             $(document).ready(function () {
                 
                 
                
                    
                 var disabledDays =[];
                disabledDays= <?php echo json_encode($array); ?>;
              
                 var datesdebutexistants=[];
                 datesdebutexistants=<?php echo json_encode($arraydebutdates); ?>;
           // console.log(disabledDays);
             //console.log(datesdebutexistants);
                
             $("#datepickerdebut").datepicker({dateFormat: 'dd-mm-yy',minDate: min,maxDate: max, navigationAsDateFormat: true,beforeShowDay:renove, buttonImage: '../wp-content/plugins/Carnet_voyages/img/u54.png', buttonImageOnly: false, showOn: 'both'});
   
             $("#datepickerfin").datepicker({dateFormat: 'dd-mm-yy',minDate: min,maxDate: max, navigationAsDateFormat: true,beforeShowDay:renove, buttonImage: '../wp-content/plugins/Carnet_voyages/img/u54.png', buttonImageOnly: false, showOn: 'both'});
             $(".datepickerdebutUpdate").datepicker({dateFormat: 'dd-mm-yy',minDate: min,maxDate: max, navigationAsDateFormat: true,beforeShowDay:renove, buttonImage: '../wp-content/plugins/Carnet_voyages/img/u54.png', buttonImageOnly: false, showOn: 'both'});

             $(".datepickerfinUpdate").datepicker({dateFormat: 'dd-mm-yy',minDate: min,maxDate: max, navigationAsDateFormat: true,beforeShowDay:renove, buttonImage: '../wp-content/plugins/Carnet_voyages/img/u54.png', buttonImageOnly: false, showOn: 'both'}); 
             
           
  
            
                   function renove(date){
                               
                                var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
                                return [ disabledDays.indexOf(string) == -1 ]
                            } 
                     function pad(s) { return (s < 10) ? '0' + s : s; }
					 
					 // change action of datepickerfin
                $('#datepickerfin').change(function () {
                        // control of date
                     var   $debutPost = $('#datepickerdebut').datepicker('getDate');
                     var    $finPost = $('#datepickerfin').datepicker('getDate');
                    
                         var   currentDate = new Date($debutPost.getTime());
                      
                               currentDate.setDate($debutPost.getDate() + 1);
                         var   between = [];

                        while (currentDate < $finPost) {
                            
                             var    vv = [pad(currentDate.getDate()), pad(currentDate.getMonth()+1),currentDate.getFullYear() ].join('-');
                               between.push(vv);
                         
                               currentDate.setDate(currentDate.getDate() + 1); 
                        } 
                                             
                     //*****************************************
                      var myvarcheck;
                     var anyMatchInArray = (function () {
                                        "use strict";

                                        var targetArray, func;

                                        targetArray = disabledDays;
                                        func = function (checkerArray) {
                                            var found = false;
                                            for (var i = 0, j = checkerArray.length; !found && i < j; i++) {
                                                if (targetArray.indexOf(checkerArray[i]) > -1) {
                                                    found = true;
                                                    
                                                }
                                            }
                                            return found;
                                        };

                                        return func;
                                    }());


                                    var tests = [between], i, j, cur;

                                    for (i = 0, j = tests.length; i < j; i++) {
                                        cur = tests[i];
                                       myvarcheck=anyMatchInArray(cur);
                                        
                                    }
                                    
                                    
                                      var anyMatchInArrayofStart = (function () {
                                        "use strict";

                                        var targetArray, func;

                                        targetArray = datesdebutexistants;
                                        func = function (checkerArray) {
                                            var found = false;
                                            for (var i = 0, j = checkerArray.length; !found && i < j; i++) {
                                                if (targetArray.indexOf(checkerArray[i]) > -1) {
                                                    found = true;
                                                    
                                                }
                                            }
                                            return found;
                                        };

                                        return func;
                                    }());
                                    
                                     var   currentStartDate = new Date($debutPost.getTime());
                                            currentStartDate.setDate($debutPost.getDate());
                      
                                       var testdeb=[];
                      
                            
                             var    vvv = [pad(currentStartDate.getDate()), pad(currentStartDate.getMonth()+1),currentStartDate.getFullYear() ].join('-');
                               testdeb.push(vvv);
                                    
                                   var testsff = [testdeb];
                                    
                                    var checkdeb=anyMatchInArrayofStart(testsff[0]);
                   
                     //***************************************
                     
                     
                     
                        if ($debutPost > $finPost)
                        {
                            //alert('debut doit etre inf');
                            $('.errordateFin').text('La date doit etre supérieur au date debut!');
                            $('.errordateFin').css("display", "block");
                            $('.errordateFin').css("visibility", "visible");
                            $('#datepickerfin').val("");
                        }else if (myvarcheck==true) {
                           $('.errordateFin').text("cette période contient des dates déjà reservé par d'autes posts!");
                            $('.errordateFin').css("display", "block");
                            $('.errordateFin').css("visibility", "visible");
                            $('#datepickerfin').val(""); 
                         }
                         else if ((checkdeb==true) && ($debutPost < $finPost) ) {
                            $('.errordateFin').text("cette période contient des dates déjà reservé par d'autes posts! Vous pouvez ajouter qu'une activité d'un seul jour avec cette date de début!");
                            $('.errordateFin').css("display", "block");
                            $('.errordateFin').css("visibility", "visible");
                            $('#datepickerfin').val(""); 
                         }
                        else
                        {
                        $('.errordateFin').css("visibility", "hidden");
                        }
                });          
             $('.datepickerfinUpdate').change(function () {
				 var id=$(this).attr('id').split('datepickerfinUpdate')[1];;
				 
                        // control of date
                     var   $debutPost = $('#datepickerdebutUpdate'+id).datepicker('getDate');
                     var    $finPost = $('#datepickerfinUpdate'+id).datepicker('getDate');
                    
                         var   currentDate = new Date($debutPost.getTime());
                               currentDate.setDate($debutPost.getDate() + 1);
                         var   between = [];

                        while (currentDate < $finPost) {
                            
                             var    vv = [currentDate.getFullYear(), pad(currentDate.getMonth()+1),pad(currentDate.getDate()) ].join('-');
                               between.push(vv);
                         
                               currentDate.setDate(currentDate.getDate() + 1); 
                        } 
                                            
                     //*****************************************
                      var myvarcheck;
                     var anyMatchInArray = (function () {
                                        "use strict";

                                        var targetArray, func;

                                        targetArray = disabledDays;
                                        func = function (checkerArray) {
                                            var found = false;
                                            for (var i = 0, j = checkerArray.length; !found && i < j; i++) {
                                                if (targetArray.indexOf(checkerArray[i]) > -1) {
                                                    found = true;
                                                    
                                                }
                                            }
                                            return found;
                                        };

                                        return func;
                                    }());


                                    var tests = [between], i, j, cur;

                                    for (i = 0, j = tests.length; i < j; i++) {
                                        cur = tests[i];
                                       myvarcheck=anyMatchInArray(cur);
                                        
                                    }
                     
                     //***************************************
                      var anyMatchInArrayofStart = (function () {
                                        "use strict";

                                        var targetArray, func;

                                        targetArray = datesdebutexistants;
                                        func = function (checkerArray) {
                                            var found = false;
                                            for (var i = 0, j = checkerArray.length; !found && i < j; i++) {
                                                if (targetArray.indexOf(checkerArray[i]) > -1) {
                                                    found = true;
                                                    
                                                }
                                            }
                                            return found;
                                        };

                                        return func;
                                    }());
                                    
                                     var   currentStartDate = new Date($debutPost.getTime());
                                            currentStartDate.setDate($debutPost.getDate());
                      
                                       var testdeb=[];
                      
                            
                             var    vvv = [currentStartDate.getFullYear(), pad(currentStartDate.getMonth()+1),pad(currentStartDate.getDate()) ].join('-');
                               testdeb.push(vvv);
                                    
                                   var testsff = [testdeb];
                                    
                                    var checkdeb=anyMatchInArrayofStart(testsff[0]);
                     
                     //*********************************
                        if ($debutPost > $finPost)
                        {
                            //alert('debut doit etre inf');
                            $(this).next().next().children().text('La date doit etre supérieur au date debut!');
							
                            $(this).next().next().children().css("display", "block");
                            $(this).next().next().children().css("visibility", "visible");
                            $('#datepickerfinUpdate'+id).val("");
                        }else if (myvarcheck==true) {
                           $(this).next().next().children().text("cette période contient des dates déjà reservé par d'autes posts!");
                           $(this).next().next().children().css("display", "block");
                            $(this).next().next().children().css("visibility", "visible");
                            $('#datepickerfinUpdate'+id).val(""); 
                         }
                          else if ((checkdeb==true) && ($debutPost < $finPost) ) {
                            $(this).next().next().children().text("cette période contient des dates déjà reservé par d'autes posts! Vous pouvez ajouter qu'une activité d'un seul jour avec cette date de début!");
                             $(this).next().next().children().css("display", "block");
                             $(this).next().next().children().css("visibility", "visible");
                           $('#datepickerfinUpdate'+id).val(""); 
                         }
                        else
                        {
                       $(this).next().next().children().css("visibility", "hidden");
                        }
						
                });       
               $('.datepickerdebutUpdate').change(function () {
				 var id=$(this).attr('id').split('datepickerdebutUpdate')[1];;
				 
                        // control of date
                     var   $debutPost = $('#datepickerdebutUpdate'+id).datepicker('getDate');
                     var    $finPost = $('#datepickerfinUpdate'+id).datepicker('getDate');
                    
                         var   currentDate = new Date($debutPost.getTime());
                               currentDate.setDate($debutPost.getDate() + 1);
                         var   between = [];

                        while (currentDate < $finPost) {
                            
                             var    vv = [currentDate.getFullYear(), pad(currentDate.getMonth()+1),pad(currentDate.getDate()) ].join('-');
                               between.push(vv);
                         
                               currentDate.setDate(currentDate.getDate() + 1); 
                        } 
                                            
                     //*****************************************
                      var myvarcheck;
                     var anyMatchInArray = (function () {
                                        "use strict";

                                        var targetArray, func;

                                        targetArray = disabledDays;
                                        func = function (checkerArray) {
                                            var found = false;
                                            for (var i = 0, j = checkerArray.length; !found && i < j; i++) {
                                                if (targetArray.indexOf(checkerArray[i]) > -1) {
                                                    found = true;
                                                    
                                                }
                                            }
                                            return found;
                                        };

                                        return func;
                                    }());


                                    var tests = [between], i, j, cur;

                                    for (i = 0, j = tests.length; i < j; i++) {
                                        cur = tests[i];
                                       myvarcheck=anyMatchInArray(cur);
                                        
                                    }
                     
                     //***************************************
                     
                     
                     
                        if ($debutPost > $finPost)
                        {
                            //alert('debut doit etre inf');
                            $(this).next().next().children().text('La date doit etre supérieur au date debut!');
					 		
                            $(this).next().next().children().css("display", "block");
                            $(this).next().next().children().css("visibility", "visible");
                            $('#datepickerfinUpdate'+id).val("");
                        }else if (myvarcheck==true) {
                           $(this).next().next().children().text("cette période contient des dates déjà reservé par d'autes posts!");
                           $(this).next().next().children().css("display", "block");
                            $(this).next().next().children().css("visibility", "visible");
                            $('#datepickerfinUpdate'+id).val("");
                            
                         }
                        else
                        {
                       $(this).next().next().children().css("visibility", "hidden");
                        }
						
                });     







             });
        </script> 
        
 
 
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
                .odd a.ui-state-default {color:white;
                         background-color: red;
                         background: red;}
        </style> 
      

        
        
    <?php
}

?>