<!DOCTYPE html>
<html>
<head>
  <?php include "partials/visitor/head.php" ?>
  <link rel="stylesheet" href="resources/DataTables-1.10.13/css/dataTables.bootstrap.min.css">
</head>
<body>
    <div class="container-scroller">
        <header>
            <?php
            include "partials/visitor/header.php";
            if(!(isset($_SESSION['sd']))){
                 header("Location:index.php");
            }
            ?>
        </header>
        <main>
          <?php
              if($_SESSION['sd']['super_admin'] == 'YES'){
          ?>
                <div class="container">
                  <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                      <button type="button" class="btn btn-default add-card">Add Card &nbsp;<i class="glyphicon glyphicon-barcode"></i></button>
                      <button type="button" class="btn btn-default navbar-right wipe-card">Clear Printed Card &nbsp;<i class="glyphicon glyphicon-trash"></i></button>
                    </div>
                  </div>
                </div>
                <hr>
                <div id="card_form_holder">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-10">
                        <form class="form-inline" role="form" id="card_form">
                          <div class="form-group">
                            <input type="number" name="qty" class="form-control" id="qty" placeholder="Enter Quantity" required>
                          </div>
                          <button type="submit" class="btn btn-primary add"> Add <i class="fa fa-download"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>
          <?php
              }
           ?>

          <div class="container">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                <div class="table-responsive" id="table_card">

                </div>
              </div>
          </div>
          </div>
        </main>
        <footer>
            <?php include "partials/visitor/footer.php" ?>
        </footer>
    </div>
    <style>
        main{
            margin-top:120px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="resources/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="resources/Bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script src="resources/plugins/DataTables/datatables.min.js"></script>
    <script src="resources/js/owl.carousel.min.js"></script>
    <script src="resources/js/wow.js"></script>
    <script src="resources/js/main.js"></script>
    <script src="js/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

          var schoolType = "<?php echo $_SESSION['schoolType']; ?>";
          $('#card_form_holder').toggle();

          function loadTable(){
            $.ajax({
                url:"process/card/fetch_card.php",
                method:"POST",
                data:{schoolType:schoolType},
                success:function(data){
                    $('#table_card').html('');
                    $('#table_card').html(data);
                }
            });
          }

          loadTable();

          $(document).on('click', '.add-card', function(){
            $('#card_form_holder').toggle();
          });

          $(document).on('submit', '#card_form', function(){
            event.preventDefault();
            var qty = $('#qty').val();
            $.ajax({
              url:"process/card/insert_card.php",
              method:'POST',
              data:{qty:qty, schoolType:schoolType},
              success:function(data){
                alert(data);
                loadTable();
              }
            });
          });

          $(document).on('click', '.delete', function(){
           var user_id = $(this).attr("id");
            if (confirm("you are about to delete a card !")) {
              $.ajax({
                  url:"process/card/delete_card.php",
                  method:"POST",
                  data:{user_id:user_id, schoolType:schoolType},
                  success:function(data){
                      alert('Done');
                      loadTable();
                  }
              });
            }
          });

          $(document).on('click', '.wipe-card', function(){
            if (confirm("Wipe printed card from database !")) {
              $.ajax({
                  url:"process/card/wipe_card.php",
                  method:"POST",
                  data:{wipe:'wipe', schoolType:schoolType},
                  success:function(data){
                      alert('Done');
                      loadTable();
                  }
              });
            }
          });

        });
    </script>
</body>
</html>
