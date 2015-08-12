<?php
require_once '../bootstrap.php';

$stmt = $dbc->prepare("SELECT * FROM ads WHERE user_id = :user_id ORDER BY date_created DESC");
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO:: PARAM_INT);
$stmt->execute();

$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
 ?>
<html>
<head>
	    <title>Pablo's List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
    <style type="text/css">
.show-image {
	height:	433px;
	width:292px;
	padding-top: 20px;
	padding-left: 20px;
	padding-right: 20px;
	padding-bottom: 20px;
}
img.show-item {
	height:322px;
	width:262.484px;
}
    </style>
</head>
<body>
	<section class="container-fluid">
        <?php include_once '../views/partials/navbar.php';?>
    </section>
<div class="container">
	</div>
	<div class="col-md-12 center">
		<h1>Your Listings</h1>
		<div class="row shop-catalogue grid-view left">
    	<?php foreach($ads as $ad) : ?>
        	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product product-grid">
				<div class="product-item show-image">
					<div class="product-img hover-1">
    				  <a href="#">							
    				    <img src="<?= $ad['img_url']; ?>" alt="" class="show-item">
    				  </a>
					  <div class="hover-overlay"></div>
						<div class="product-add-to-cart">
						  <a href="ads.show.php?ad_id=<?= $ad['ad_id'] ?>" class="btn btn-dark btn-md">Edit this listing</a>
						</div>
						  <div class="product-add-to-wishlist">
							<a href="#"><i class="fa fa-heart"></i></a>
						  </div>
					</div>
					<div class="product-details">
						<h3>
							<a class="product-title" href="single-product.html"><?= $ad['title'];?></a>
						</h3>
					</div>
						<span class="price">
					<ins>
						<span class="ammount"><?= $ad['price']; ?></span>
					</ins>
						</span>
							<p class="product-description"><?= $ad['tags']; ?></p>
							<a href="#" class="btn btn-dark btn-md left">Add to Cart</a>
						<div class="icon-add-to-wishlist">
							<a href="#"><i class="fa fa-heart"></i></a>
						</div>
				</div>
			</div>
			<?php endforeach ?>

		</div>
	</div>
</div>
<div class="move">
 <?php include_once '../views/partials/footer.php';?>
</div>
</body>
</html>
