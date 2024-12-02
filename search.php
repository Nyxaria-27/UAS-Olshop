<?php
include 'header.php';

$search = $_GET['search'] ?? '';
$products = $product->searchProduct($search);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Cari Produk di Sini</h2>
  <form action="" method="get" class="mb-4">
    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-search"></i>
      </span>
      <input type="text" name="search" class="form-control" placeholder="Search products"
        value="<?= htmlspecialchars($search) ?>">
      <button class="btn btn-secondary" type="submit">Search</button>
    </div>
  </form>

  <?php if (count($products) > 0): ?>
    <div class="row g-4">
      <?php foreach ($products as $product): ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="detail.php?id=<?= $product['id'] ?>" class="text-decoration-none">
            <div class="card shadow-sm">
              <img src="assets/<?= htmlspecialchars($product['image']) ?>" class="card-img-top"
                alt="<?= htmlspecialchars($product['name']) ?>" onerror="this.src='https://via.placeholder.com/150'">
              <div class="card-body">
                <h5 class="card-title text-truncate"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="card-text text-primary fw-bold">Rp. <?= number_format($product['price']) ?></p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">
      Tidak ada produk yang ditemukan untuk pencarian Anda.
    </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>