<h1><?= $title ?></h1>

<br>
<br>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/posts/create'); ?>">
    New post
  </a>
</p>

<br>
<br>

<?php foreach($posts as $post) : ?>

  <h2>
    <?php echo $post['title']; ?>
  </h2>

  <div class="row">
    <div class="col-md-2">
      <img class="img-fluid" style="width: 100%;" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
    </div>
    <div class="col-md-10">
      <small class="post-date">
        Posted on: <strong><?php echo $post['created_at']; ?></strong>
        <br>
        Category: <strong><?php echo $post['name']; ?></strong>
      </small>

      <br>

      <div>
        <?php 
        // this is a method to limit to a particular # of characters
        $str = $post['body'];
        if (strlen($str) > 320) {
          $str = substr($str, 0, 347) . '...';
        }
        echo $str;

        // could also use word_limiter(<string>, <# of words>)
        // requires $autoload['helper'] = array('text');
        // echo word_limiter($post['body'], 100);
        ?>
      </div>
    </div>
  </div>

  <br>
  <br>

  <p>
    <a class="btn btn-primary" href="<?php echo site_url('/posts/'.$post['slug']); ?>">
      Read more
    </a>
  </p>
  
  <br>
  <br>

<?php endforeach; ?>

<div class="pagination">
  <!-- create the links for pagination -->
  <?php echo $this->pagination->create_links(); ?>
</div>

<br>
<br>