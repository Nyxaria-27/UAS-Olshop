<?php
include './header.php';

$user = getUser($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $update_data = [
    'id' => $user['id'],
    'username' => $_POST['username'] ?? '',
    'firstname' => $_POST['firstname'] ?? '',
    'lastname' => $_POST['lastname'] ?? '',
    'email' => $_POST['email'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'address' => $_POST['address'] ?? ''
  ];

  if (editUser($update_data)) {
    echo "<script>alert('User details updated successfully');</script>";
    $user = getUser($_SESSION['user_id']); // Reload user data
    echo "<script>window.location.href = '/user.php';</script>";
  } else {
    echo "<script>alert('Failed to update user details');</script>";
  }
}
?>

<div class="container mt-5">
  <h1 class="mb-4">Welcome, <?= htmlspecialchars($user['username'] ?? '') ?></h1>
  <p class="mb-4">Here are your details:</p>
  <form method="POST">
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Username</th>
          <td><input class="form-control" type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required></td>
        </tr>
        <tr>
          <th>First Name</th>
          <td><input class="form-control" type="text" name="firstname" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required></td>
        </tr>
        <tr>
          <th>Last Name</th>
          <td><input class="form-control" type="text" name="lastname" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><input class="form-control" type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required></td>
        </tr>
        <tr>
          <th>Phone</th>
          <td><input class="form-control" type="tel" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><textarea class="form-control" name="address"><?= htmlspecialchars($user['address'] ?? '') ?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit" class="btn btn-primary w-100">Update</button>
          </td>
        </tr>
      </table>
    </div>
  </form>
</div>

<?php include './footer.php'; ?>