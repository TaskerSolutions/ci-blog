<h1><?= $title ?></h1>

<br>
<br>

<p>
  <a class="btn btn-primary" href="<?php echo site_url('/categories/create'); ?>">
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
      <!-- only show delete button if session user_id is == user id of the post -->
      <?php if ($this->session->userdata('user_id') == $category['user_id']) : ?>
        <form style="display: inline;" action="categories/delete/<?php echo $category['id']; ?>" method="POST">
          &nbsp;&nbsp;
          <input type="submit" class="btn btn-danger" value="X" style="padding: 1px 6px;" onClick="if(!confirm('Are you sure you want to delete this category?')){return false;}">
        </form>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>