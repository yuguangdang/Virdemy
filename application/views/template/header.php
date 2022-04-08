<html>

<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  <script src="https://kit.fontawesome.com/857b37eadb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=ZCOOL+KuaiLe&display=swap" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light">

    <div>
      <a class="navbar-brand" href="https://infs3202-73c50509.uqcloud.net/Virdemy/home">Virdemy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <form class="form-inline my-0 py-0 my-lg-0">
        <input class="form-control input-sm mr-2 ml-2" type="search" placeholder="Search course" aria-label="Search">
        <button class="button mr-2" type="submit">Search</button>
      </form>
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
            <a href="<?php echo base_url(); ?>#"> Create Course </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>#"> My Learning </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>#"> <i class="fa-solid fa-heart"></i> </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>#"> <i class="fa-solid fa-cart-shopping"></i> </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>#"> <i class="fa-solid fa-user"></i> </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>login/logout"> <i class="fa-solid fa-arrow-right-from-bracket"></i> </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>