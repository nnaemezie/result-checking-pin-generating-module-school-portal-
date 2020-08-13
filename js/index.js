
$(document).ready(function(){
$('.card-container').hide();
  $('#myclass').hide();
  $('#myterm').hide();
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#home']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

    //update's class & term dropdown when school is selected
    $(document).on('change', '#myschool', function(event){
        event.preventDefault();
        var schoolType = $('#myschool').val();
        $.ajax({
          url:'process/user.php',
          method:'POST',
          data:{schoolType:schoolType, loadClass:'loadClass'},
          dataType:'json',
          success:function(data){
            $('#myclass').html(data.class);
            $('#myterm').html(data.term);
            $('#myclass').show();
            $('#myterm').show();
          }
        });
    });
    //login_form
    $(document).on('submit', '#login_form', function(event){
        event.preventDefault();
        var schoolType  = $('#login_myschool').val();
        var username    = $('#username').val();
        var password    = $('#password').val();
        $.ajax({
          url:'process/user.php',
          method:'POST',
          data:{username:username, password:password, login:'login', schoolType:schoolType},
          dataType:'json',
          success:function(data){
            if (data.msg === 'success') {
              window.location.reload();
            }else{
              alert(data.msg);
            }
          }
        });
    });
    //result checker form submition
    $(document).on('submit', '#result_form', function(event){
        event.preventDefault();
        //collecting values from result checker form, storing them in variables
        var myschool = $('#myschool').val();
        var myclass   = $('#myclass').val();
        var myterm   = $('#myterm').val();
        // variable validation, checking for empty variable
        if (myschool == '' || myclass == '' || myterm == '') {
            //alert msg if any empty variable is found
            alert("All field in the card downloader is required");
        }else{
          document.location.href="process/studentResult/priResult.php?myschool="+myschool+"&term="+myterm+"&class="+myclass;
        }
    });
    //login  button triger
    $(document).on('click', '#login_trigger', function(event){
      event.preventDefault();
      $('.card-container').show();
      $('#card-holder').hide();
    });
    
});
