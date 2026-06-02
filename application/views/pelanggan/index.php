<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span><i class="fas fa-users mr-1"></i> Data Pelanggan</span>
    <a href="<?= base_url('pelanggan/tambah') ?>" class="btn btn-light btn-sm">
      <i class="fas fa-plus mr-1"></i> Tambah Pelanggan
    </a>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($pelanggan): $no = 1; foreach ($pelanggan as $p): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $p->nama ?></td>
            <td><?= $p->alamat ?: '<span class="text-muted">-</span>' ?></td>
            <td><?= $p->no_telepon ?></td>
            <td>
              <a href="<?= base_url('pelanggan/edit/' . $p->id) ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
              </a>
              <a href="<?= base_url('pelanggan/hapus/' . $p->id) ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Hapus pelanggan ini?')">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data pelanggan</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
