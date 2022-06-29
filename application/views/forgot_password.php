<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form">
        <form action=<?php echo site_url('Login/forgot_password') ?> method="POST" autocomplete="">
          <h2 class="text-center">Forgot Password</h2>
            <p class="text-center">Enter your email address</p>
            <?php
              if(count($errors) > 0) {
            ?>
                <div class="alert alert-danger text-center">
                  <?php 
                    foreach($errors as $error){
                      echo $error;
                    }
                  ?>
                </div>
            <?php } ?>
            <div class="form-group">
              <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
            </div>
            <div class="form-group">
              <input class="form-control button" type="submit" name="check-email" value="Continue">
            </div>
        </form>
      </div>
    </div>
  </div>
</body>
