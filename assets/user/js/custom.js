(function($) {
    "use strict"; 

  $('.confirm-modal').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('.confirm-modal .btn-ok').on('click', function(e) {
      $.ajax({
        type:"GET",
        url:$(this).attr('href'),
        success:function(data)
        {
            $('.confirm-modal').modal('hide');
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
        }
      });
      return false;
  });

})(jQuery);