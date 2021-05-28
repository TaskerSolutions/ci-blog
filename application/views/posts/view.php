<h2>
  <?php echo $post['title']; ?>
</h2>

<br>

<small class="post-date">
  Posted on: <?php echo $post['created_at']; ?>
</small>

<br>
<br>

<!--
.post-body class has a style of white-space: pre-wrap;
this means that I can't use any white space in the div for clean code
-->
<div class="post-body"><?php echo $post['body']; ?></div>

<hr>

<a class="btn btn-outline-success float-left" style="margin-right: 10px;" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit post</a>

<!-- not using a get request, as it is extremely unsafe -->
<?php echo form_open('/posts/delete/'.$post['id']); ?>
  <input type="submit" value="Delete post" class="btn btn-outline-danger">
</form>

<br>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/posts'); ?>">
    Back to all posts
  </a>
</p>