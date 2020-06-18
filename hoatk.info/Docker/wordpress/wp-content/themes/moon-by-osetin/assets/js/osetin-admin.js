( function( $ ) {
  "use strict";



  $( function() {
    $('.osetin-generate-sitemap-btn').on('click', function(){
      var $btn = $(this);
      $btn.find('span').text('Loading...');
      $.ajax({
        type: "POST",
        url: ajaxurl,
        dataType: 'json',
        data: {
          action: 'osetin_generate_images_sitemap',
        },
        success: function(response){
          if(response.success){
            location.reload();
          }else{
            $btn.find('span').text($btn.data('original-text'));
            // Error
          }
        }
      });

      return false;
    });
  });

} )( jQuery );
