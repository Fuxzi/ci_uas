<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span><i class="fas fa-file-invoice mr-1"></i> Daftar Sales Order</span>
    <?php if (in_array($this->session->userdata('role'), ['admin','sales'])): ?>
    <a href="<?= base_url('order/buat') ?>" class="btn btn-light btn-sm">
      <i class="fas fa-plus mr-1"></i> Buat Order
    </a>
    <?php endif; ?>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>No Order</th>
            <th>Pelanggan</th>
            <th>Sales</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($orders): foreach ($orders as $o): ?>
          <tr>
            <td><strong><?= $o->no_order ?></strong></td>
            <td><?= $o->nama_pelanggan ?></td>
            <td><?= $o->nama_sales ?></td>
            <td><?= date('d/m/Y', strtotime($o->tanggal)) ?></td>
            <td><strong>Rp <?= number_format($o->total_harga, 0, ',', '.') ?></strong></td>
            <td>
              <span class="badge badge-<?= $o->status ?> p-2">
                <?= strtoupper($o->status) ?>
              </span>
            </td>
            <td>
              <a href="<?= base_url('order/detail/' . $o->id) ?>" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Detail
              </a>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center text-muted py-4">Belum ada sales order</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
