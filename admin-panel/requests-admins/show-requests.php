<?php include '../layouts/header.php'; ?>
<?php include '../../config/config.php'; ?>
<?php
if (!isset($_SESSION['adminname'])) {
  header('location:'.ADMINURL.'/admins/login-admins.php');
}

$requests = $pdo->query("SELECT * FROM requests WHERE author='{$_SESSION['adminname']}'");
$requestsResult = $requests->fetchAll(PDO::FETCH_OBJ);

?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Requests</h5>

        <table class="table mt-3">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">email</th>
              <th scope="col">phone</th>
              <th scope="col">go to this property</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($requestsResult)) : ?>
              <tr>
                <td colspan="5" class="text-center">No Requests Found</td>
              </tr>
            <?php endif; ?>
            <?php foreach ($requestsResult as $index => $request) : ?>
              <tr>
                <th scope="row"><?php echo $index + 1; ?></th>
                <td><?php echo $request->name; ?></td>
                <td><?php echo $request->email; ?></td>
                <td><?php echo $request->phone; ?></td>
                <td><a target="_blank" href="http://localhost/homeland/property-details.php?id=<?php echo $request->prop_id; ?>" class="btn btn-success  text-center ">go</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include('../layouts/footer.php'); ?>