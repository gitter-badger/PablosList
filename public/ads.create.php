<?php
require_once '../bootstrap.php';

if(!isset($_SESSION['LOGGED_IN_USER'])){
    header("Location: index.php");
    exit();
}
// var_dump($_FILES);

if($_FILES) {
    $uploads_directory = 'img/uploads/';
    $filename = $uploads_directory . basename($_FILES['somefile']['tmp_name']);
    if($_FILES['somefile']['type'] = 'image/jpeg' || $_FILES['somefile']['type'] = 'image/png') {
        if(!$_FILES['somefile']['error']) {
            if($_FILES['somefile']['size'] > (1024000)) {
                $valid_file = false;
                $errorMessage = 'Oops!  Your file\'s size is to large.';
            } else {
                $valid_file = true;
            }
            if($valid_file) {
                if (move_uploaded_file($_FILES['somefile']['tmp_name'], $filename)) {
                    $showUploadedFile = true;
                } else {
                    $showUploadedFile = false;
                }
            }
        } else {
            //set that to be the returned message
            $errorMessage = 'Ooops!  Your upload triggered the following error:  '.$_FILES['somefile']['error'];
        }
    }
} else {
    $showUploadedFile = false;
}


if (Input::has('title') && Input::has('price') && Input::has('tags') && Input::has('description') && Input::has('img_url')) {

    $user_id = (int)$_SESSION['user_id'];
	$new_ad = new Ad();
	$new_ad->tags         = Input::get('tags');
	$new_ad->title        = Input::get('title');
	$new_ad->price        = Input::getNumber('price');
	$new_ad->img_url      = Input::get('img_url');
	$new_ad->description  = Input::get('description');
	$new_ad->date_created = date('Y-m-d');
	$new_ad->user_id      = $user_id;
	$new_ad->insert();


     //passing user_id to find ad_id of latest entry for FK on tags
	// $ad_id = Ad::lastEntry($user_id);
    $query = "SELECT ad_id FROM ads WHERE user_id = $user_id ORDER BY ad_id DESC LIMIT 1;";
    $results = $dbc->query($query)->fetch(PDO::FETCH_ASSOC);
    $ad_id = (int)$results['ad_id'];

	$tags  = explode(',', Input::get('tags'));

	foreach($tags as $tag)
	{
		$tag 	 = strtolower(trim($tag));
        $stmt = $dbc->prepare('INSERT INTO tags (tag_name, ad_id)
                               VALUES (:tag_name, :ad_id)');

        $stmt->bindValue(':tag_name', $tag, PDO::PARAM_STR);
        $stmt->bindValue(':ad_id', $ad_id, PDO::PARAM_INT);

        $stmt->execute();
		// $new_tag = new Tag();
		// $new_tag->tag_name = $tag;
		// $new_tag->ad_id    = $ad_id;
		// $new_tag->insert();
	}

	// var_dump($ad_id);

	header("Location: ads.show.php?ad_id=$ad_id");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pablo's List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="css/header.css" rel="stylesheet" type="text/css">
    <link href="css/pasta.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </head>
    <body>
        <section class="container-fluid">
		<?php require_once '../views/partials/navbar.php'; ?>


        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <fieldset>

        <!-- Form Name -->
        <legend>Create New Listing</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="title">Title</label>
          <div class="col-md-8">
          <input id="title" name="title" type="text" placeholder="" value="<?= Input::get('title') ?>" class="form-control input-md" required="">
          <span class="help-block">Limit 100 Characters.</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="price">Price</label>
          <div class="col-md-4">
          <input id="price" name="price" type="text" placeholder="$9000.01" value="<?= Input::get('price') ?>" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description">Description</label>
          <div class="col-md-4">
            <textarea class="form-control" id="description" name="description" ><?= Input::get('description') ?></textarea>
          </div>
        </div>

        <!-- Image -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="file">Add Image</label>
          <div class="col-md-4">
            <input id="file" name="somefile" class="input-file" type="file">
            <?php if (isset($errorMessage)) { ?>
            <p class ="bg-warning"><?= $errorMessage ?></p>
            <?php } ?>
          </div>
        </div>
        <?php if ($showUploadedFile) { ?>
            <div class="row">
              <div class="col-md-offset-4 col-md-4">
                  <img src="<?= $filename ?>" alt="" height="100" width="100">
              </div>
            </div>
            <hr>
        <?php } ?>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tags">Tags</label>
          <div class="col-md-6">
          <input id="tags" name="tags" type="text" placeholder="Winning, Mountain Dew, Rubber Ducky" value="<?= Input::get('tags') ?>" class="form-control input-md" required="">
          <span class="help-block">Separate tags with commas</span>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="submit_ad"></label>
          <div class="col-md-4">
            <?php if ($showUploadedFile) { ?>
            <input type="hidden" value="<?= $filename ?>" name="img_url">
            <?php } ?>
            <input type="hidden" name="create_ad">
            <button id="submit_ad" name="submit_ad" class="btn btn-primary">Submit</button>
          </div>
        </div>

        </fieldset>
        </form>

</section>






		<? require_once '../views/partials/footer.php' ?>


</body>
</html>
