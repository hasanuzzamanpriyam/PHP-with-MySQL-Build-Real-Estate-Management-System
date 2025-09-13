<?php require '../includes/header.php'; ?>

<?php
if (!isset($_SESSION['username'])) {
  header("Location: " . APPURL . "");
  exit();
}

$favs = $pdo->query("SELECT 
properties.id AS id, 
properties.name AS name, 
properties.locations, 
properties.image, 
properties.price AS price, 
properties.beds AS beds, 
properties.baths AS baths,
properties.types AS types,
properties.sq_ft AS sq_ft FROM properties JOIN requests ON properties.id = requests.prop_id 
WHERE requests.user_id = " . $_SESSION['user_id']);
$favs->execute();

$props = $favs->fetchAll(PDO::FETCH_OBJ);

?>


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
                <h1 class="mb-2">Requests</h1>
            </div>
        </div>
    </div>
</div>


<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row mb-5">
            <?php if (count($props)) : ?>
                <?php foreach ($props as $prop) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="property-entry h-100">
                            <a href="<?php echo APPURL; ?>/property-details.php?id=<?php echo $prop->id; ?>" class="property-thumbnail">
                                <div class="offer-type-wrap">
                                    <span class="offer-type bg-<?php if ($prop->types == 'Sale') {
                                                                    echo 'danger';
                                                                } else if ($prop->types == 'Rent') {
                                                                    echo 'success';
                                                                } else if ($prop->types == 'Lease') {
                                                                    echo 'info';
                                                                } ?>"><?php echo $prop->types; ?></span>
                                </div>
                                <img src="<?php echo APPURL; ?>/images/<?php echo $prop->image ?>" alt="<?php echo $prop->name; ?>" class="img-fluid">
                            </a>
                            <div class="p-4 property-body">
                                <h2 class="property-title"><a href="<?php echo APPURL; ?>/property-details.php?id=<?php echo $prop->id; ?>"><?php echo $prop->name; ?></a></h2>
                                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $prop->locations; ?></span>
                                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo number_format($prop->price); ?></strong>
                                <ul class="property-specs-wrap mb-3 mb-lg-0">
                                    <li>
                                        <span class="property-specs">Beds</span>
                                        <span class="property-specs-number"><?php echo $prop->beds; ?></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">Baths</span>
                                        <span class="property-specs-number"><?php echo $prop->baths; ?></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">SQ FT</span>
                                        <span class="property-specs-number"><?php echo $prop->sq_ft; ?></span>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2 class="text-center bg-light">No Requests Added</h2>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php require '../includes/footer.php'; ?>