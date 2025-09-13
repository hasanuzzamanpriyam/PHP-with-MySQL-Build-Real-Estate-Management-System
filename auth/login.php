<?php include '../includes/header.php'; ?>

<?php
if (isset($_SESSION['username'])) {
  header("Location: " . APPURL . "");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($email) && !empty($password)) {
    $loginQuery = $pdo->query("SELECT * FROM users WHERE email = '$email'");
    $loginQuery->execute();

    $fetch = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($loginQuery->rowCount() > 0) {
      // echo $loginQuery->rowCount();
      // echo "email is valid";

      if (password_verify($password, $fetch['mypassword'])) {
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['user_id'] = $fetch['id'];
        header("Location: " . APPURL . "");
      } else {
        echo "Invalid password.";
      }
    } else {
      echo "Invalid email.";
    }
  } else {
    echo '<script>alert("Please fill in all fields.");</script>';
  }
}
?>


<div class="site-loader"></div>

<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->
</div>

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Log In</h1>
      </div>
    </div>
  </div>
</div>


<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
        <h3 class="h4 text-black widget-title mb-3">Login</h3>
        <form action="login.php" method="POST" class="form-contact-agent">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>

    </div>
  </div>
  <?php include '../includes/footer.php'; ?>