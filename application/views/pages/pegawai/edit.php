<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pegawai &mdash; <?php echo $this->config->item('site_name'); ?></title>

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
                                Pegawai
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
                                    <h5 class="float-left mb-0 mt-2">Edit Pegawai</h5>
                                </div>

                                <?php echo form_open('pegawai/update'); ?>

                                    <div class="card-body">
                                        <input type="hidden" name="old_nip" value="<?php echo $pegawai->nip; ?>">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP</label>
                                            <div class="col-sm-12 col-md-7"><input type="text" name="nip" class="form-control" value="<?php echo $pegawai->nip; ?>"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pegawai</label>
                                            <div class="col-sm-12 col-md-7"><input type="text" name="nama_pegawai" class="form-control" value="<?php echo $pegawai->nama_pegawai; ?>"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Posisi</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="custom-select" name="posisi">
                                                    <option value="">&mdash; Pilih &mdash;</option>
                                                    <option value="Tetap" <?php echo $pegawai->posisi == 'Tetap' ? 'selected' : ''; ?>>Tetap</option>
                                                    <option value="Borongan"  <?php echo $pegawai->posisi == 'Borongan' ? 'selected' : ''; ?>>Borongan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gaji Pokok</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="custom-select" name="kode_gaji">
                                                    <option value="">&mdash; Pilih &mdash;</option>

                                                    <?php foreach ($gaji as $row): ?>

                                                        <option value="<?php echo $row->kode_gaji; ?>" <?php echo $pegawai->kode_gaji == $row->kode_gaji ? 'selected' : ''; ?>>Rp<?php echo format_rupiah($row->gaji_pokok); ?></option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                            <div class="col-sm-12 col-md-7">
                                                <textarea name="alamat" class="form-control"><?php echo $pegawai->alamat; ?></textarea>
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
