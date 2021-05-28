<h2><?= $title; ?></h2>

<!--
validation_errors() could be loaded in Posts.php (controler)
But I have loaded it through autoload.php
$autoload['libraries'] = array('form_validation');
-->
<?php echo validation_errors(); ?>

<!-- 
this is instead of form tag 
'$autoload['helper'] = array('url', 'form');' is required 
form action will = posts/create
form method will = post
-->
<?php echo form_open('posts/create'); ?>

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>

  <div class="mb-3">
    <label class="form-label">Body</label>
    <textarea class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>