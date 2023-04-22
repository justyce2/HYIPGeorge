(function($) {
  "use strict"; 
  
  $(window).on('load', function () {
		$('.Loader').delay(350).fadeOut('slow');
		$('body').delay(350).css({ 'overflow': 'visible' });
	})

  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  $("#wrapper .sidebar a").each(function() {
    var pageUrl = window.location.href.split(/[#]/)[0];
    if (this.href == pageUrl) {
      if($(this).parent().hasClass('collapse-inner')){
        $(this).addClass("active");
        $(this).parent().parent().parent().addClass("active");
        $(this).parent().parent().prev().click();
      }else{
				$(this).parent().addClass("active");
      }


    }
  });

  $('.icon-picker').iconpicker();

  $(document).on('click','.attribute',function(){
    if(admin_loader == 1)
      {
    $('.Loader').show();
    }
      $('#attribute').find('.modal-title').html($('#attribute_data').val());
      $('#attribute .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
          if(status == "success")
          {
            if(admin_loader == 1)
              {
                $('.Loader').hide();
              }
          }
    
        });
    });
  

  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });


  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });


  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });


  $(".image-upload").on( "change", function() {

    var imgpath = $(this).parent().prev();
    var file = $(this);
    readURL(this,imgpath);
  });
      
  function readURL(input,imgpath) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          imgpath.css('background', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

  $(".image-upload1").on( "change", function() {
    var imgpath = $(this).parent().prev();
    var file = $(this);
    readURL1(this,imgpath);
  });
      
  function readURL1(input,imgpath) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          imgpath.css('background', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

  $(".image-upload2").on( "change", function() {
    var imgpath = $(this).parent().prev();
    var file = $(this);
    readURL2(this,imgpath);
  });
      
  function readURL2(input,imgpath) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          imgpath.css('background', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).on('submit','#geniusformdata',function(e){
    e.preventDefault();

    if(admin_loader == 1)
      {
      $('.Loader').show();
    }

    $('button.addProductSubmit-btn').prop('disabled',true);
    disablekey();
    $.ajax({
         method:"POST",
         url:$(this).prop('action'),
         data:new FormData(this),
         dataType:'JSON',
         contentType: false,
         cache: false,
         processData: false,
         success:function(data)
         {
            console.log(data);
            if ((data.errors)) {
            $('.alert-danger').show();
            $('.alert-danger ul').html('');
              for(var error in data.errors)
              {
                $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
              }

              if(admin_loader == 1)
              {
                $('.Loader').hide();
              }
              $("#modal1 .modal-content .modal-body .alert-danger").focus();
              $('button.addProductSubmit-btn').prop('disabled',false);
              $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
            }
            else
            {
              table.ajax.reload();
              $('.alert-success').show();
              $('.alert-success p').html(data);

              if(admin_loader == 1)
              {
                $('.Loader').hide();
              }
              $('button.addProductSubmit-btn').prop('disabled',false);
              $('#attribute,#modal1,#modal2,#verify-modal').modal('hide');
  
             }
            enablekey();
         }
    });
  });

  $(document).on('submit','.geniusform',function(e){
      var $this = $(this);

      e.preventDefault();

      if(admin_loader == 1)
      {
        $('.Loader').show();
      }

    $('#submit-btn').prop('disabled',true);
        $.ajax({
         method:"POST",
         url:$(this).prop('action'),
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         success:function(data)
         {
          if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
            $this.find('.alert-danger p').html(data.errors[error]);
            }
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html(data);
        
          }
            if(admin_loader == 1)
            {
                $('.Loader').hide();
            }
            
            $('#attribute,#modal1,#modal2,#verify-modal').modal('hide');
            $('#submit-btn').prop('disabled',false);
            
            $(window).scrollTop(0);

         }

        });

  });

  $(document).on('click','.send',function(){
    $('#eml1').val($(this).data('email'));
  });
  
  $(document).on("submit", "#emailreply1" , function(){
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message =  $(this).find('textarea[name=message]').val();
    var to = $(this).find('input[name=to]').val();
    $('#eml1').prop('disabled', true);
    $('#subj1').prop('disabled', true);
    $('#msg1').prop('disabled', true);
    $('#emlsub1').prop('disabled', true);

      $.ajax({
        type: 'post',
        url: mainurl+'/admin/send/message',
        data: {
            '_token': token,
            'subject'   : subject,
            'message'  : message,
            'to'   : to
              },
            success: function( data) {
              $('#eml1').prop('disabled', false);
              $('#subj1').prop('disabled', false);
              $('#msg1').prop('disabled', false);
              $('#subj1').val('');
              $('#msg1').val('');
              $('#emlsub1').prop('disabled', false);
              if(data == 0)
              toastr.error("Oops Something Goes Wrong !!");
                
              else
              toastr.success("Successfully Sent");
              $('#vendorform').modal('hide');
        }
    });
    return false;
  });
  

  $(document).on('submit','.geniusform-tab',function(e){
      var $this = $(this);

      e.preventDefault();
      var pass = 1;

      $('form.geniusform-tab').find('input, select').each(function(){
        if($(this).prop('required')){
          if ($(this).val() === "") {
            pass = 0;
          }
        }
      });
    
      if (pass === 0) {
        toastr.error(form_error);
      }else {

        if(admin_loader == 1)
        {
        $('.Loader').show();
        }

        $('#submit-btn').prop('disabled',true);
        $.ajax({
         method:"POST",
         url:$(this).prop('action'),
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         success:function(data)
         {
            if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
              for(var error in data.errors)
              {
                $this.find('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
              }
            }
            else
            {
              $this.find('.alert-danger').hide();
              $this.find('.alert-success').show();
              $this.find('.alert-success p').html(data);
            }
            if(admin_loader == 1)
            {
              $('.Loader').hide();
            }

            $('#submit-btn').prop('disabled',false);
            
            $(window).scrollTop(0);

         }

        });

      }
  });



  $('.confirm-modal').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('.confirm-modal .btn-ok').on('click', function(e) {
    if(admin_loader == 1)
    {
      $('.Loader').show();
    }

      $.ajax({
      type:"GET",
      url:$(this).attr('href'),
      success:function(data)
      {
            $('.confirm-modal').modal('hide');
            table.ajax.reload();
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);

            if(admin_loader == 1)
            {
              $('.Loader').hide();
            }

      }
      });
      return false;
  });

  $('.status-modal').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('.status-modal .btn-ok').on('click', function(e) {
    if(admin_loader == 1)
    {
      $('.Loader').show();
    }

      $.ajax({
      type:"GET",
      url:$(this).attr('href'),
      success:function(data)
      {
          $('.status-modal').modal('hide');
          $('.alert-danger').hide();
          $('.alert-success').show();
          $('.alert-success p').html(data);

          if(admin_loader == 1)
          {
            $('.Loader').hide();
          }

      }
      });
      return false;
  });



$('.drop-change').on('click',function(){
  var $this = $(this);
  var link = $this.data('href');
  var btn = $this.parent().prev();
  var lastClass = btn.attr('class').split(' ').pop();
  btn.removeClass(lastClass);
  if($this.data('status') == '1'){
    btn.addClass('btn-success');
  }else{
    btn.addClass('btn-danger');
  }
  btn.text($this.data('val'));

  $.get(link, function(data) {
  }).done(function(data) {
    toastr.success(data);
  })

});



$('.mytags').tagify();



$('.next-prev').on('click',function(){
  $($(this).data('href')).click();
});

$(document).on('click','.hide-close',function(){
    $(this).parent().hide();
});


$(document).ready(function () {
  
  $("#myBtn").click(function () {
    $('.modal').modal('show');
  });

  $("#modalLong").click(function () {
    $('.modal').modal('show');
  });

  $("#modalScroll").click(function () {
    $('.modal').modal('show');
  });

  $('#modalCenter').click(function () {
    $('.modal').modal('show');
  });

});


  $(function () {
    $('[data-toggle="popover"]').popover()
  });

  $('.popover-dismiss').popover({
    trigger: 'focus'
  });

  function shownotification(){
    $("#notclear").html('0');
    $route = $("#notclear").data("href");
    $.get($route);
    $('#notf-show').load($('#notf-show').data('href'));
  }

  $(document).on('click','#clear-notf',function(){
    $.get($(this).data('href'));
  });

  $(document).on('click','.status',function () {
    var link = $(this).attr('data-href');
        $.get( link, function() {
          }).done(function(data) {

              table.ajax.reload();
              $('.alert-danger').hide();
              $('.alert-success').show();
              $('.alert-success p').html(data);
        })
  });


  $(document).on('click','.dropdown-toggle',function(){
    let $this = $(this);
    if($this.parent().hasClass('show')){
      $this.parent().removeClass('show');
      $this.next().removeClass('show');
    }else{
      $this.parent().addClass('show');
      $this.next().addClass('show');
    }
  });


  $(document).on('change','#cat',function () {
    var link = $(this).find(':selected').attr('data-href');
    if(link != "")
    {
      $('#subcat').load(link);
      $('#subcat').prop('disabled',false);
    }

  });


  $(document).on('change','#subcat',function () {
    var link = $(this).find(':selected').attr('data-href');

    if(link != "")
    {
      $('#childcat').load(link);
      $('#childcat').prop('disabled',false);
    }
  });

  $(document).on('submit','#messageform',function(e){
    e.preventDefault();

    var href = $(this).data('href');
    if(admin_loader == 1)
    {
      $('.Loader').show();
    }
    $('button.mybtn1').prop('disabled',true);

      $.ajax({
        method:"POST",
        url:$(this).prop('action'),
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#messageform textarea').val('');
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('#messageform textarea').val('');
            $('#messages').load(href);
          }
          if(admin_loader == 1)
          {
            $('.Loader').hide();
          }
          $('button.mybtn1').prop('disabled',false);
        }
      });
    });

    $(document).on('click','.addToMenu',function(){
      let $this = $(this);
      let title = $this.data('title');
      let keyword = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
      let dropdown = $this.data('dropdown');
      let href = $this.data('href');
      let target = $this.data('target');
  
      $('#section-list').append(`
          <div class="card mb-0 mt-2 mx-2 draggable-item">
              <div class="card-body">
                  <div class="media">
                      <div class="media-body">
                          <h5 class="mb-1 mt-0">${title}</h5>
                          <input type="hidden" name="${keyword}[title]" value="${title}">
                          <input type="hidden" name="${keyword}[dropdown]" value="${dropdown}">
                          <input type="hidden" name="${keyword}[href]" value="${href}">
                          <input type="hidden" name="${keyword}[target]" value="${target}">
                      </div>
                      <i class="remove-menu fa fa-trash-alt"></i>
                  </div>
              </div>
          </div>
      `);
  
  });
  
  $(document).on('click','#custom-submit',function(){
      let title = $('#title').val();
      let href = $('#url').val();
      if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(href)){
          href = href;
          $('.show__url__validation').hide();
      } else {
          $('.show__url__validation').show();
          return true;
      }

      if(title != ''){
          let keyword = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
          let dropdown = 'no';
          
          let target = $('#target').val();
  
          $('#section-list').append(`
              <div class="card mb-0 mt-2 mx-2 draggable-item">
                  <div class="card-body">
                      <div class="media">
                          <div class="media-body">
                              <h5 class="mb-1 mt-0">${title}</h5>
                              <input type="hidden" name="${keyword}[title]" value="${title}">
                              <input type="hidden" name="${keyword}[dropdown]" value="${dropdown}">
                              <input type="hidden" name="${keyword}[href]" value="${href}">
                              <input type="hidden" name="${keyword}[target]" value="${target}">
                          </div>
                          <i class="remove-menu fa fa-trash-alt"></i>
                      </div>
                  </div>
              </div>
          `);
      }
  
  });
  
  
  $(document).on('click','.remove-menu',function(){
      $(this).parent().parent().parent().remove();
  
  });

  $("#seo").on('change',function() {
    if(this.checked) {
        $('.showbox').removeClass('d-none');
    }else{
        $('.showbox').addClass('d-none');
    }
});

  if( $('#section-list').length > 0 ){
      var el = document.getElementById('section-list');
      Sortable.create(el, {
      animation: 100,
      group: 'list-1',
      draggable: '.draggable-item',
      handle: '.draggable-item',
      sort: true,
      filter: '.sortable-disabled',
      chosenClass: 'active'
      });
  }

  if(jQuery().summernote) {
    $(".summernote").summernote({
       dialogsInBody: true,
      minHeight: 250,
    });
    $(".summernote-simple").summernote({
       dialogsInBody: true,
      minHeight: 150,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]
      ]
    });
  }


})(jQuery);


