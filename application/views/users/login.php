<?php echo form_open('users/login'); ?>

  <div class="row">
    <div class="col-md-4 offset-4">

      <h1 class="text-center"><?php echo $title; ?></h1>
      <br>

      <div class="mb-4">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter username" required autofocus>
      </div>

      <div class="mb-4">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Login</button>

      <br>
      
      <a class="btn btn-warning btn-block" href="<?php echo site_url('users/register'); ?>">Register a new account</a>

    </div>  
  </div>

<?php echo form_close(); ?>