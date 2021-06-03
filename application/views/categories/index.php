<h1><?= $title ?></h1>

<br>
<br>

<p>
  <a class="btn btn-success" href="<?php echo site_url('/categories/create'); ?>">
    New Category
  </a>
</p>

<br>
<br>

<ul class="list-group">
  <?php foreach($categories as $category) : ?>
    <li class="list-group-item">
      <a href="<?php echo site_url('/categories/posts/' . $category['id']); ?>">
        <?php echo $category['name']; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>