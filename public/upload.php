<?php
var_dump($_FILES);
if($_FILES) {
    $uploads_directory = 'img/uploads/';
    $filename = $uploads_directory . basename($_FILES['somefile']['name']);
    if (move_uploaded_file($_FILES['somefile']['tmp_name'], $filename)) {
        echo '<p>The file '. basename( $_FILES['somefile']['name']). ' has been uploaded.</p>';
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
