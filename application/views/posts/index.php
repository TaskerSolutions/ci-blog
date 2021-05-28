<h2><?= $title ?></h2>

<br>
<br>

<p>
  <a class="btn btn-success" href="<?php echo site_url('/posts/create'); ?>">
    New post
  </a>
</p>

<br>
<br>

<?php foreach($posts as $post) : ?>

  <h3>
    <?php echo $post['title']; ?>
  </h3>

  <small class="post-date">
    Posted on: <?php echo $post['created_at']; ?>
  </small>

  <br>

  <!--
  .post-body class has a style of white-space: pre-wrap;
  this means that I can't use any white space in the div for clean code
  -->
  <div class="post-body"><?php 
    $str = $post['body'];
    if (strlen($str) > 320) {
      $str = substr($str, 0, 347) . '...';
    }
    echo $str;
  ?></div>
  


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