
<body style="background: #6665ee;">
    <br><br>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Admin Form</span></div>
            <form class="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="row">
                <i class="fa fa-user"></i>
                <input type="text" placeholder="Username" name="username" class="form-control " value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="row">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="Password" name="password" class="form-control ">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
        
            <div class="row button">
                <input type="submit" name="enter" value="Login">
            </div>
        
            <div class="signup-link"> <a href="<?php echo site_url('Login/redirect_to_base'); ?>">Go to Login</a></div>
            </form>
        </div>
    </div>


  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("#6665ee", {
      speed: 500
    });
  </script>
</body>