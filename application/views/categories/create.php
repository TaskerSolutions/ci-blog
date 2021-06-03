<h1><?= $title; ?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter name">
  </div>
  
  <button type="submit" class="btn btn-success">Submit</button>

</form>