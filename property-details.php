<?php include 'includes/header.php'; ?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $single = $pdo->query("SELECT * FROM properties WHERE id='$id'");
  $single->execute();

  $propertyDetails = $single->fetch(PDO::FETCH_OBJ);


  $related_props = $pdo->query("SELECT * FROM properties WHERE id !='$id' ORDER BY RAND() LIMIT 3");
  $related_props->execute();

  $allRelated_Props = $related_props->fetchAll(PDO::FETCH_OBJ);


if (isset($_SESSION['user_id'])) {
  $checkFav = $pdo->prepare("SELECT * FROM favs WHERE prop_id = :prop_id AND user_id = :user_id");
  $checkFav->execute([':prop_id' => $id, ':user_id' => $_SESSION['user_id']]);
}


}

if (isset($_SESSION['user_id'])) {
  $check_request = $pdo->prepare("SELECT * FROM requests WHERE prop_id = :prop_id AND user_id = :user_id");
  $check_request->execute([':prop_id' => $id, ':user_id' => $_SESSION['user_id']]);
}

// Fetch related images
$image = $pdo->query("SELECT * FROM related_images WHERE props_id='$id'");
$image->execute();

$propertyImages = $image->fetchAll(PDO::FETCH_OBJ);
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

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $propertyDetails->image; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
        <h1 class="mb-2"><?php echo $propertyDetails->name ?></h1>
        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo number_format($propertyDetails->price) ?></strong></p>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div>
          <div class="slide-one-item home-slider owl-carousel">
            <?php foreach ($propertyImages as $propertyImage) : ?>
              <div><img src="images/<?php echo $propertyImage->image; ?>" alt="Image" class="img-fluid"></div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="bg-white property-body border-bottom border-left border-right">
          <div class="row mb-5">
            <div class="col-md-6">
              <strong class="text-success h1 mb-3">$<?php echo number_format($propertyDetails->price) ?></strong>
            </div>
            <div class="col-md-6">
              <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $propertyDetails->beds; ?></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $propertyDetails->baths; ?></span>

                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"><?php echo $propertyDetails->sq_ft; ?></span>

                </li>
              </ul>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
              <strong class="d-block"><?php echo str_replace('-', ' ', $propertyDetails->home_type); ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
              <strong class="d-block"><?php echo $propertyDetails->year_built; ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
              <strong class="d-block">$<?php echo $propertyDetails->price_sqft; ?></strong>
            </div>
          </div>
          <h2 class="h4 text-black">More Info</h2>
          <p><?php echo $propertyDetails->description; ?></p>
          <!-- image carousel -->
          <div class="row no-gutters mt-5">
            <div class="col-12">
              <h2 class="h4 text-black mb-3">Gallery</h2>
            </div>
            <?php foreach ($propertyImages as $propertyImage) : ?>
              <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="<?php echo APPURL; ?>/images/<?php echo $propertyImage->image; ?>" class="image-popup gal-item"><img src="images/<?php echo $propertyImage->image; ?>" alt="Image" class="img-fluid"></a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">

        <div class="bg-white widget border rounded">

          <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
          <?php if (isset($_SESSION['user_id'])) : ?>
            <?php if ($check_request->rowCount() > 0) : ?>
              <p class="text-success">You have already sent a request for this property. The agent will get back to you soon.</p>
            <?php else : ?>
            <form action="<?php echo APPURL; ?>/requests/process-request.php" method="POST" class="form-contact-agent">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
              </div>
              <div class="form-group">
                <input type="hidden" name="prop_id" value="<?php echo $id; ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="admin_name" value="<?php echo $propertyDetails->admin_name; ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="prop_id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" class="btn btn-primary" value="Send Message Request">
              </div>
            </form>
            <?php endif; ?>
          <?php else : ?>
            <p>Please <a href="<?php echo APPURL; ?>/auth/login.php">login</a> to contact the agent.</p>
          <?php endif; ?>
        </div>

        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
          <div class="px-3" style="margin-left: -15px;">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo APPURL; ?>/property-details.php?id=<?php echo $propertyDetails->id; ?>&quote=<?php echo $propertyDetails->name; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $propertyDetails->name; ?>&url=<?php echo APPURL; ?>/property-details.php?id=<?php echo $propertyDetails->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo APPURL; ?>/property-details.php?id=<?php echo $propertyDetails->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
          </div>
        </div>
        <!-- Favourite and Unfavorite -->
        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3">Add to Favourites</h3>
          <?php if (isset($_SESSION['user_id'])): ?>
            <form action="favs/add-fav.php" method="Post" class="form-contact-agent">
              <div class="form-group">
                <input type="hidden" name="prop_id" value="<?php echo $id; ?>" class="form-control">
              </div>

              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control">
              </div>
              <?php if ($checkFav->rowCount() > 0) : ?>
                <div class="form-group">
                  <a href="favs/delete-fav.php?prop_id=<?php echo $id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary">Unfavourite Me</a>
                </div>
              <?php else : ?>
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" value="Favourite Me">
                </div>
              <?php endif; ?>
            </form>
          <?php else: ?>
            <p>Please <a href="<?php echo APPURL; ?>/auth/login.php">login</a> to add to favourites.</p>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row">
      <div class="col-12">
        <div class="site-section-title mb-5">
          <h2>Related Properties</h2>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <?php foreach ($allRelated_Props as $relatedProp) : ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="property-entry h-100">
            <a href="property-details.php?id=<?php echo $relatedProp->id; ?>" class="property-thumbnail">
              <div class="offer-type-wrap">
                <span class="offer-type bg-<?php if ($relatedProp->types == 'Sale') {
                                              echo 'danger';
                                            } else if ($relatedProp->types == 'Rent') {
                                              echo 'success';
                                            } else if ($relatedProp->types == 'Lease') {
                                              echo 'info';
                                            } ?>"><?php echo $relatedProp->types; ?></span>
              </div>
              <img src="images/<?php echo $relatedProp->image; ?>" alt="Image" class="img-fluid">
            </a>
            <div class="p-4 property-body">
              <h2 class="property-title"><a href="property-details.php?id=<?php echo $relatedProp->id; ?>"><?php echo $relatedProp->name; ?></a></h2>
              <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $relatedProp->locations; ?></span>
              <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo number_format($relatedProp->price); ?></strong>
              <ul class="property-specs-wrap mb-3 mb-lg-0">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $relatedProp->beds; ?> <sup>+</sup></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $relatedProp->baths; ?></span>
                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"><?php echo $relatedProp->sq_ft; ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php include 'includes/footer.php'; ?>