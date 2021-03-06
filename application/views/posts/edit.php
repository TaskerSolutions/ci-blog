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
-->
<?php echo form_open('posts/update'); ?>
  <!-- need to pass $id paramater as hidden field -->
  <input type="hidden" name="id" value="<?php echo $post['id'] ; ?>">

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $post['title']; ?>" required>
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
    <label class="form-label">Body</label>
    <textarea id="editor" class="form-control" name="body" placeholder="Add Body"
    oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
    required><?php echo $post['body']; ?></textarea>
  </div>

  <button type="submit" class="btn btn-success">Submit</button>
  <a class="btn btn-outline-danger" href="<?php echo base_url(); ?>posts/<?php echo $post['slug']; ?>">
    Cancel edit
   </a>
</form>