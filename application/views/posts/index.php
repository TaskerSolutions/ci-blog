<h2><?= $title ?></h2>

<br>
<br>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/posts/create'); ?>">
    Create new post
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

  <?php 
    $str = $post['body'];
    if (strlen($str) > 320) {
      $str = substr($str, 0, 347) . '...';
    }
    echo $str;
  ?>

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