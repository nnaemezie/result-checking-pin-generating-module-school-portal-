<!-- <div id="preloader">
    <div id="status">&nbsp;</div>
</div> -->
<?php
  session_start();

  // if(strlen( !$_SESSION['sd']))
  // {
  //     header("Location:index.php");
  // }
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #d12626; border-radius:0px;border-bottom-color:yellow;border-bottom-width:medium;">
    <div class="header-connect">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-8 col-xs-8">
                    <div class="header-half header-call">
                        <p>
                            <span><i class="fa fa-whatsapp"></i><a href="//wa.me/+2347066345857?text=Hello%20Sir,%20please%20i%20need%20your%20help%20from%20sjcmsportal" style="color: white;">+234 706 634 5857</a></span>
                            <span><i class="fa fa-whatsapp"></i><a href="//wa.me/+2348032199478?text=Hello%20Sir,%20please%20i%20need%20your%20help%20from%20sjcmsportal" style="color: white;">+234 803 219 9478</a></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-3  col-xs-offset-1">
                    <div class="header-half header-social">
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="border-color:yellow;"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand my-own-brand" href="/"><h3>SJCMS</h3></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="main-nav nav navbar-nav navbar-right">
        <li class="wow fadeInDown" data-wow-delay="0.5s"><a class="" href="/">Home</a></li>
        <?php
          if(!(isset($_SESSION['sd']))){
            echo '<li class="wow fadeInDown" data-wow-delay="1s"><a id="login_trigger" href="#">Login</a></li>';
          }else{
            echo '
              <li class="wow fadeInDown" data-wow-delay="0.8s"><a class="" href="card.php">Manage Card</a></li>
              <li class="wow fadeInDown" data-wow-delay="0.8s"><a class="" href="card_print.php?schoolType='.$_SESSION['schoolType'].'">Print Card</a></li>
              <li class="wow fadeInDown" data-wow-delay="1.2s"><a id="logout_trigger" href="logout.php">Logout</a></li>
            ';
          }
        ?>
      </ul>
      <ul class="main-nav nav navbar-nav navbar-right">
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
