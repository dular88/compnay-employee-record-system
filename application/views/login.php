<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "css.php"; ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b><?php echo PROJECT_NAME; ?></b></a>
    <?php if(@$this->session->flashdata("msg_login")=="invalid"){ ?>
      <div class="alert alert-danger invalid" role="alert">
       Invalid Login !!!
      </div>
      <?php } ?>

      <?php
       if(@$this->session->flashdata("msg_login")=="logout"){ ?>
      <div class="alert alert-success logout" role="alert">
       Successfully Logout 
      </div>
      <?php } ?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo base_url();?>login_submit" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Enter Email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Enter Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
             <p class="mb-0">
              <a href="<?php echo base_url();?>registration" class="text-center">Register a new Company</a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



</body>
</html>

