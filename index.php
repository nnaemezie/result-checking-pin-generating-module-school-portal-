<!DOCTYPE html>
<html>
<head>
  <?php include "partials/visitor/head.php" ?>
</head>
<body>
    <div class="container-scroller">
        <header>
            <?php include "partials/visitor/header.php" ?>
        </header>
        <main>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="content-area">
                        <!-- login area -->
                         <div class="card card-container">
                              <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                              <p id="profile-name" class="profile-name-card"></p>
                              <form action="" method="post" enctype="multipart/form-data" role="form" id="login_form">
                                  <div class="form-group">
                                    <select name="login_myschool" class="form-control" id="login_myschool" required="required">
                                        <option value="">Please Select School</option>
                                        <option value="owalla">OWALLA</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                                  </div>
                                  <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                  </div>
                                  <button name="login" class="btn btn-lg btn-danger btn-block btn-signin" type="submit">Sign in &nbsp;&nbsp; <span class="fa fa-sign-in"></span></button>
                              </form><!-- /form -->

                              <a href="#" class="forgot-password">
                                  Forgot the password?
                              </a>
                         </div>
                        <!-- Container (The used card Section) -->
                        <div id="card-holder" class="container text-center">
                          <br>
                          <h4>USED SCRATCH CARD DOWNLOADER</h4>
                          <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                              <form action="" method="post" enctype="multipart/form-data" role="form" id="result_form">
                                  <div class="form-group">
                                    <select name="myschool" class="form-control" id="myschool" required="required">
                                        <option value="">Please Select School</option>
                                        <option value="owalla">OWALLA</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <select name="myclass" class="form-control" id="myclass" required="required">
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <select name="myterm" class="form-control" id="myterm" required="required">
                                        <option value="">Please Select Term</option>
                                        <option value="First Term">First Term</option>
                                        <option value="Second Term">Second Term</option>
                                        <option value="Third Term">Third Term</option>
                                    </select>
                                  </div>
                                  <button type="submit" name="submit" class="btn pull-right">Download &nbsp; <i class="fa fa-download"></i></button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <br>
                        <br>
                        <br>
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
            margin-top:150px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="resources/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/owl.carousel.min.js"></script>
    <script src="resources/js/wow.js"></script>
    <script src="resources/js/main.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
