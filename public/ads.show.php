<?php
require_once '../bootstrap.php';
$stmt = $dbc->prepare("SELECT * FROM ads WHERE ad_id = :ad_id");
$stmt->bindValue(':ad_id', Input::get('ad_id'), PDO:: PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($results);



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pablo's List</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="css/pasta.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/spacings.css">
    <link rel="stylesheet" href="css/color.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>

    </div>
</div>
    <section class="container-fluid">
        <?php include_once '../views/partials/navbar.php';?>
    </section>
    <section>
        <section class="section-wrap single-product pt-70">
  <div class="container relative">
    <div class="row">

       <div class="col-md-6">
      <img src="http://deothemes.com/envato/amadea/html/img/product_large_1.jpg" alt="" draggable="false">
      </div>
      <!-- end col -->

      <div class="col-md-6 product-description-wrap">
        <h1 class="product-title">ladies bag</h1>

          <span class="price">

        <ins>
          <span class="ammount">$299.99</span>
        </ins>
          </span>

        <p class="product-description">Amadea Shop is a very slick and clean e-commerce template with endless possibilities. Creating an awesome clothes store with this Theme is easy than you can imagine. Grab this theme now.</p>
        <!--<div class="size-options clearfix mb-40">
          <h6>Size:</h6>
          <a href="#" class="size-xs selected">XS</a>
          <a href="#" class="size-s">S</a>
          <a href="#" class="size-m">M</a>
          <a href="#" class="size-l">L</a>
          <a href="#" class="size-xl">XL</a>
        </div>-->

        <a href="#" class="btn btn-dark btn-md add-to-cart left">Add to Cart</a>
        <div class="quantity buttons_added">
          <input type="button" value="-" class="minus">
          <input type="number" step="1" min="0" value="1" title="Qty" class="input-text qty text">
          <input type="button" value="+" class="plus">
        </div>
        <div class="icon-add-to-wishlist">
          <a href="#"><i class="fa fa-heart"></i></a>
        </div>

        <div class="product_meta">
           Category: <a href="#">Accessories</a></span>
          <span class="tagged_as">Tags: <a href="#">Elegant</a>, <a href="#">Bag</a></span>
        </div>

        <div class="socials-share clearfix">
          <span>Share:</span>
          <div class="social-icons light">
            <a href="#" class="facebook">
              <i class="fa fa-facebook"></i>
              <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="twitter">
              <i class="fa fa-twitter"></i>
              <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="google-plus">
              <i class="fa fa-google-plus"></i>
              <i class="fa fa-google-plus"></i>
            </a>
            <a href="#" class="linkedin">
              <i class="fa fa-linkedin"></i>
              <i class="fa fa-linkedin"></i>
            </a>
            <a href="#" class="pinterest">
              <i class="fa fa-pinterest"></i>
              <i class="fa fa-pinterest"></i>
            </a>
            <a href="#" class="instagram">
              <i class="fa fa-instagram"></i>
              <i class="fa fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- end product description -->

      <div class="col-md-12 mt-70">
        <div class="tabs">
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#tab-one" data-toggle="tab">Description</a>
            </li>
            <li>
              <a href="#tab-two" data-toggle="tab">Information</a>
            </li>
          </ul>
          <!-- end tabs -->

          <!-- tab content -->
          <div class="tab-content pb-0">

            <div class="tab-pane fade in active" id="tab-one">
              <p>
                We possess within us two minds. So far I have written only of the conscious mind. I would now like to introduce you to your second mind, the hidden and mysterious subconscious. Our subconscious mind contains such power and complexity that it literally
                staggers the imagination.And finally the subconscious is the mechanism through which thought impulses which are repeated regularly with feeling and emotion are quickened, charged. Our subconscious mind contains such power and complexity
                that it literally staggers the imagination.And finally the subconscious is the mechanism through which thought impulses.
              </p>
            </div>

            <div class="tab-pane fade" id="tab-two">
              <table>
                <thead>
                  <tr>
                    <th>CPU</th>
                    <td>2.7GHz quad-core Intel Core i5 Turbo Boost up to 3.2GHz</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>RAM</th>
                    <td>8GB (two 4GB) memory</td>
                  </tr>
                  <tr>
                    <th>Video</th>
                    <td>Intel Iris Pro Graphics</td>
                  </tr>
                </tbody>
              </table>
            </div>
          <!-- end tab content -->

        </div>
      </div>
      <!-- end tabs -->

    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>


        <!-- FOOTER GOES BELOW -->
        <?php include_once '../views/partials/footer.php';?>
    </body>
</html>
