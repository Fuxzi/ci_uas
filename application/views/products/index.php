<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span><i class="fas fa-box mr-1"></i> Data Produk</span>
    <a href="<?= base_url('produk/tambah') ?>" class="btn btn-light btn-sm">
      <i class="fas fa-plus mr-1"></i> Tambah Produk
    </a>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($produk): $no = 1; foreach ($produk as $p): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><span class="badge badge-secondary"><?= $p->kode_produk ?></span></td>
            <td><?= $p->nama_produk ?></td>
            <td>Rp <?= number_format($p->harga, 0, ',', '.') ?></td>
            <td>
              <span class="badge badge-<?= $p->stok > 0 ? 'success' : 'danger' ?>">
                <?= $p->stok ?>
              </span>
            </td>
            <td>
              <a href="<?= base_url('produk/edit/' . $p->id) ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
              </a>
              <a href="<?= base_url('produk/hapus/' . $p->id) ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Hapus produk ini?')">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data produk</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
