<body style="background: #6665ee;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 offset-md-12 form login-form">
          <?php if(isset($_SESSION['info'])){ ?>
            <div class="alert alert-success text-center">
              <?php echo $_SESSION['info']; ?>
            </div>
          <?php } ?>
      </div>
    </div>

    <div class="wrapper">
      <div class="title"><span>Login Form</span></div>
        <!-- <form  class="form-login" action="login_user.php" method="POST" autocomplete=""> -->
        <form  class="form-login" action="<?php echo site_url('Login/login'); ?>" method="POST" autocomplete="">
          <?php if(count($errors) > 0)
            {
          ?>
            <div class="alert alert-danger text-center">
          <?php
              foreach($errors as $showerror)
              {
                  echo $showerror;
              }
          ?>
            </div>
          <?php } ?>
        <div class="row">
          <i class="fa fa-user"></i>
          <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
        </div>
        <div class="row">
          <i class="fa fa-lock"></i>
          <input class="form-control" type="password" name="password" placeholder="Password" required>
        </div>
        <div class="link forget-pass text-left">
          <a href="<?php echo site_url('Login/forgot_password_view'); ?>">Forgot password?</a>
        </div>
        <br>
        <div class="row button">
          <input class="form-control button" type="submit" name="login" value="Login">
        </div>
        <div class="link login-link text-center">Not yet a member?
          <a href="<?php echo site_url('Login/signup_user_view');?>">Signup now</a>
        </div>
        <div class="link login-link text-center">
          <a href="<?php echo site_url('Login/login_admin_view') ?>">Admin</a>
        </div>
      </form>
    </div>
  </div>
</body>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/lib/jquery/jquery.min.js"></script>
<script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="assets/lib/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("#6665ee", {
    speed: 500
    });
</script>
