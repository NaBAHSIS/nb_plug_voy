(function ($)
{
    $(document).ready(function() {
        $('.customaddmedia').click(function (e) {
            var $el = $(this).parent();
            
            e.preventDefault();
            var uploader = wp.media({
                title: 'Image entete',
                button: {
                    text: 'Parcourir'
                },
                multiple: false
            })
                    .on('select', function(){
                        var selection = uploader.state().get('selection');
                        var attachement = selection.first().toJSON();
                        $('input', $el).val(attachement.url);
                       
                        $('#header').focus();
                        $('#viewIMP').css('visibility','visible');
                        
                        var thumb = attachement.sizes.thumbnail.url;
                        $('#viewIMP').attr('src',thumb);
                        
                       
                       
            })
                    .open();
             $('#btn_publier').val(" Enregistrer Brouillon"); 
        })
    })
})(jQuery);

