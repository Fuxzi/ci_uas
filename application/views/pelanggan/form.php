<?php $is_edit = isset($pelanggan); ?>
<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-<?= $is_edit ? 'edit' : 'plus' ?> mr-1"></i>
        <?= $is_edit ? 'Edit' : 'Tambah' ?> Pelanggan
      </div>
      <div class="card-body">
        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
        <form action="<?= base_url($is_edit ? 'pelanggan/update/' . $pelanggan->id : 'pelanggan/simpan') ?>" method="POST">
          <div class="form-group">
            <label>Nama Pelanggan <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control"
                   value="<?= $is_edit ? $pelanggan->nama : set_value('nama') ?>" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"><?= $is_edit ? $pelanggan->alamat : set_value('alamat') ?></textarea>
          </div>
          <div class="form-group">
            <label>No Telepon <span class="text-danger">*</span></label>
            <input type="text" name="no_telepon" class="form-control"
                   value="<?= $is_edit ? $pelanggan->no_telepon : set_value('no_telepon') ?>" required>
          </div>
          <div class="d-flex justify-content-between">
            <a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary">
              <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save mr-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
