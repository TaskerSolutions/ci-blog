<h1><?= $title; ?></h1>

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
_multipart is so that form can handle file uploads aswell
-->
<?php echo form_open_multipart('posts/create'); ?>

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Category</label>
    <select class="form-control" name="category_id">
      <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id'] ; ?>">
          <?php echo $category['name'] ; ?>
        </option>
      <?php endforeach ; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">
      Upload Image - <small>Max size: 4mb</small>
    </label>
    <br>
    <!-- must be named 'userfile' -->
    <input type="file" name="userfile" size="20">
  </div>

  <div class="mb-3">
    <label class="form-label">Body</label>
    <textarea id="editor" class="form-control" name="body" placeholder="Add Body" required></textarea>
  </div>

  <button type="submit" class="btn btn-success">Submit</button>

</form>