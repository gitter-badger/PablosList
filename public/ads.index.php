<?php
 require_once '../bootstrap.php';

	$adCount = $dbc->query('SELECT count(*) FROM ads')->fetchColumn();
	$limit = 6;
	$id = Input::has('id');
	$pageCount = ceil($adCount/$limit);

	if(Input::has('page')) {
		$offset = ($_GET['page'] - 1) * $limit;
		$page = $_GET['page'];
	} else {
		$offset = 0;
		$page = 1;
	}

	$stmt = $dbc->prepare("SELECT * FROM ads ORDER BY date_created DESC LIMIT :limit OFFSET :offset");
	$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO:: PARAM_INT);
	$stmt->execute();

	$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

	print_r($stmt->fetch(PDO::FETCH_ASSOC));
	?>
<html>

<head>
	<link href="https://assets-fs.wnlimg.com/assets/wnl_base-c57882fd3889e68c0a09667f2e18fcd4.css" media="all" rel="stylesheet" type="text/css">
	<link href="https://assets-fs.wnlimg.com/assets/wnl_web-d1f8f19b7b885693d86ad23ecdb98cdc.css" media="all" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="https://bootswatch.com/lumen/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/pasta.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lightbox.min.css">
	<link rel="stylesheet" href="css/elegant-icons.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="rs-plugin/css/settings.css">
	<link rel="stylesheet" href="css/rev-slider.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/spacings.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/animate.css">
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
 <?php include_once '../views/partials/navbar.php';?>
<div class="container-relative">
	<div class="col-md-9 right">
		<div class="row shop-catalogue grid-view left">
    	<?php foreach($ads as $ad) : ?>
        	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product product-grid">
				<div class="product-item show-image">
					<div class="product-img hover-1">
    				  <a href="#">							
    				    <img src="<?= $ad['img_url']; ?>" alt="" class="show-item" height="433" width="292.484">
    				  </a>
					  <div class="hover-overlay"></div>
						<div class="product-add-to-cart">
						  <a href="ads.show.php?ad_id=<?= $ad['ad_id'] ?>" class="btn btn-dark btn-md">Show Listing Page</a>
						</div>
						  <div class="product-add-to-wishlist">
							<a href="#"><i class="fa fa-heart"></i></a>
						  </div>
					</div>
					<div class="product-details">
						<h3>
							<a class="product-title" href="single-product.html"><?= $ad['title'];?></a>
						</h3>
						<h5 class="category">
							<a href="catalogue-grid.html">Men</a>
						</h5>
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

	<?php if($page > 1) { ?>
		<a type="button" class="btn btn-primary" href="ads.index.php?page=<?= ($page - 1) ?>">Previous page</a>
	<?php } ?>
	
	<?php if ($page < $pageCount) { ?>
	 <a type="button" class="btn btn-primary" href="ads.index.php?page=<?= ($page + 1) ?>">Next Page</a>
	 <?php } ?>
		</div>
	</div>
</div>


			            		
 <?php include_once '../views/partials/footer.php';?>
</body>
</html>
