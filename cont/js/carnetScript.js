/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * ~ modifié par : Nabiha BAHSIS ~ bahsisnabiha@gmail.com
 * 
 */
 
 jQuery(document).ready(function ($) { 
  


   $('.previewalbum').each(function(){
        
        if($(this).children().children().length==0){
            $(this).hide();
        }  
        else{
            $(this).show();
        }
    });
   
	
     
 
   if($('#viewIMP').attr('src')=="")
   {
       $('#viewIMP').css('visibility','hidden');
   }
   else{
       $('#viewIMP').css('visibility','visible');
   }
   
   
   
   
   var requestRunningeng = false;
    $("#btn_enregistrer").click(function (event) {
		  if (requestRunningeng) { // don't do anything if an AJAX request is pending
            return;
        }
		
         var statverif=   verification(event);
        
        if(statverif==true){
			
			requestRunningeng = true;
           
            var formdata = $('#post').serialize();
			
			console.log(formdata);
			
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/PostEnregistrement.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                            result = result.replace(/\s+/g, '');
							
							
							
                            if(result =='updated' ||result =='created')
                            {
                            
                              location.reload();
                            }
                            else{
                                alert(result); 
                               
                            }     
                        },
						 complete: function() {
							requestRunningeng = false;
						},
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });
   
                event.preventDefault();
            }
       
        
    }); 

    $('.div_datepickerfin').css('visibility', 'hidden');

   
        var    $introCdv = $('.presentation').val();
      
      
		if((jQuery.trim( $introCdv )).length==0){
		  $('.presentation').val('');//suppression des espaces vides!
		}
		
		
		
   
   
    $('.titleCdv').change(function(e){
        $('#btn_publier').val(" Enregistrer Brouillon");
    });
    $('.presentation').change(function(e){
        $('#btn_publier').val(" Enregistrer Brouillon");
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
            $('html,body').animate({
                    scrollTop: $(".recitTab").offset().top
                    }, 700);
            event.preventDefault();
        } else
        {
            $('.errorTitlePost').css("display", "none");
            statverif = true;
        }
        return statverif;
    }
//**********************************

//******************************************
     
    
    
    $('.dashicons-engBloc').click(function(e){
                                    
            if ( $('.second').css('visibility') == 'hidden' )
            {
                $('.second').css('visibility','visible');
                $(this).css('transform','rotate(148deg)');
                $(this).css('-webkit-transform','rotate(148deg)');
                $(this).css('-ms-transform','rotate(148deg)');
                $(this).css('margin-top',' -28px');
                                               
            }
            else
            {
                $('.second').css('visibility','hidden');
                $(this).css('transform','rotate(211deg)');
                $(this).css('-webkit-transform','rotate(211deg)');
                $(this).css('-ms-transform','rotate(211deg)');
                $(this).css('margin-top',' -33px');
            }
    });       
                                     
    $( ".boutonsupprimer" ).on( "mouseenter", function() {$(this).parent().find('.indicSup').css('visibility','visible'); })
                           .on( "mouseleave", function() {$(this).parent().find('.indicSup').css('visibility','hidden'); });
                                   
                                   
     $( ".dashicons-menu" ).on( "mouseenter", function() { $(this).parent().find('.indicdrag').prev().css('visibility','hidden');$(this).parent().find('.indicdrag').fadeIn(); })
                           .on( "mouseleave", function() {$(this).parent().find('.indicdrag').prev().css('visibility','visible');$(this).parent().find('.indicdrag').fadeOut("fast"); });
                                   
    //***************** Drag and Drop ******************************************//
    //******************************************************************************//
                                 
    var dragSrcEl = null;

    function handleDragStart(e) {
            // Target (this) element is the source node.
            // this.style.opacity = '0.4';
            dragSrcEl = this;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
    }
    function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault(); // Necessary. Allows us to drop.
            }

            e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
            return false;
    }

    function handleDragEnter(e) {
             // this / e.target is the current hover target.
           
          //  this.classList.add('over');
      
    }

    function handleDragLeave(e) {
        this.classList.remove('over');
           // this / e.target is previous target element.
    }
   
    function handleDrop(e) {
             // this/e.target is current target element.

            if (e.stopPropagation) {
                 e.stopPropagation(); // Stops some browsers from redirecting.
            }

            // Don't do anything if dropping the same column we're dragging.
            if (dragSrcEl != this) {
             // Set the source column's HTML to the HTML of the column we dropped on.
            // $(dragSrcEl).parent().prepend($(this).html());
                
               
               // dragSrcEl.innerHTML = dropSrcEl.innerHTML; 
               // dropSrcEl.innerHTML = e.dataTransfer.getData('text/html'); 
              // $(dropSrcEl).replaceWith(dragSrcEl);
                
            }

            return false;
    }

    function handleDragEnd(e) {
             // this/e.target is the source node.
            [].forEach.call(cols, function (col) {
                col.classList.remove('over');
               
            });
           
    }
    var cols = document.querySelectorAll('.draggable');
        [].forEach.call(cols, function(col) {
                col.addEventListener('dragstart', handleDragStart, false);
                col.addEventListener('dragenter', handleDragEnter, false);
                col.addEventListener('dragover', handleDragOver, false);
               // col.addEventListener('dragleave', handleDragLeave, false);
               // col.addEventListener('drop', handleDrop, false);
               // col.addEventListener('dragend', handleDragEnd, false);
               
        });
      
    //*********************************************************************************//
    //******************    check drag &drop                    ***********************//
    //*********************************************************************************//
     var posInitiale;
     var posfinale;
     var idEdito;
     var iddrag;
	 var idnxtelt
     $('.draggable').on('drag',function(event,ui){
         iddrag=$(this).attr('id');
		 
          var id=$(this).attr('id').split('-');
              posInitiale=id[0];
              idEdito=id[1];
			 if ($(this).attr('id') != $('.draggable').last().attr('id'))
                {
					var nxtelt= $(this).parent().next().attr('id').split('-');
						idnxtelt=nxtelt[1]+'-'+nxtelt[2];	  
				}
      }); 
    
var cursorX;
var cursorY;
 var pageCoords ;
  var clientCoords;
document.onmousemove = function(e){
    cursorX = e.pageX;
    cursorY = e.pageY;
    pageCoords = "( " + e.pageX + ", " + e.pageY + " )";
    clientCoords = "( " + e.clientX + ", " + e.clientY + " )";
  
}
 $('.draggable').on('dragenter',function(e,ui){
    var id=$(this).attr('id').split('-');
	
		
            if($(this).attr('id')!= iddrag)  
            {
                $('.droppable').hide();
				if($(this).attr('id') != idnxtelt){
				    $(this).prev().show();	
                }
				
                if ($(this).attr('id') == $('.draggable').last().attr('id'))
                {
                   
                        var elem='#'+$(this).attr('id');
                      
                            
                              if(UnderElement(elem,e)) {
                             
                              $('.droppable').hide();
                              $(elem).next().next().next().show();
                              
                              }
                        
                        
                        function UnderElement(elem,e) {
                                    var elemWidth = $(elem).width();
                                    var elemHeight = $(elem).height();
                                    var elemPosition = $(elem).offset();
                                    var elemPosition2 = new Object;
                                    elemPosition2.top = elemPosition.top + elemHeight;
                                    elemPosition2.left = elemPosition.left + elemWidth;

                                    return ( (e.pageY > elemPosition.top ))
                                }
                }
            }
           
 });
 var iddrop;
  $('.droppable').on('dragover',function(e,ui){
      
    e.preventDefault(); // Annule l'interdiction de drop
    
});
  

    $('.droppable').on('drop',function(e,ui){
         e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
         var id1;var id;
         var strid=$(this).attr('id');
      
           
        if(strid.includes('_end')==true){
             id1=$(this).attr('id').split('droppable_end-');
             iddrop=id1[1];
             id=id1[1].split('-'); 
            
             
         }
         else if(strid.includes('_end')==false){
              id1=$(this).attr('id').split('droppable-');
              iddrop=id1[1];
             id=id1[1].split('-'); 
             
         }
             
                
            posfinale=id[0];
           var idreplacedwith=id[1];
       
        $(this).parent().before('<div id="dropzone" class="col-md-12 col-sm-12 col-xs-12 "></div>');
       
        $('.posts #dropzone').replaceWith( $('#post-'+iddrag));

        $(this).hide();
       
           
                     $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/PostOrdination.php',
                        type: 'POST',
                        data: {lastpos:posInitiale, newpos:posfinale, IDedito:idEdito,idremp:idreplacedwith },
                        success: function (result, statut) { // success est toujours en place, bien sûr !
				        result = result.trim();
                                if (result == "Position modifié avec succès!" ||result =="")
                                { 
                                    location.reload();
                                }
                                else{
                                    alert(result);
                                    location.reload();
                                }
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                }); 
                 
                    
            $(this).children().find('.indicdrag').css('display','none');  
            $(this).children().find('.boutonsupprimer').css('visibility','visible');
       
       
        }); 
  
 
 //*******************************************************************************************************//
 //***************              block modifier               **********************************************//
 //*******************************************************************************************************//
   
     
   $('.dashiconsUpdate').click(function(e){
    
            var thisAnchor = $(this);
            
            var tab=$(this).parent().parent().parent().parent().parent();
            
            
           
            if ( $(this).parent().parent().parent().next().css('display') == 'none' )
            {   
                tab.find('.secondupdate').css('display','none');
               
                autocontrols(thisAnchor);
                $(this).parent().parent().parent().next().css('display','block');
                $('.nouveauPost').css('display','none'); 
                $("#colAjout").css('visibility','visible'); 
                
                $(this).css('transform','rotate(148deg)');
                $(this).css('-webkit-transform','rotate(148deg)');
                $(this).css('-ms-transform','rotate(148deg)');
                $(this).css('margin-top',' 13px');
                                             
            }
            else
            {
                $(this).parent().parent().parent().next().css('display','none');
                $('.nouveauPost').css('display','none'); 
                $("#colAjout").css('visibility','visible'); 
               
                $(this).css('transform','rotate(211deg)');
                $(this).css('-webkit-transform','rotate(211deg)');
                $(this).css('-ms-transform','rotate(211deg)');
                $(this).css('margin-top',' 10px');
            }
    }); 
    
    
    $( ".dashiconsUpdate" ).on( "mouseenter", function() { $(this).parent().parent().find('.dashicons-menu').css('visibility','hidden');$(this).parent().parent().find('.boutonsupprimer').css('visibility','hidden');$(this).parent().find('.indicUpadate').fadeIn(); })
                           .on( "mouseleave", function() {$(this).parent().parent().find('.dashicons-menu').css('visibility','visible');$(this).parent().parent().find('.boutonsupprimer').css('visibility','visible');$(this).parent().find('.indicUpadate').fadeOut("fast"); });
                                   
    
    
      function autocontrols(elt){
        
          $.each($('.dashiconsUpdate'), function(index, item) { 
               
                 $(item).css('transform','rotate(211deg)');
                 $(item).css('-webkit-transform','rotate(211deg)');
                 $(item).css('-ms-transform','rotate(211deg)');
                 $(item).css('margin-top',' 10px');
                 
            });
           
            
       $('.postRecit').css('display','none');
       $('.postAction').css('visibility','hidden');
       $( ".dashiconsNouveau" ).css('transform','rotate(211deg)');
       $( ".dashiconsNouveau" ).css('-webkit-transform','rotate(211deg)');
       $( ".dashiconsNouveau" ).css('-ms-transform','rotate(211deg)');
       $( ".dashiconsNouveau" ).css('margin-top',' 10px');
    }
      function stopUpdate(){
       
         $.each($('.secondupdate'), function(index, item) { 
                
                 $(item).css('display','none');
            });
        $.each($('.dashiconsUpdate'), function(index, item) { 
                  
                 $(item).css('transform','rotate(211deg)');
                 $(item).css('-webkit-transform','rotate(211deg)');
                 $(item).css('-ms-transform','rotate(211deg)');
                 $(item).css('margin-top',' 10px');
                 
            });
    }
    
  
//****************************************************************************************************************************************************//
//***********************       ajout nouveau contenu           ********************************************************************//
//************************************************************************************************************************************************//
    $('.nouveauPost').css('display','none'); 
    $('.dashiconsNouveau').click(function(e){
         
            if ( $(this).parent().parent().next().css('display') == 'none' )
            {   
               
                $(this).parent().parent().next().css('display','block');
                
                $("#colAjout").css('visibility','hidden'); 
                $('.postAction').css('visibility','visible');
                $(this).css('transform','rotate(148deg)');
                $(this).css('-webkit-transform','rotate(148deg)');
                $(this).css('-ms-transform','rotate(148deg)');
                $(this).css('margin-top',' 13px');
                 stopUpdate();                            
            }
            else
            {   
                
                $(this).parent().parent().next().css('display','none');
               
                $('.nouveauPost').css('display','none'); 
                $("#colAjout").css('visibility','visible'); 
                $('.postAction').css('visibility','hidden');
                $(this).css('transform','rotate(211deg)');
                $(this).css('-webkit-transform','rotate(211deg)');
                $(this).css('-ms-transform','rotate(211deg)');
                $(this).css('margin-top',' 10px');
            }
    });
     
//****************************************************************************************************************************************************//
//***********************       Enregistrement localisation      ***********************************************************************************//
//************************************************************************************************************************************************//     
   
     
     $('.dashiconsMap').click(function(){
         
        
           
            if ( $(this).parent().parent().next().css('visibility') == 'visible' )
            {   
               
                $(this).parent().parent().next().css('visibility','hidden');
                $(this).css('transform','rotate(211deg)');
                $(this).css('-webkit-transform','rotate(211deg)');
                $(this).css('-ms-transform','rotate(211deg)');
                $(this).css('margin-top',' 8px');
                                             
            }
            else
            {   
                
                $(this).parent().parent().next().css('visibility','visible'); 
                $(this).css('transform','rotate(148deg)');
                $(this).css('-webkit-transform','rotate(148deg)');
                $(this).css('-ms-transform','rotate(148deg)');
                $(this).css('margin-top',' 8px');
            }
            
    });
    
    
    
    
    
     
//****************************************************************************************************************************************************//
//***********************       Enregistrement Album photo      ***********************************************************************************//
//************************************************************************************************************************************************//     
   
     
     $('.dashiconsPhoto').click(function(){
         
        
           
            if ( $(this).parent().parent().next().css('visibility') == 'visible' )
            {   
               
                $(this).parent().parent().next().css('visibility','hidden');
                $(this).css('transform','rotate(211deg)');
                $(this).css('-webkit-transform','rotate(211deg)');
                $(this).css('-ms-transform','rotate(211deg)');
                $(this).css('margin-top',' 8px');
                                             
            }
            else
            {   
                
                $(this).parent().parent().next().css('visibility','visible'); 
                $(this).css('transform','rotate(148deg)');
                $(this).css('-webkit-transform','rotate(148deg)');
                $(this).css('-ms-transform','rotate(148deg)');
                $(this).css('margin-top',' 8px');
            }
            
    });   
     
    $('#file').change(function(){

       var files = $(this)[0].files;
          
        if (files.length > 0) {
           
          
            $(this).prev().val(files[0].name);
             $(this).prev().focus();  
             
        }
    }); 
    
    var counter=0;
    var requestRunning = false;
    $('#imageenrg').click(function(event){
        
		if (requestRunning) { // don't do anything if an AJAX request is pending
        return;
        }
		
        var permition=false;
        if ($('#titleImg').val()== "")
        {
            $('.errorTitleImg').text('Saisir le titre de votre album!, Ce champ est obligatoire!')
            $('.errorTitleImg').css("display", "block");
            permition=false;
            event.preventDefault();
        } else
        {
            $('.errorTitleImg').css("display", "none");
            permition=true;
        }
        // Mon recit
        var  $title = $('.titlePost').val();
        //title POst
        if ($title == "")
        {
            $('.errorTitlePost').text('Vous devez saisir le titre de Poste!, Ce champ est obligatoire!')
            $('.errorTitlePost').css("display", "block");
            $('html,body').animate({
                    scrollTop: $(".recitTab").offset().top
                    }, 700);
            permition = false;
            event.preventDefault();
        }
        else if($title != "" && $('#titleImg').val() != "" )
        {
            $('.errorTitlePost').css("display", "none");
            permition = true;
        }
        
        if(permition==true){
          
            
            var files = $('#file')[0].files;
            var legpho=$('textarea.legende').val();
          
            if (files.length > 0) {
           
            var tmppath = URL.createObjectURL(files[0]);
              counter++;
            
            //enregistrement  
            var formdata = new FormData(document.getElementById('post'));
			requestRunning = true;
           
            
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/uploadAlbum.php',
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
                               var dateajout=result;    
							   var eltch=$('#preview').children().children().length;
							     
                                $('#preview').css('display','block');
                                $('#imageenrg').parent().next().children('div').append('<div id="parent'+counter+'" style="background-color: #ddd;margin:5px;width: 115px; height: 270px;font-size:11px;float:left; " >\n\
                                                            <img style="width: 105px;height: 105px; float:left;margin:5px;" src="'+tmppath+'" alt="" class="img-responsive"></img>\n\
                                                            <!--h4 class="myTitle" id="titrePho'+counter+'" style="padding: 5px;text-align:center; margin-bottom:5px;width: 95px;margin: auto;height: 130px;font-weight: bold;font-style: normal;color: #666666;">'+$('#titleImg').val()+'</h4--><br>\n\
															<input class="myTitle" id="titrePho'+counter+'" type="hidden" value="'+$('#titleImg').val()+'">\n\
                                                            <input class="mylegende" id="mylegende'+counter+'" type="hidden" value="'+legpho+'">\n\
                                                            <input class="myfile" id="myfile'+counter+'" type="hidden" value="'+dateajout+'">\n\
                                                            <input id="radio'+counter+'" style="    margin-bottom: 15px; margin-left: 4px;font-size: 8px;margin-right: 0px;margin-top: 11px;" type="radio" name="radio" class="radio"  value="'+dateajout+'"> Photo principale</input><br>\n\
                                                            <span id="'+counter+'"  style="padding: 5px; color:#72777c; text-decoration: underline;margin-bottom:8px;    cursor: pointer;" class="ModifPhotoAlbum" data-toggle="modal" data-target="#myModal'+counter+'" > Modifier la photo</span><br><br>\n\
                                                            <span   style="padding: 5px;color:#72777c;  cursor: pointer;" class="SupPhotoAlbum" > Supprimer la photo</span><br>\n\
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
                                                            <input type="text" size="30" class="regular-text titleImg" value="" >\n\
                                                            <br>\n\
                                                            </div>\n\
                                                            <label for="profile_legende">Légende de la photo </label><br>\n\
                                                            <textarea rows="4" cols="40" id="legendeUp'+counter+'" value=""></textarea><br><br>\n\
                                                            <input type="submit" class="btnModif"  value="Modifier"/>\n\
                                                            <div id="success" style="color: green; font-size:12px;"></div>\n\
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
							                setTimeout(function(){  $('#preview').children().children().find("#radio"+counter).attr('checked', 'checked');},400); 
							             }
                                   
                                $('#titleImg').val(""); 
                                $('.file_name').val(""); 
                                
                                $('.legende').val("");
                                $('#file').val(null); 
                                  
                                   
                            }
                           
                              
                        },
						complete: function() {
						  requestRunning = false;
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
    
    
    
    
    $("#preview").on("click", "span.SupPhotoAlbum", function(){
          // $(this).parent().remove();
         var id=$(this).parent().attr('id'); 
       
       var titleINi=$('#'+id).find('#titrePho'+id.substr(id.length - 1)).text();
       var legINi = $('#'+id).find('#mylegende'+id.substr(id.length - 1)).val();
       
       var title=$('.titlePost').val();
       var name =$('#'+id).find('#myfile'+id.substr(id.length - 1)).val();
       
       var formdata ={lastTitle:titleINi, lastLegende:legINi,titre_recit:title, file_name: name};
        
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/deleteAlbum.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               if(result!="erreur!")
                               {
                                  console.log(result);
                                  $('#'+id).remove(); 
                               }
                               
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });
        
    });
        
        
        
    $("#preview").on("click", "span.ModifPhotoAlbum", function(){
     
        
        var parent=$('#preview').children().find('#parent'+$(this).attr('id'));
  
        var idModal=$(this).parent().children().find('.myModal').attr('id');
        var ttre=$('#preview').children().find('#parent'+$(this).attr('id')).find('.myTitle').attr('id');
        var leg =$('#preview').children().find('#parent'+$(this).attr('id')).find('.mylegende').attr('id');  
        $('#'+idModal).children().find('.modal-body').children().find('input:text').val($('#'+ttre).text());
        $('#'+idModal).children().find('.modal-body').find('textarea').val($('#'+leg).val());
        
    });
  
  
  
  
  
   $("#preview").on("click", ".myModal .btnModif", function(){
 
       var idModal=$(this).parent().parent().parent().parent().attr('id');
       var titleINi=$('#preview').children().find('#parent'+idModal.substr(idModal.length - 1)).find('#titrePho'+idModal.substr(idModal.length - 1)).text();
       var legINi = $('#preview').children().find('#parent'+idModal.substr(idModal.length - 1)).find('#mylegende'+idModal.substr(idModal.length - 1)).val();
       var titleUp =$('#'+idModal).children().find('.modal-body').children().find('input:text').val();
       var legUp =  $('#'+idModal).children().find('.modal-body').find('textarea').val();
       $(this).parent().parent().parent().parent().parent().parent().find('.myTitle').text(titleUp);
       var title=$('.titlePost').val();
       var name =$('#preview').children().find('#parent'+idModal.substr(idModal.length - 1)).find('#myfile'+idModal.substr(idModal.length - 1)).val();
       
       var formdata ={lastTitle:titleINi, lastLegende:legINi,newTitle:titleUp, newLegende:legUp,titre_recit:title, file_name: name};
        $('#'+idModal).children().find('.modal-body').find('#success').children().remove();       
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/Modif_Album.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               
                                   //alert(result);  
                                $('#'+idModal).children().find('.modal-body').find('#success').append('<p>'+result+'</p>');   
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });
      
   });
  
  
  
  $("#preview").on("change", "input.radio", function(){
          // $(this).parent().remove();
         var id=$(this).parent().attr('id'); 
       
      var title=$('.titlePost').val();
       var name =$('#'+id).find('#myfile'+id.substr(id.length - 1)).val();
      
       var formdata ={file_name_radio: name,profile_titre: title};
        
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/Modif_Album.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               if(result!="erreur!")
                               {
                                  console.log(result);   
                               }
                               
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });
        
    });
  
  
  
  
  
  
  
//****************************************************************************************************************************************************//
//***********************       Block ajout      ***********************************************************************************//
//************************************************************************************************************************************************//      
  
   $('#btn_ajout').click(function(){
       
       //location.reload();
         $('.dashiconsNouveau').parent().parent().next().css('display','block');
                $('.nouveauPost').css('display','block');
                $('.postAction').css('visibility','visible');
                $('.dashiconsNouveau').css('transform','rotate(148deg)');
                $('.dashiconsNouveau').css('-webkit-transform','rotate(148deg)');
                $('.dashiconsNouveau').css('-ms-transform','rotate(148deg)');
                $('.dashiconsNouveau').css('margin-top',' 13px');
                 stopUpdate(); 
                $('#colAjout').css('visibility','hidden');
   });  
//****************************************************************************************************************************************************//
//***********************       Block modification      ***********************************************************************************//
//************************************************************************************************************************************************//      
 



$('.previewalbum').on('click','.SupPhotoAlbumBlocUPd',function(){
    

      
      var name=$(this).attr('id').split('idSup')[1];
      
     var formdata ={Supbloc:name};
        
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/deleteAlbum.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               if(result!="erreur!")
                               {
                                  
                                  
                                  var elt=$('#parent'+name).parent().parent().attr('id');
                                  console.log(elt);
                                  $('#parent'+name).remove();
                                   if($(elt).children().children().length==1){
                                        $(elt).hide();
                                    }  
                                    else{
                                        $(elt).show();
                                    }
                               }
                               else{
                                   alert(result);
                               }
                               
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });

});





 $('.previewalbum').on('click','.btnModifBloc',function(){      
  var idph=$(this).attr('id').split('modif')[1];
 var elt=$(this);
  
  var titre=$('#myModal'+idph).find('.modal-body').children().find('input:text').val();
  var leg=$('#myModal'+idph).children().find('.modal-body').find('textarea').val();
  
      var formdata ={idphoto: idph,newTitlein:titre,newLegendein:leg};
        
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/Modif_Album.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               if(result!="erreur!")
                               {
                                  //console.log(result);
                                  $(elt).next().append('<p>'+result+'</p>');
                                 
                                   
                               }
                               
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                });
        
//});
});   
  
 

 
  $('.fileupdate').each(function(){
    $(this).change(function(){

       var files = $(this)[0].files;
          
        if (files.length > 0) {
           
            
            $(this).prev().val(files[0].name);
             $(this).prev().focus();  
             
        }
    });   
      
  });
 
  var requestRunningupd = false;
 $('.submit_image_update').each(function(){
     $(this).click(function(event){
        if (requestRunningupd) { // don't do anything if an AJAX request is pending
        return;
       } 
        
        var idbtn=$(this).attr('id').split('imageenrg')[1];
        
        
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
                                                            <!--h4 class="myTitle" id="titrePho'+counter+'" style="padding: 5px;text-align:center; margin-bottom:5px;width: 95px;margin: auto;height: 130px;font-weight: bold;font-style: normal;color: #666666;">'+$('#titleImg'+idbtn).val()+'</h4--><br>\n\
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
     
 });
 
 
 
 
       $(".previewalbum").on("change", ".chekboxupdate", function(){
           
            var id=$(this).attr('id').split('check')[1]; 
         var idph=id.split('-')[0];
         var idedito=id.split('-')[1];
       
      
       var formdata ={idphoto:idph,idedito:idedito};
        
                $.ajax({
                        url: '../wp-content/plugins/Carnet_voyages/Modif_Album.php',
                        type: 'POST',
                        data: formdata,
                        success: function (result, statut) { // success est toujours en place, bien sûr !
                               if(result!="erreur!")
                               {
                                  console.log(result);
                                   
                               }
                               
                        },
                        error: function (resultat, statut, erreur) {
                                alert(erreur);
                        }
                }); 
       
      
       
    });

  
  
  
  
  
  
  
  
             //**************************************************************************************************************************
                //                                                 Annuler                                                     
                //**************************************************************************************************************************
 
                    $('.submitUpdateAnnuler').each(function(){

                        $(this).click(function(){
                            
                            var idito=$(this).attr('id').split('annuler')[1];
                            
                           var formdata ={idedito:idito};
                           var elt=$(this).parent().parent().parent();
                          // update80
                            $.ajax({
                                    url: '../wp-content/plugins/Carnet_voyages/reinitialise.php',
                                    type: 'POST',
                                    data: formdata,
                                    success: function (result, statut) { // success est toujours en place, bien sûr !
                                           if(result!="erreur!")
                                           {
                                              
                                               var json = JSON.parse(result);
                                               
                                                $('#datepickerdebutUpdate'+idito).val(json[0].dateDebutPost); 
                                                $('#datepickerfinUpdate'+idito).val(json[0].dateFinPost); 
                                                $('#fromupdate'+idito).val(json[0].lieuDepPost);
                                                $('#toUpdate'+idito).val(json[0].lieuArrPost);
                                                $('#titrerecit'+idito).val(json[0].titlePost);
                                                $('#recitintr'+idito).val(json[0].txtPost);
                                               // alert($('#recitintr'+idito+'_ifr').html());
                                                $('#recitintr'+idito+'_ifr').contents().find('body').html(json[0].txtPost);
                                               
                                                $('html,body').animate({
                                                    scrollTop: $('#datepickerdebutUpdate'+idito).offset().top
                                                    }, 700);
                                                setTimeout(function(){
                                                    
                                                    $(elt).css('display','none');
                                                    $('#update'+idito).css('transform','rotate(211deg)');
                                                    $('#update'+idito).css('-webkit-transform','rotate(211deg)');
                                                    $('#update'+idito).css('-ms-transform','rotate(211deg)');
                                                    $('#update'+idito).css('margin-top',' 10px');
                                                }, 0);    
                                           }

                                    },
                                    error: function (resultat, statut, erreur) {
                                            alert(erreur);
                                    }
                            }); 
       
                            
                        });
                    });
            
  
  
  
 //***************************************************************************************************
 //                                checkbox                                                           
 //****************************************************************************************************
 $('.profile_checkbox').change(function(){
     
     var vv= $(this).val();
     
     if(vv==0){
         $(this).val('1');
     }else{
         $(this).val('0');
     }
     
      $('#btn_publier').val(" Enregistrer Brouillon");
 });

 
 
  
  
  $('#newsletterAdd').click(function(event){
     if($('#exampleInputEmail1').val()!=""){
         var formdata={email:$('#exampleInputEmail1').val(),cdvactif:$('#ID_userN').val()};
        $.ajax({
                                    url: '../wp-content/plugins/Carnet_voyages/newsletter.php',
                                    type: 'POST',
                                    data: formdata,
                                    success: function (result, statut) { // success est toujours en place, bien sûr !
                                           if(result!="erreur!")
                                           {
                                                window.location.assign("../wp-content/plugins/Carnet_voyages/remerciement.php");   
                                           }

                                    },
                                    error: function (resultat, statut, erreur) {
                                            alert(erreur);
                                    }
                            });  
         
     }
     else{
         
         $('#errorNewsl').text('Merci de Saisir votre adresse mail!');
          event.preventDefault(); 
          
     }
      event.preventDefault();     
 });

   $('#newsletterAnnul').click(function(event){
     
     
        var formdata={ID_user:$('#ID_userN').val()};
        $.ajax({
                                    url: '../wp-content/plugins/Carnet_voyages/newsletter.php',
                                    type: 'POST',
                                    data: formdata,
                                    success: function (result, statut) { // success est toujours en place, bien sûr !
                                           if(result!="erreur!")
                                           {
                                              //  window.location.assign("../wp-content/plugins/Carnet_voyages/remerciement.php");   
                                              location.reload();
                                           }

                                    },
                                    error: function (resultat, statut, erreur) {
                                            alert(erreur);
                                    }
                            });
     
     
     
           event.preventDefault(); 
   });
  
  
 
   $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });
 
 });

 