<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Laporan Penjualan</h2>
        
        <!-- Tombol Export -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                📄 Export PDF
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onclick="exportPDF('semua')">Semua Laporan</a>
                <a class="dropdown-item" href="#" onclick="exportPDF('per_sales')">Per Sales</a>
                <a class="dropdown-item" href="#" onclick="exportPDF('per_produk')">Per Produk</a>
                <a class="dropdown-item" href="#" onclick="exportPDF('per_periode')">Per Periode</a>
            </div>
        </div>
    </div>

    <!-- Form Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="get" class="form-inline">
                <div class="form-group mr-3">
                    <label class="mr-2">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" 
                           value="<?= $tgl_mulai ?>">
                </div>
                <div class="form-group mr-3">
                    <label class="mr-2">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" 
                           value="<?= $tgl_akhir ?>">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-secondary ml-2">Reset</a>
            </form>
        </div>
    </div>

    <!-- Ringkasan Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Total Order</h6>
                    <h3><?= $ringkasan['total_order'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Produk Terjual</h6>
                    <h3><?= $ringkasan['total_qty'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6>Total Penjualan</h6>
                    <h3>Rp <?= number_format($ringkasan['total_penjualan'], 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6>Rata-rata Order</h6>
                    <h3>Rp <?= number_format($ringkasan['rata_rata'], 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#sales">Per Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#produk">Per Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#periode">Per Periode</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Tab Per Sales -->
        <div class="tab-pane fade show active" id="sales">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableSales">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Sales</th>
                                <th>Total Order</th>
                                <th>Total Qty</th>
                                <th>Total Penjualan</th>
                                <th>Kontribusi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($per_sales)): ?>
                                <?php $no = 1; foreach ($per_sales as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->sales_name ?></td>
                                    <td><?= $row->total_order ?></td>
                                    <td><?= $row->total_qty ?></td>
                                    <td class="text-right">
                                        Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $persen = $ringkasan['total_penjualan'] > 0 
                                            ? ($row->total_penjualan / $ringkasan['total_penjualan']) * 100 
                                            : 0;
                                        ?>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: <?= $persen ?>%">
                                                <?= number_format($persen, 1) ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('laporan/detail_sales/'.$row->sales_id) ?>" 
                                           class="btn btn-sm btn-info">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Per Produk -->
        <div class="tab-pane fade" id="produk">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableProduk">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Qty Terjual</th>
                                <th>Total Order</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($per_produk)): ?>
                                <?php $no = 1; foreach ($per_produk as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->kode_produk ?></td>
                                    <td><?= $row->nama_produk ?></td>
                                    <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                                    <td><?= $row->total_qty ?></td>
                                    <td><?= $row->total_order ?></td>
                                    <td class="text-right">
                                        Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Per Periode -->
        <div class="tab-pane fade" id="periode">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tablePeriode">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total Order</th>
                                <th>Total Qty</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($per_periode)): ?>
                                <?php $no = 1; foreach ($per_periode as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                                    <td><?= $row->total_order ?></td>
                                    <td><?= $row->total_qty ?></td>
                                    <td class="text-right">
                                        Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Export PDF & DataTables -->
<script>
$(document).ready(function() {
    // Aktifkan DataTables
    $('#tableSales, #tableProduk, #tablePeriode').DataTable({
        "pageLength": 10,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});

function exportPDF(jenis) {
    var tglMulai = $('input[name="tgl_mulai"]').val();
    var tglAkhir = $('input[name="tgl_akhir"]').val();
    
    window.open(
        '<?= base_url("laporan/export_pdf") ?>?tgl_mulai=' + tglMulai + 
        '&tgl_akhir=' + tglAkhir + '&jenis=' + jenis,
        '_blank'
    );
}
</script>