<?php
include './header.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
  echo "<script>alert('Please log in to view this.'); window.location.href = '/auth/login.php';</script>";
  exit;
}

$orders = getUserOrders($user_id);
?>

<div class="container mt-5">
  <h2 class="mb-4">Your Orders</h2>
  <?php if (empty($orders)): ?>
    <div class="alert alert-warning">You have no orders.</div>
  <?php else: ?>
    <div class="accordion" id="ordersAccordion">
      <?php foreach ($orders as $index => $order): ?>
        <div class="card mb-3">
          <div class="card-header" id="heading<?= $index ?>">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="true" aria-controls="collapse<?= $index ?>">
                Order ID: <?= $order['trans_id'] ?> - Total: <?= 'Rp. ' . number_format($order['total_price']) ?> - Created At: <?= $order['created_at'] ?>
              </button>
            </h2>
          </div>

          <div id="collapse<?= $index ?>" class="collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#ordersAccordion">
            <div class="card-body">
              <h5>Items</h5>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($order['items'] as $item_index => $item): ?>
                      <tr>
                        <td><?= $item_index + 1 ?></td>
                        <td>
                          <a href="<?= $item['product_id'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($item['product_name']) ?>
                          </a>
                        </td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= 'Rp. ' . number_format($item['item_price']) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include './footer.php'; ?>