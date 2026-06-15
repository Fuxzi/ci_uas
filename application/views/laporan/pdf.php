<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .periode { color: #666; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #343a40; color: white; padding: 8px; text-align: left; }
        td { border: 1px solid #ddd; padding: 8px; }
        .text-right { text-align: right; }
        .ringkasan { margin-bottom: 30px; }
        .ringkasan-box { 
            display: inline-block; 
            width: 23%; 
            padding: 10px; 
            border: 1px solid #ddd;
            margin: 5px;
        }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PT Maju Jaya</h2>
        <h3>Laporan Penjualan</h3>
        <p class="periode">
            Periode: <?= date('d/m/Y', strtotime($tgl_mulai)) ?> - 
            <?= date('d/m/Y', strtotime($tgl_akhir)) ?>
        </p>
    </div>

    <!-- Ringkasan -->
    <?php if ($jenis == 'semua' || $jenis == 'ringkasan'): ?>
    <div class="ringkasan">
        <h4>Ringkasan</h4>
        <div class="ringkasan-box">
            <strong>Total Order</strong><br>
            <?= $ringkasan['total_order'] ?>
        </div>
        <div class="ringkasan-box">
            <strong>Total Qty</strong><br>
            <?= $ringkasan['total_qty'] ?>
        </div>
        <div class="ringkasan-box">
            <strong>Total Penjualan</strong><br>
            Rp <?= number_format($ringkasan['total_penjualan'], 0, ',', '.') ?>
        </div>
        <div class="ringkasan-box">
            <strong>Rata-rata</strong><br>
            Rp <?= number_format($ringkasan['rata_rata'], 0, ',', '.') ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Per Sales -->
    <?php if ($jenis == 'semua' || $jenis == 'per_sales'): ?>
    <h4>Laporan Per Sales</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Sales</th>
                <th>Total Order</th>
                <th>Total Qty</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($per_sales as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->sales_name ?></td>
                <td><?= $row->total_order ?></td>
                <td><?= $row->total_qty ?></td>
                <td class="text-right">Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($jenis == 'semua') echo '<div class="page-break"></div>'; ?>
    <?php endif; ?>

    <!-- Per Produk -->
    <?php if ($jenis == 'semua' || $jenis == 'per_produk'): ?>
    <h4>Top 10 Produk Terlaris</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Qty Terjual</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($per_produk as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->kode_produk ?></td>
                <td><?= $row->nama_produk ?></td>
                <td><?= $row->total_qty ?></td>
                <td class="text-right">Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($jenis == 'semua') echo '<div class="page-break"></div>'; ?>
    <?php endif; ?>

    <!-- Per Periode -->
    <?php if ($jenis == 'semua' || $jenis == 'per_periode'): ?>
    <h4>Laporan Per Hari</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Order</th>
                <th>Total Qty</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($per_periode as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                <td><?= $row->total_order ?></td>
                <td><?= $row->total_qty ?></td>
                <td class="text-right">Rp <?= number_format($row->total_penjualan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>