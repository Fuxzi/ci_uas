<div class="row mb-4">
  <div class="col-md-4">
    <div class="card stat-card" style="background: linear-gradient(135deg,#1e3c72,#2a5298)">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="text-white-50 small">Total Produk</div>
          <h2 class="mb-0 font-weight-bold"><?= $total_produk ?></h2>
        </div>
        <i class="fas fa-box fa-2x opacity-50"></i>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card" style="background: linear-gradient(135deg,#11998e,#38ef7d); color:#fff">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div style="color:rgba(255,255,255,0.7)" class="small">Total Pelanggan</div>
          <h2 class="mb-0 font-weight-bold"><?= $total_pelanggan ?></h2>
        </div>
        <i class="fas fa-users fa-2x" style="opacity:0.5"></i>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card" style="background: linear-gradient(135deg,#f7971e,#ffd200); color:#333">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="small" style="color:rgba(0,0,0,0.5)">Total Order</div>
          <h2 class="mb-0 font-weight-bold"><?= $total_order ?></h2>
        </div>
        <i class="fas fa-file-invoice fa-2x" style="opacity:0.4"></i>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <i class="fas fa-history mr-1"></i> Order Terbaru
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
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($order_terbaru): foreach ($order_terbaru as $o): ?>
          <tr>
            <td><a href="<?= base_url('order/detail/' . $o->id) ?>"><?= $o->no_order ?></a></td>
            <td><?= $o->nama_pelanggan ?></td>
            <td><?= $o->nama_sales ?></td>
            <td><?= date('d/m/Y', strtotime($o->tanggal)) ?></td>
            <td>Rp <?= number_format($o->total_harga, 0, ',', '.') ?></td>
            <td><span class="badge badge-<?= $o->status ?>"><?= strtoupper($o->status) ?></span></td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center text-muted py-4">Belum ada order</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
