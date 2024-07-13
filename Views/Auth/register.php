<?php
$title = 'Register';
require_once 'Views/Layouts/auth.php';
?>

<div class="container mt-5">
  <h1>Register</h1>
  <form action="<?php echo url('/register'); ?>" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>
