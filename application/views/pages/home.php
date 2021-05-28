<h2><?= $title ?></h2>

<p>
  Welcome to my Code Igniter 3 blog.<br>
  Check out the latest posts, or post something yourself.
</p>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/posts'); ?>">
    Latest blog posts
  </a>
  <a class="btn btn-success" href="<?php echo site_url('/posts/create'); ?>">
    New post
  </a>
</p>