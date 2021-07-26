<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penggajian &mdash; <?php echo $this->config->item('site_name'); ?></title>

    <?php $this->load->view('partials/css'); ?>

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.css'); ?>">

    <style>
        .ui-datepicker-calendar {
            display: none;
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
                        <div class="col-md-8">
                            <h1 class="m-0">
                                Laporan Penggajian &mdash; <?php echo ! empty($year) && ! empty($month) ? date('M', strtotime("$year-$month-01")) : date('M'); ?>, <?php echo ! empty($year) && ! empty($month) ? date('Y', strtotime("$year-$month-01")) : date('Y'); ?>
                            </h1>
                        </div>
                        <div class="col-md-4">
                            <form action="<?php site_url('laporan'); ?>">
                                <div class="input-group mt-3 mt-md-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="form-control" name="year_month" id="datepicker" placeholder="yyyy-mm" value="<?php echo $this->input->get('year_month'); ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary">Lihat</button>
                                    </div>
                                </div>
                            </form>
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
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $jumlah_absen; ?></h3>
                                    <p>Jumlah Absen</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-table"></i>
                                </div>
                                <a href="<?php echo site_url('absen'); ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $jumlah_pesanan; ?></h3>
                                    <p>Jumlah Pesanan</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <a href="<?php echo site_url('pesanan'); ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $jumlah_pegawai; ?></h3>
                                    <p>Jumlah Pegawai</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <a href="<?php echo site_url('pegawai'); ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-absen-tab" data-toggle="pill" href="#custom-tabs-absen" role="tab" aria-controls="custom-tabs-absen" aria-selected="true">Pegawai Tetap</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-pesanan-tab" data-toggle="pill" href="#custom-tabs-pesanan" role="tab" aria-controls="custom-tabs-pesanan" aria-selected="false">Pegawai Borongan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-absen" role="tabpanel" aria-labelledby="custom-tabs-absen-tab">
                                            <p>(*) Jumlah gaji sudah termasuk potongan absen setengah hari.</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" style="width: 10px">No</th>
                                                            <th rowspan="2">NIP</th>
                                                            <th rowspan="2">Nama Pegawai</th>
                                                            <th colspan="4">Gaji dan Potongan</th>
                                                            <th rowspan="2">Jumlah Gaji</th>
                                                            <th rowspan="2">Jumlah Potongan</th>
                                                            <th rowspan="2">Total</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Banyak Absen</th>
                                                            <th>Gaji Pokok</th>
                                                            <th>Absen Setengah</th>
                                                            <th>Potongan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                        <?php $no = 1; ?>
                                                        <?php foreach ($gaji_pegawai_tetap as $row): ?>
                                                            
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->nip; ?></td>
                                                                <td><?php echo $row->nama_pegawai; ?></td>
                                                                <td><?php echo $row->banyak_absen; ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->gaji_pokok); ?></td>
                                                                <td><?php echo $row->banyak_absen_setengah; ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->gaji_setengah); ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->jumlah_gaji); ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->jumlah_potongan); ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->total); ?></td>
                                                            </tr>

                                                        <?php endforeach; ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-pesanan" role="tabpanel" aria-labelledby="custom-tabs-pesanan-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">No</th>
                                                            <th>NIP</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Banyak Pesanan</th>
                                                            <th>Gaji Pokok</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $no = 1; ?>
                                                        <?php foreach ($gaji_pegawai_borongan as $row): ?>
                                                            
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->nip; ?></td>
                                                                <td><?php echo $row->nama_pegawai; ?></td>
                                                                <td><?php echo $row->banyak_pesanan; ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->gaji_pokok); ?></td>
                                                                <td>Rp<?php echo format_rupiah($row->jumlah); ?></td>
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
            </div>
        </div>

        <?php $this->load->view('partials/footer'); ?>

    </div>

    <?php $this->load->view('partials/js'); ?>

    <script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy-mm',
                onClose: function(dateText, inst) { 
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
        });
    </script>

</body>
</html>
