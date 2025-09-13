<?php include 'includes/header.php'; ?>

<?php
$select = $pdo->query("SELECT * FROM properties");
$select->execute();
$props = $select->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['search'])) {

    $types = $_POST['types'];
    $offers = $_POST['offers'];
    $cities = $_POST['cities'];

    $search = $pdo->query("SELECT * FROM properties WHERE home_type LIKE '%$types%' OR types LIKE '%$offers%' OR locations LIKE '%$cities%'");
    $search->execute();
    $listings = $search->fetchAll(PDO::FETCH_OBJ);
} else {
    header("Location: " . APPURL . "");
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

<div class="slide-one-item home-slider owl-carousel">
    <?php foreach ($props as $prop) : ?>
        <div class="site-blocks-cover overlay" style="background-image: url(images/<?php echo $prop->image ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <span class="d-inline-block bg-<?php if ($prop->types == 'Sale') {
                                                            echo 'success';
                                                        } else if ($prop->types == 'Rent') {
                                                            echo 'danger';
                                                        } else if ($prop->types == 'Lease') {
                                                            echo 'info';
                                                        } ?> text-white px-3 mb-3 property-offer-type rounded">For <?php echo $prop->types ?></span>
                        <h1 class="mb-2"><?php echo $prop->name ?></h1>
                        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo number_format($prop->price) ?></strong></p>
                        <p><a href="property-details.php?id=<?php echo $prop->id ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="site-section site-section-sm pb-0">
    <div class="container">
        <!-- Search Form -->
        <div class="row">
            <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
                <div class="row  align-items-end">
                    <div class="col-md-3">
                        <label for="list-types">Listing Types</label>
                        <div class="select-wrap">
                            <span class="icon icon-arrow_drop_down"></span>
                            <select name="types" id="list-types" class="form-control d-block rounded-0">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->name; ?>"><?php echo str_replace('-', ' ', $category->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="offer-types">Offer Type</label>
                        <div class="select-wrap">
                            <span class="icon icon-arrow_drop_down"></span>
                            <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                                <option value="Sale">Sale</option>
                                <option value="Rent">Rent</option>
                                <option value="Lease">Lease</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="select-city">Select City</label>
                        <div class="select-wrap">
                            <span class="icon icon-arrow_drop_down"></span>
                            <select name="cities" id="select-city" class="form-control d-block rounded-0">
                                <option value="New York">New York</option>
                                <option value="Brooklyn">Brooklyn</option>
                                <option value="London">London</option>
                                <option value="Japan">Japan</option>
                                <option value="Philippines">Philippines</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="search" class="btn btn-success text-white btn-block rounded-0" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row mb-5">
            <?php if (count($listings) > 0) : ?>
                <?php foreach ($listings as $listing) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="property-entry h-100">
                            <a href="property-details.php?id=<?php echo $listing->id; ?>" class="property-thumbnail">
                                <div class="offer-type-wrap">
                                    <span class="offer-type bg-<?php if ($listing->types == 'Sale') {
                                                                    echo 'danger';
                                                                } else if ($listing->types == 'Rent') {
                                                                    echo 'success';
                                                                } else if ($listing->types == 'Lease') {
                                                                    echo 'info';
                                                                } ?>"><?php echo $listing->types; ?></span>
                                </div>
                                <img src="images/<?php echo $listing->image ?>" alt="<?php echo $listing->name; ?>" class="img-fluid">
                            </a>
                            <div class="p-4 property-body">
                                <h2 class="property-title"><a href="property-details.php?id=<?php echo $listing->id; ?>"><?php echo $listing->name; ?></a></h2>
                                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo $listing->locations; ?></span>
                                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo number_format($listing->price); ?></strong>
                                <ul class="property-specs-wrap mb-3 mb-lg-0">
                                    <li>
                                        <span class="property-specs">Beds</span>
                                        <span class="property-specs-number"><?php echo $listing->beds; ?></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">Baths</span>
                                        <span class="property-specs-number"><?php echo $listing->baths; ?></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">SQ FT</span>
                                        <span class="property-specs-number"><?php echo $listing->sq_ft; ?></span>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-md-12">
                    <p>No properties found matching your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- <div class="site-section site-section-sm bg-light">
    <div class="container">

        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">625 S. Berendo St</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 625 S. Berendo St Unit 607 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">7,000</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite active"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">871 Crenshaw Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 1 New York Ave, Warners Bay, NSW 2282</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">1,620</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-info">Lease</span>
                        </div>
                        <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">853 S Lucerne Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 853 S Lucerne Blvd Unit 101 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">5,500</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_4.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">625 S. Berendo St</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 625 S. Berendo St Unit 607 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">7,000</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_5.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">871 Crenshaw Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 1 New York Ave, Warners Bay, NSW 2282</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">1,620</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-info">Lease</span>
                        </div>
                        <img src="images/img_6.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">853 S Lucerne Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 853 S Lucerne Blvd Unit 101 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">5,500</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_7.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">625 S. Berendo St</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 625 S. Berendo St Unit 607 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">7,000</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-danger">Sale</span>
                            <span class="offer-type bg-success">Rent</span>
                        </div>
                        <img src="images/img_8.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">871 Crenshaw Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 1 New York Ave, Warners Bay, NSW 2282</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">1,620</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-entry h-100">
                    <a href="property-details.html" class="property-thumbnail">
                        <div class="offer-type-wrap">
                            <span class="offer-type bg-info">Lease</span>
                        </div>
                        <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                    </a>
                    <div class="p-4 property-body">
                        <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                        <h2 class="property-title"><a href="property-details.html">853 S Lucerne Blvd</a></h2>
                        <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 853 S Lucerne Blvd Unit 101 Los Angeles, CA 90005</span>
                        <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                        <ul class="property-specs-wrap mb-3 mb-lg-0">
                            <li>
                                <span class="property-specs">Beds</span>
                                <span class="property-specs-number">2 <sup>+</sup></span>

                            </li>
                            <li>
                                <span class="property-specs">Baths</span>
                                <span class="property-specs-number">2</span>

                            </li>
                            <li>
                                <span class="property-specs">SQ FT</span>
                                <span class="property-specs-number">5,500</span>

                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div> -->

<div class="site-section bg-light">
    <?php include 'includes/footer.php'; ?>