<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login &mdash; <?php echo $this->config->item('site_name'); ?></title>

  <?php $this->load->view('partials/css'); ?>

</head>
<body class="hold-transition login-page">
    <div class="login-box">

        <?php $this->load->view('partials/message'); ?>
        
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo site_url('auth'); ?>" class="h1"><?php echo $this->config->item('site_name'); ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silakan login untuk memulai sesi.</p>

                <?php echo form_open('auth/login'); ?>

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                    
                <?php echo form_close(); ?>
                
            </div>
        </div>
    </div>

    <?php $this->load->view('partials/js'); ?>

</body>
</html>
