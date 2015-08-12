<?php
require_once '../bootstrap.php';
session_start();
var_dump($_FILES);

if($_FILES) {
    $uploads_directory = 'img/uploads/';
    $filename = $uploads_directory . basename($_FILES['somefile']['name']);
    if ( $_FILES['type'] = 'image/jpeg' || $_FILES['type'] = 'image/png') {
        if (move_uploaded_file($_FILES['somefile']['tmp_name'], $filename)) {
            $message = '<p>The file '. basename( $_FILES['somefile']['name']). ' has been uploaded.</p>';
            $showUploadedFile = true;
        } else {
            $message = "Sorry, there was an error uploading your file.";
            $showUploadedFile = false;
        }
    }
} else {
    $showUploadedFile = false;
    $message = 'Listings with an image are 66% more likely to end in positive end user experiences and swag might be danked gg rekt meme.';
}




if(Input::has('create_ad') && $showUploadedFile){
	$new_ad = new Ad();
	$new_ad->tags         = Input::get('tags');
	$new_ad->title        = Input::get('title');
	$new_ad->price        = (float)Input::get('price');
	$new_ad->img_url      = $filename;
	$new_ad->description  = Input::get('description');
	$new_ad->date_created = date('Y-m-d');
	$new_ad->user_id      = (int)$_SESSION['user_id'];
	$new_ad->save();

	$user_id = (int)$_SESSION['user_id'];

	$ad_id = Ad::lastEntry($user_id); //passing user_id stored in session to find latest entry (just saved() above)

	$tags  = explode(',', Input::get('tags'));

	foreach($tags as $tag)
	{
		$tag 	 = trim($tag);
		$new_tag = new Tag();
		$new_tag->tag_name = $tag;
		$new_tag->ad_id    = $ad_id;
		$new_tag->save();
	}

	// var_dump($ad_id);

	header("Location: ads.show.php?show=$ad_id");
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
        <form class="form-horizontal" method="POST" action="">
        <fieldset>

        <!-- Form Name -->
        <legend>Create New Listing</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="title">Title</label>
          <div class="col-md-8">
          <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required="">
          <span class="help-block">Limit 100 Characters.</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="price">Price</label>
          <div class="col-md-4">
          <input id="price" name="price" type="text" placeholder="$9000.01" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description">Description</label>
          <div class="col-md-4">
            <textarea class="form-control" id="description" name="description">(╯'□')╯︵ ┻━┻</textarea>
          </div>
        </div>



        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tags">Tags</label>
          <div class="col-md-6">
          <input id="tags" name="tags" type="text" placeholder="Winning, Mtn Dew, Girls on tables" class="form-control input-md" required="">
          <span class="help-block">Separate tags with commas</span>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="submit_ad"></label>
          <div class="col-md-4">
            <input type="hidden" name="create_ad">
            <button id="submit_ad" name="submit_ad" class="btn btn-primary">Submit</button>
          </div>
        </div>

        </fieldset>
        </form>

        <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
          <label class="col-md-4 control-label" for="file">Add Image</label>
          <div class="col-md-4">
            <input id="file" name="somefile" class="input-file" type="file">
            <button class="btn-xs btn-inverse">Add Image to Listing</button>
          </div>
        </div>
        </form>

        <?php if ($showUploadedFile) { ?>
            <div class="row">
              <div class="col-md-offset-3 col-md-4">
                  <img src="<?= $filename ?>" alt="" height="100" width="100">
              </div>
            </div>

        <?php } ?>






		<? require_once '../views/partials/footer.php' ?>


</body>
</html>
