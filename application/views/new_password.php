<body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 offset-md-4 form">
          <form action=<?php echo site_url('Login/change_password') ?> method="POST" autocomplete="off">
            <h2 class="text-center">New Password</h2>
            <?php if(isset($_SESSION['info'])) { ?>
              <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
              </div>
            <?php } ?>
            <?php if(count($errors) > 0){ ?>
              <div class="alert alert-danger text-center">
                <?php
                  foreach($errors as $showerror){
                    echo $showerror;
                  }
                ?>
              </div>
            <?php } ?>
              <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Create new password" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
              </div>
              <div class="form-group">
                <input class="form-control button" type="submit" name="change-password" value="Change">
                </div>
          </form>
        </div>
      </div>
    </div>
  </body>