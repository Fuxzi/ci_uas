<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-file-invoice mr-1"></i> Detail Order: <?= $order->no_order ?></span>
        <span class="badge badge-<?= $order->status ?> p-2"><?= strtoupper($order->status) ?></span>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <small class="text-muted">Pelanggan</small>
            <p class="mb-1 font-weight-bold"><?= $order->nama_pelanggan ?></p>
            <small class="text-muted"><?= $order->alamat ?></small><br>
            <small class="text-muted"><?= $order->no_telepon ?></small>
          </div>
          <div class="col-md-6 text-right">
            <small class="text-muted">Sales</small>
            <p class="mb-1 font-weight-bold"><?= $order->nama_sales ?></p>
            <small class="text-muted">Tanggal: <?= date('d/m/Y', strtotime($order->tanggal)) ?></small>
          </div>
        </div>
        <hr>
        <h6 class="font-weight-bold">Item Pesanan</h6>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Produk</th>
              <th class="text-center">Qty</th>
              <th class="text-right">Harga Satuan</th>
              <th class="text-right">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($detail as $d): ?>
            <tr>
              <td><?= $d->nama_produk ?> <small class="text-muted">(<?= $d->kode_produk ?>)</small></td>
              <td class="text-center"><?= $d->jumlah ?></td>
              <td class="text-right">Rp <?= number_format($d->harga_satuan, 0, ',', '.') ?></td>
              <td class="text-right">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="text-right">TOTAL</th>
              <th class="text-right text-primary">Rp <?= number_format($order->total_harga, 0, ',', '.') ?></th>
            </tr>
          </tfoot>
        </table>
        <?php if ($order->catatan): ?>
        <div class="alert alert-light border">
          <small><strong>Catatan:</strong> <?= $order->catatan ?></small>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <?php if (in_array($this->session->userdata('role'), ['admin','manager'])): ?>
    <div class="card">
      <div class="card-header"><i class="fas fa-exchange-alt mr-1"></i> Ubah Status</div>
      <div class="card-body">
        <form action="<?= base_url('order/ubah_status/' . $order->id) ?>" method="POST">
          <div class="form-group">
            <label>Status Order</label>
            <select name="status" class="form-control">
              <?php foreach (['draft','dikirim','selesai','dibatalkan'] as $s): ?>
              <option value="<?= $s ?>" <?= $order->status == $s ? 'selected' : '' ?>><?= strtoupper($s) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-save mr-1"></i> Simpan Status
          </button>
        </form>
      </div>
    </div>
    <?php endif; ?>
    <div class="mt-3">
      <a href="<?= base_url('order') ?>" class="btn btn-secondary btn-block">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
      </a>
    </div>
  </div>
</div>
