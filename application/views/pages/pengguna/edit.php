<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengguna &mdash; <?php echo $this->config->item('site_name'); ?></title>

  <?php $this->load->view('partials/css'); ?>

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view('partials/navbar'); ?>

        <?php $this->load->view('partials/sidebar'); ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0">
                                Pengguna
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <?php $this->load->view('partials/message'); ?>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="float-left mb-0 mt-2">Edit Pengguna</h5>
                                </div>

                                <?php echo form_open('pengguna/update'); ?>

                                    <div class="card-body">
                                        <input type="hidden" name="id_pengguna" value="<?php echo $pengguna->id_pengguna; ?>">
                                        <input type="hidden" name="old_username" value="<?php echo $pengguna->username; ?>">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengguna</label>
                                            <div class="col-sm-12 col-md-7"><input type="text" name="nama_pengguna" class="form-control" value="<?php echo $pengguna->nama_pengguna; ?>"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                            <div class="col-sm-12 col-md-7"><input type="text" name="username" class="form-control" value="<?php echo $pengguna->username; ?>"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Baru</label>
                                            <div class="col-sm-12 col-md-7"><input type="password" name="password" class="form-control"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                                            <div class="col-sm-12 col-md-7"><input type="password" name="confirm_password" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                    </div>

                                <?php echo form_close(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('partials/footer'); ?>

    </div>

    <?php $this->load->view('partials/js'); ?>

</body>
</html>
