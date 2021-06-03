<h1>
  <?php echo $post['title']; ?>
</h1>

<br>

<small class="post-date">
  Posted on: <strong><?php echo $post['created_at']; ?></strong>
  <br>
  Category: <strong><?php // echo $post['name']; ?></strong>
</small>

<br>

<img class="img-fluid" style="max-width: 200px;" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">

<br>
<br>

<div><?php echo $post['body']; ?></div>

<hr>

<a class="btn btn-outline-success float-left" style="margin-right: 10px;" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit post</a>

<!-- not using a get request, as it is extremely unsafe -->
<?php echo form_open('/posts/delete/'.$post['id']); ?>
  <input type="submit" value="Delete post" class="btn btn-outline-danger"
  onClick="if(!confirm('Are you sure you want to delete this post?')){return false;}">
</form>

<hr>

<h4>Comments</h4>
<!-- check to see if there are comments in the $comments variable...
idk where this variable comes from? Maybe from $data array, and the 'comments' portion of it? -->
<?php if($comments) : ?>
  <?php foreach($comments as $comment) : ?>
    <div class="card bg-light my-3">
      <p class="card-body card-text">
        <?php echo $comment['comment']; ?> [by <strong><?php echo $comment['name']; ?></strong>]
      </p>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <p>There are currently no comments on this post</p>
<?php endif; ?>

<hr>

<h4>Leave a comment</h4>

<?php echo validation_errors(); ?>

<?php 
  // submitting form to comments controler, a function called create & to post id
  echo form_open('comments/create/'.$post['id']);
?>
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Your name" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" class="form-control" name="email" placeholder="Your email" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Comment</label>
    <textarea class="form-control" name="comment" placeholder="Your comment" required></textarea>
  </div>

  <!-- hidden input to pass along the slug (url) of the current post -->
  <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
  
  <button class="btn btn-success" type="submit">Submit</button>
</form>

<br>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/posts'); ?>">
    Back to all posts
  </a>
</p>