<?php
var_dump($_FILES);
if($_FILES) {
    $uploads_directory = 'img/uploads/';
    $filename = $uploads_directory . basename($_FILES['somefile']['tmp_name']);
    if($_FILES['somefile']['type'] = 'text/csv') {
        if(!$_FILES['somefile']['error']) {
            if($_FILES['somefile']['size'] > (1024000)) {
                $valid_file = false;
                $errorMessage = 'Oops! Your file\'s size is to large.';
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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Form upload</title>
</head>
<body>

<form method="POST" action="upload.php" enctype="multipart/form-data">

    <input type="file" name="somefile">

    <button>Submit this</button>

</form>

</body>
</html>
