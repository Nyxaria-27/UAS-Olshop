<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $user_id = $_SESSION['user_id'];

  $data = [
    'product_id' => $product_id,
    'user_id' => $user_id,
    'quantity' => $quantity
  ];

  if (addToCart($data)) {
    echo "
    <script>
        if (confirm('Product berhasil ditambahkan ke cart.\nProceed to cart?')) {
          window.location.href = 'cart.php';
        } else {
          window.location.href = 'cart.php';
        }
    </script>
    ";
  } else {
    echo "
    <script>
        alert('Product sudah ada di cart');
        window.location.href = '/';
    </script>
    ";
  }
}
?>
<h1 class="mb-4 text-center">Produk Tersedia</h1>
<div class="row g-4">
  <?php if ($products): ?>
    <?php foreach ($products as $row): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="position-relative">
            <img src="assets/<?= $row['image'] ?>" class="card-img-top img-fluid" alt="<?= $row['name'] ?>" onerror="this.src='https://via.placeholder.com/150'">
            <?php if ($row['stock'] <= 0): ?>
              <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 fw-bold">Out of Stock</div>
            <?php endif; ?>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-dark"><?= $row['name'] ?></h5>
            <p class="card-text text-muted"><?= excerpt($row['description']) ?></p>
            <p class="card-text"><strong>Rp. <?= number_format($row['price']) ?></strong></p>
            <?php if ($row['stock'] > 0): ?>
              <form action="" method="post" class="mt-auto">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <label for="quantity" class="form-label">Qty:</label>
                  <input type="number" name="quantity" class="form-control w-50" id="quantity" value="1" min="1" max="<?= $row['stock'] ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100">Buy Now</button>
              </form>
            <?php else: ?>
              <p class="text-danger mt-auto">Produk tidak tersedia.</p>
            <?php endif; ?>
            <?php if (isAdmin()): ?>
              <div class="mt-3 d-flex gap-2">
                <a class="btn btn-success w-50" href="/product/edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="btn btn-danger w-50" href="/product/remove.php?id=<?= $row['id'] ?>">Remove</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center">
      <p class="text-muted">Belum ada produk yang tersedia.</p>
      <a href="/" class="btn btn-secondary">Kembali ke Halaman Utama</a>
    </div>
  <?php endif; ?>
</div>