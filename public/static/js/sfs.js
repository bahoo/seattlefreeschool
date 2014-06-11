(function($){

   $(function(){

      $('.content').on('click', '.slideDown', function(e){
         e.preventDefault();
         var target = $(this).attr('href');
         $(target).slideDown().find('input[id^="save"]').val(1);
      });

      $('.content').on('click', '.cancel-save', function(e){
         e.preventDefault();
         var target = $(this).data('toggle');
         $('#' + target).val(0);
         $(this).closest('div[id$="Form"]').slideUp();
      });

   });


})(jQuery);