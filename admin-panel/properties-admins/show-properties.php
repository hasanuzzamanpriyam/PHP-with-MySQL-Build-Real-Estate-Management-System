<?php include '../../config/config.php' ; ?>
<?php include '../layouts/header.php' ; ?>
 <?php
if (!isset($_SESSION['adminname'])) {
  header('location:'.ADMINURL.'/admins/login-admins.php');
}

$Properties = $pdo->query("SELECT * FROM properties");
$propertiesResult = $Properties->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Properties</h5>
        <a href="create-properties.php" class="btn btn-primary mb-4 text-center float-right">Create Properties</a>

        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">price</th>
              <th scope="col">home type</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($propertiesResult as $index => $property): ?>
              <tr>
                <th scope="row"><?php echo $index + 1; ?></th>
                <td><?php echo $property->name; ?></td>
                <td><?php echo $property->price; ?></td>
                <td><?php echo $property->home_type; ?></td>
                <td><a href="delete-properties.php?id=<?php echo $property->id; ?>" class="btn btn-danger text-center">delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php include '../layouts/footer.php'; ?>