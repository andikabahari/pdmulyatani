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
                                    <h5 class="float-left mb-0 mt-2">Daftar Pengguna</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Nama Pengguna</th>
                                                    <th>Username</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $no = 1; ?>
                                                <?php foreach ($pengguna as $row): ?>

                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $row->nama_pengguna; ?></td>
                                                        <td><?php echo $row->username; ?></td>
                                                        <td>
                                                            <a href="<?php echo site_url('pengguna/edit/' . $row->id_pengguna); ?>" class="btn btn-success">Edit</a>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('partials/footer'); ?>

    </div>

    <?php $this->load->view('partials/js'); ?>

    <script>
        function confirm_delete() {
            return confirm('Apakah anda ingin akan menghapus data tersebut?');
        }
    </script>

</body>
</html>
