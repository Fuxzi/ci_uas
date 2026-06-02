<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($title) ? $title . ' - ' : '' ?>Sales Order PT Maju Jaya</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  :root { --primary: #1e3c72; --secondary: #2a5298; }
  body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
  .sidebar { width: 250px; min-height: 100vh; background: linear-gradient(180deg, var(--primary), var(--secondary)); position: fixed; top: 0; left: 0; z-index: 100; }
  .sidebar .brand { padding: 20px; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.15); }
  .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 10px 20px; border-radius: 8px; margin: 2px 10px; transition: all 0.2s; }
  .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color: #fff; }
  .sidebar .nav-link i { width: 20px; margin-right: 8px; }
  .main-content { margin-left: 250px; padding: 20px; }
  .topbar { background: #fff; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); display: flex; justify-content: space-between; align-items: center; }
  .badge-role { font-size: 11px; padding: 4px 10px; border-radius: 20px; }
  .badge-admin { background: #e74c3c; color: #fff; }
  .badge-sales { background: #2ecc71; color: #fff; }
  .badge-manager { background: #f39c12; color: #fff; }
  .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
  .card-header { border-radius: 12px 12px 0 0 !important; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; }
  .btn-primary { background: var(--primary); border-color: var(--primary); }
  .btn-primary:hover { background: var(--secondary); border-color: var(--secondary); }
  .stat-card { border-radius: 12px; color: #fff; padding: 20px; }
  .table th { background: #f8f9fa; }
  .badge-draft { background: #95a5a6; color: #fff; }
  .badge-dikirim { background: #3498db; color: #fff; }
  .badge-selesai { background: #27ae60; color: #fff; }
  .badge-dibatalkan { background: #e74c3c; color: #fff; }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="brand">
    <i class="fas fa-shopping-cart fa-lg mr-2"></i>
    <strong>PT Maju Jaya</strong>
    <div class="small mt-1 text-white-50">Sales Order System</div>
  </div>
  <nav class="mt-3">
    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
      <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="<?= base_url('order') ?>" class="nav-link <?= (strpos(uri_string(), 'order') !== false) ? 'active' : '' ?>">
      <i class="fas fa-file-invoice"></i> Sales Order
    </a>
    <?php if ($this->session->userdata('role') === 'admin'): ?>
    <a href="<?= base_url('produk') ?>" class="nav-link <?= (strpos(uri_string(), 'produk') !== false) ? 'active' : '' ?>">
      <i class="fas fa-box"></i> Produk
    </a>
    <a href="<?= base_url('pelanggan') ?>" class="nav-link <?= (strpos(uri_string(), 'pelanggan') !== false) ? 'active' : '' ?>">
      <i class="fas fa-users"></i> Pelanggan
    </a>
    <?php endif; ?>
    <hr style="border-color: rgba(255,255,255,0.2); margin: 10px 20px;">
    <a href="<?= base_url('logout') ?>" class="nav-link">
      <i class="fas fa-sign-out-alt"></i> Keluar
    </a>
  </nav>
</div>

<!-- Main Content -->
<div class="main-content">
  <!-- Topbar -->
  <div class="topbar">
    <h5 class="mb-0 font-weight-bold"><?= isset($title) ? $title : 'Dashboard' ?></h5>
    <div>
      <i class="fas fa-user-circle mr-1 text-muted"></i>
      <strong><?= $this->session->userdata('nama') ?></strong>
      <span class="badge badge-role badge-<?= $this->session->userdata('role') ?> ml-2">
        <?= strtoupper($this->session->userdata('role')) ?>
      </span>
    </div>
  </div>

  <!-- Flash Messages -->
  <?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <i class="fas fa-check-circle mr-1"></i> <?= $this->session->flashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <i class="fas fa-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error') ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
  </div>
  <?php endif; ?>
