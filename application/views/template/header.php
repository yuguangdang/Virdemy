<html>

<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  <script src="https://kit.fontawesome.com/857b37eadb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=ZCOOL+KuaiLe&display=swap" rel="stylesheet">
  <link href='<?= base_url() ?>assets/bootstrap-star-rating/css/star-rating.min.css' type='text/css' rel='stylesheet'>
  <script src='<?= base_url() ?>assets/bootstrap-star-rating/js/star-rating.min.js' type='text/javascript'></script>
</head>

<body>
  <div id="load"></div>
  <nav class="navbar navbar-expand-lg navbar-light">

    <div>
      <a class="navbar-brand" href="<?php echo base_url(); ?>/home">Virdemy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php echo form_open(base_url() . 'home/search', array(
        'class' => 'form-inline my-0 py-0 my-lg-0'
      )); ?>
      <input class="form-control input-sm mr-2 ml-2" type="search" placeholder="Search course" name="query" aria-label="Search" value="<?php (isset($query))? $query : '' ?>">
      <input class="button" type="submit" value="Search" />
      <?php echo form_close(); ?>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav my-lg-0">
        <?php if (!$this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>login"> Login </a>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a class="<?php echo (isset($page) && $page === 'create_course')? 'active' : '' ?>" href="<?php echo base_url(); ?>course/render_create_course"> Create Course </a>
          </li>
          <li class="nav-item">
            <a class="<?php echo (isset($page) && $page === 'learning')? 'active' : '' ?>" href="<?php echo base_url(); ?>learning"> My Learning </a>
          </li>
          <li class="nav-item">
            <a class="<?php echo (isset($page) && $page === 'cart')? 'active' : '' ?>" href="<?php echo base_url() . 'cart'; ?>"> <i class="fa-solid fa-cart-shopping"></i> </a>
          </li>
          <li class="nav-item">
            <a class="<?php echo (isset($page) && $page === 'user')? 'active' : '' ?>" href="<?php echo base_url(); ?>profile"> <i class="fa-solid fa-user"></i> </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>login/logout"> <i class="fa-solid fa-arrow-right-from-bracket"></i> </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>