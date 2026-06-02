<div class="card">
  <div class="card-header">
    <i class="fas fa-plus mr-1"></i> Buat Sales Order Baru
  </div>
  <div class="card-body">
    <form action="<?= base_url('order/simpan') ?>" method="POST" id="formOrder">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Pelanggan <span class="text-danger">*</span></label>
            <select name="id_pelanggan" class="form-control" required>
              <option value="">-- Pilih Pelanggan --</option>
              <?php foreach ($pelanggan as $p): ?>
              <option value="<?= $p->id ?>"><?= $p->nama ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Catatan</label>
            <input type="text" name="catatan" class="form-control" placeholder="Catatan tambahan (opsional)">
          </div>
        </div>
      </div>

      <hr>
      <h6 class="font-weight-bold mb-3"><i class="fas fa-list mr-1"></i> Item Produk</h6>

      <div id="item-container">
        <div class="row item-row mb-2 align-items-center">
          <div class="col-md-6">
            <select name="id_produk[]" class="form-control produk-select" required onchange="hitungSubtotal(this)">
              <option value="">-- Pilih Produk --</option>
              <?php foreach ($produk as $p): ?>
              <option value="<?= $p->id ?>" data-harga="<?= $p->harga ?>">
                <?= $p->kode_produk ?> - <?= $p->nama_produk ?> (Rp <?= number_format($p->harga,0,',','.') ?>)
              </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <input type="number" name="jumlah[]" class="form-control jumlah-input" placeholder="Qty" min="1" value="1" required onchange="hitungSubtotal(this)">
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly style="background:#f8f9fa">
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm hapus-item" onclick="hapusItem(this)" style="display:none">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="tambahItem()">
        <i class="fas fa-plus mr-1"></i> Tambah Produk
      </button>

      <hr>
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="card bg-light">
            <div class="card-body py-2">
              <div class="d-flex justify-content-between">
                <strong>TOTAL HARGA:</strong>
                <strong id="total-display" class="text-primary">Rp 0</strong>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="<?= base_url('order') ?>" class="btn btn-secondary">
          <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
          <i class="fas fa-save mr-1"></i> Simpan Order
        </button>
      </div>
    </form>
  </div>
</div>

<script>
const produkOptions = `<?php $opts=''; foreach($produk as $p): $opts .= '<option value="'.$p->id.'" data-harga="'.$p->harga.'">'.$p->kode_produk.' - '.$p->nama_produk.' (Rp '.number_format($p->harga,0,',','.').')</option>'; endforeach; echo $opts; ?>`;

function formatRupiah(n) {
  return 'Rp ' + n.toLocaleString('id-ID');
}

function hitungSubtotal(el) {
  const row = el.closest('.item-row');
  const select = row.querySelector('.produk-select');
  const opt = select.options[select.selectedIndex];
  const harga = parseFloat(opt.dataset.harga || 0);
  const qty   = parseInt(row.querySelector('.jumlah-input').value || 0);
  const subtot = harga * qty;
  row.querySelector('.subtotal-display').value = subtot > 0 ? formatRupiah(subtot) : '';
  hitungTotal();
}

function hitungTotal() {
  let total = 0;
  document.querySelectorAll('.item-row').forEach(row => {
    const select = row.querySelector('.produk-select');
    const opt = select.options[select.selectedIndex];
    const harga = parseFloat(opt?.dataset.harga || 0);
    const qty   = parseInt(row.querySelector('.jumlah-input').value || 0);
    total += harga * qty;
  });
  document.getElementById('total-display').textContent = formatRupiah(total);
}

function tambahItem() {
  const container = document.getElementById('item-container');
  const div = document.createElement('div');
  div.className = 'row item-row mb-2 align-items-center';
  div.innerHTML = `
    <div class="col-md-6">
      <select name="id_produk[]" class="form-control produk-select" required onchange="hitungSubtotal(this)">
        <option value="">-- Pilih Produk --</option>
        ${produkOptions}
      </select>
    </div>
    <div class="col-md-2">
      <input type="number" name="jumlah[]" class="form-control jumlah-input" placeholder="Qty" min="1" value="1" required onchange="hitungSubtotal(this)">
    </div>
    <div class="col-md-3">
      <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly style="background:#f8f9fa">
    </div>
    <div class="col-md-1">
      <button type="button" class="btn btn-danger btn-sm" onclick="hapusItem(this)">
        <i class="fas fa-times"></i>
      </button>
    </div>`;
  container.appendChild(div);
}

function hapusItem(btn) {
  const rows = document.querySelectorAll('.item-row');
  if (rows.length > 1) {
    btn.closest('.item-row').remove();
    hitungTotal();
  }
}
</script>
