<?php
ob_start();
include 'header.php';
?>

<!-- Hero Section -->
<div class=" container-fluid py-5 bg-dark text-white text-center position-relative">
  <div class="overlay card-body position-absolute w-100 h-100" style="background: rgba(0,0,0,0.6); top: 0; left: 0;"></div>
  <div class="container position-relative">
    <h1 class="display-4">Welcome to BoShop</h1>
    <p class="lead">Ayo Temukan Barang Kesukaan mu Sekarang !!</p>
    <a href="#products" class="btn btn-primary btn-lg">Beli Sekarang</a>
  </div>
</div>

<!-- Main content area -->
<div class="container my-5" id="products">
  <?php include './template/_products.php'; ?>
</div>

<?php
include 'footer.php';
?>