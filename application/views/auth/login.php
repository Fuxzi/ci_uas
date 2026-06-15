<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Sales Order PT Maju Jaya</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; display: flex; align-items: center; }
  .card-login { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
  .card-header-login { background: linear-gradient(135deg, #1e3c72, #2a5298); color: #fff; border-radius: 16px 16px 0 0 !important; padding: 30px; text-align: center; }
  .btn-login { background: linear-gradient(135deg, #1e3c72, #2a5298); border: none; padding: 12px; font-size: 16px; }
  .btn-login:hover { opacity: 0.9; }
</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card card-login">
        <div class="card-header card-header-login">
          <i class="fas fa-shopping-cart fa-2x mb-2"></i>
          <h4 class="mb-0 font-weight-bold">PT Maju Jaya</h4>
          <small>Sistem Sales Order</small>
        </div>
        <div class="card-body p-4">
          <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle mr-1"></i>
            <?= $this->session->flashdata('error') ?>
          </div>
          <?php endif; ?>
          <form action="<?= base_url('auth/proses_login') ?>" method="POST">
            <div class="form-group">
              <label><i class="fas fa-user mr-1"></i> Username</label>
              <input type="text" name="username" class="form-control form-control-lg" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="form-group">
              <label><i class="fas fa-lock mr-1"></i> Password</label>
              <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-login btn-primary btn-block btn-lg mt-3">
              <i class="fas fa-sign-in-alt mr-1"></i> Masuk
            </button>
          </form>
          <hr>
          <small class="text-muted">
            <strong>Demo Login:</strong><br>
            Admin: admin / password<br>
            Sales: budi / password<br>
            Manager: manager / password<br>
            <strong>Notes : Please Import The Database First!!!</strong>
          </small>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
