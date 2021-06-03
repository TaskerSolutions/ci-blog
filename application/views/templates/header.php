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

    <!-- Link -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>posts">
          Latest posts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>categories">
          Categories
        </a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">

<br>
<br>