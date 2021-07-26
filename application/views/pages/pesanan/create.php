<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pesanan &mdash; <?php echo $this->config->item('site_name'); ?></title>

  <?php $this->load->view('partials/css'); ?>

  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

  <style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 37px !important;
    }
  </style>
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
                                Pesanan
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
                                    <h5 class="float-left mb-0 mt-2">Tambah Pesanan</h5>
                                </div>

                                <?php echo form_open('pesanan/store'); ?>

                                    <div class="card-body">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pegawai</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control select2" name="nip"  style="width: 100%;">
                                                    <option value="">&mdash; Pilih &mdash;</option>

                                                    <?php foreach ($pegawai as $row): ?>

                                                        <option value="<?php echo $row->nip; ?>"><?php echo $row->nip; ?> &mdash; <?php echo $row->nama_pegawai; ?></option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Banyak</label>
                                            <div class="col-sm-12 col-md-7"><input type="number" name="banyak" class="form-control"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                                            <div class="col-sm-12 col-md-7"><input type="date" name="tanggal_pesanan" class="form-control" value="<?php echo date('Y-m-d'); ?>"></div>
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

    <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>

    <script>
        $('.select2').select2();
    </script>

</body>
</html>
