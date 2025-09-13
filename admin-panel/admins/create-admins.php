<?php include '../../config/config.php'; ?>
<?php include '../layouts/header.php'; ?>

<?php
 // Check if admin is logged in
if (!isset($_SESSION['adminname'])) {
  header("Location: " . ADMINURL . "/admins/login-admins.php");
}


if (isset($_POST['submit'])) {
  $adminname = $_POST['adminname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($adminname) && !empty($email) && !empty($password)) {

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password

    // Registration logic save to database
    $insertQuery = $pdo->prepare("INSERT INTO admins (admin_name, email, mypassword) 
      VALUES (:admin_name, :email, :mypassword)");

    $insertQuery->execute([
      ':admin_name' => $adminname,
      ':email' => $email,
      ':mypassword' => $hashedPassword
    ]);

    header("Location: " . ADMINURL . "/admins/admins.php");
    // exit();
  } else {
    echo '<script>alert("Please fill in all fields.");</script>';
  }
}
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php include('../layouts/footer.php'); ?>