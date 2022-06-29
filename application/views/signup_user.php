<body style="background: #6665ee;">
    <br><br>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Signup Form</span></div>
          <form action=<?php echo site_url('Login/signup_user') ?> method="POST" autocomplete="">
            <?php if(count($errors) == 1){ ?>
              <div class="alert alert-danger text-center">
                <?php
                  foreach($errors as $showerror){
                    echo $showerror;
                  }
                ?>
              </div>
            <?php } elseif(count($errors) > 1){  ?>
              <div class="alert alert-danger">
                <?php
                  foreach($errors as $showerror){
                ?>
                  <li><?php echo $showerror; ?></li>
                <?php } ?>
              </div>
            <?php } ?>

              <div class="form-group">
                <input class="form-control" type="text" name="first" placeholder="First Name" required value="<?php echo $name ?>">
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="last" placeholder="Last Name" required >
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="address" placeholder="Address" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="number" name="years" placeholder="Years in Farming" min="0" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="crops" placeholder="Type of Crops" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
              </div>
              <div class="row button">
                <input class="form-control button" type="submit" name="signup" value="Signup">
              </div>
              <div class="link login-link text-center">Already a member?
                <a href="<?php echo site_url('Login/redirect_to_base'); ?>">Login here</a>
              </div>
          </form>
        </div>
      </div>
    </div>
  </body>

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