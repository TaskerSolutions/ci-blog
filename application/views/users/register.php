

<?php echo validation_errors(); ?>

<!-- 
multipart, to enable user to upload an image of themself.
submit the form to Users controller, and register() function
@@@@@ ---- need to add variables to store user inputs incase form validation fails ---- @@@@
-->
<?php echo form_open_multipart('users/register'); ?>

  <div class="row">
    <div class="col-md-4 offset-4">

      <h2 class="text-center"><?= $title; ?></h2>
      <br>

      <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Name">
      </div>

      <div class="mb-3">
        <label>Zipcode</label>
        <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      
      <div class="mb-3">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>

      <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
      </div>

      <button type="submit" class="btn btn-success btn-block">Submit</button>

    </div>
  </div>

<?php echo form_close(); ?>