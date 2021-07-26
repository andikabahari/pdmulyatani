<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Absen &mdash; <?php echo $this->config->item('site_name'); ?></title>

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
                                Absen
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
                                    <h5 class="float-left mb-0 mt-2">Absen Masuk</h5>
                                </div>

                                <?php echo form_open('absen/absen-masuk'); ?>

                                    <div class="card-body">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                                            <div class="col-sm-12 col-md-7"><input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu</label>
                                            <div class="col-sm-12 col-md-7"><input type="text" name="waktu" class="form-control" value="<?php echo date('H:i:s'); ?>" placeholder="hh:mm:ss"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-3 col-lg-3"></div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>NIP</th>
                                                                <th>Nama Pegawai</th>
                                                                <th>Masuk?</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php foreach ($pegawai as $row): ?>
        
                                                                <tr>
                                                                    <td><?php echo $row->nip; ?></td>
                                                                    <td><?php echo $row->nama_pegawai; ?></td>
                                                                    <td class="text-center">
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="nip[]" value="<?php echo $row->nip; ?>">
                                                                            <label class="form-check-label">Ya</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                
                                                            <?php endforeach; ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
