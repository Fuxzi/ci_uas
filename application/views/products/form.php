<?php $is_edit = isset($produk); ?>
<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-<?= $is_edit ? 'edit' : 'plus' ?> mr-1"></i>
        <?= $is_edit ? 'Edit' : 'Tambah' ?> Produk
      </div>
      <div class="card-body">
        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
        <form action="<?= base_url($is_edit ? 'produk/update/' . $produk->id : 'produk/simpan') ?>" method="POST">
          <?php if (!$is_edit): ?>
          <div class="form-group">
            <label>Kode Produk <span class="text-danger">*</span></label>
            <input type="text" name="kode_produk" class="form-control" value="<?= set_value('kode_produk') ?>" placeholder="Contoh: ELK-006" required>
          </div>
          <?php else: ?>
          <div class="form-group">
            <label>Kode Produk</label>
            <input type="text" class="form-control" value="<?= $produk->kode_produk ?>" readonly>
          </div>
          <?php endif; ?>
          <div class="form-group">
            <label>Nama Produk <span class="text-danger">*</span></label>
            <input type="text" name="nama_produk" class="form-control"
                   value="<?= $is_edit ? $produk->nama_produk : set_value('nama_produk') ?>" required>
          </div>
          <div class="form-group">
            <label>Harga (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="harga" class="form-control"
                   value="<?= $is_edit ? $produk->harga : set_value('harga') ?>" min="0" required>
          </div>
          <div class="form-group">
            <label>Stok <span class="text-danger">*</span></label>
            <input type="number" name="stok" class="form-control"
                   value="<?= $is_edit ? $produk->stok : set_value('stok') ?>" min="0" required>
          </div>
          <div class="d-flex justify-content-between">
            <a href="<?= base_url('produk') ?>" class="btn btn-secondary">
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
