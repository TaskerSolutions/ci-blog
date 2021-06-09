<!DOCTYPE html>
<html lang="en-US">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Tell IE to use the most current layout engine-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive site doesn't get zoomed out by mobile phone's browser.-->
	<meta name="description" content="Code Igniter Blog">
	<meta name="keywords" content="Code Igniter blog"> <!-- for SEO -->
	<meta name="author" content="Harry Tasker">

  <title>Code Igniter Blog</title>

  <!-- load icon -->
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/favicon-32x32.png">

  <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

</head>
<body>

<nav class="navbar navbar-expand bg-dark navbar-dark">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand" href="<?php echo base_url(); ?>">CI Blog</a>

    <!-- Left links -->
    <ul class="navbar-nav">

      <li><a class="nav-link" href="<?php echo base_url(); ?>">
        Home
      </a></li>

      <li><a class="nav-link" href="<?php echo base_url(); ?>posts">
        Posts
      </a></li>

      <li><a class="nav-link" href="<?php echo base_url(); ?>categories">
        Categories
      </a></li>

    </ul>

    <!-- Right links -->
    <ul class="navbar-nav ml-auto">

      <!-- if user is not logged in, then show these links -->
      <?php if (!$this->session->userdata('logged_in')) : ?>

        <li><a class="nav-link" href="<?php echo site_url('users/register'); ?>">
          Register
        </a></li>

        <li><a class="nav-link" href="<?php echo site_url('users/login'); ?>">
          Log in
        </a></li>

      <?php endif; ?>

      <!-- if user is logged in, then show these links -->
      <?php if ($this->session->userdata('logged_in')) : ?>

        <li><a class="nav-link" href="<?php echo site_url('posts/create'); ?>">
          Create post
        </a></li>

        <li><a class="nav-link" href="<?php echo site_url('categories/create'); ?>">
          Create category
        </a></li>

        <li><a class="nav-link" href="<?php echo site_url('users/logout'); ?>">
          Log out
        </a></li>

      <?php endif; ?>

    </ul>
  </div>
</nav>

<div class="container">

  <br>

  <!-- Flash messages -->

  <?php if($this->session->flashdata('user_registered')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('user_registered').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_created')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('post_created').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_updated')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('post_updated').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_deleted')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('post_deleted').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_created')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('category_created').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('login_failed')) : ?>
     <?php echo '<p class="alert alert-danger">'.
     $this->session->flashdata('login_failed').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('user_logged_in')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('user_logged_in').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('user_logged_out')) : ?>
     <?php echo '<p class="alert alert-success">'.
     $this->session->flashdata('user_logged_out').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('not_logged_in')) : ?>
     <?php echo '<p class="alert alert-danger">'.
     $this->session->flashdata('not_logged_in').
     '</p>'; ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_deleted')) : ?>
     <?php echo '<p class="alert alert-danger">'.
     $this->session->flashdata('category_deleted').
     '</p>'; ?>
  <?php endif; ?>

<br>
<br>