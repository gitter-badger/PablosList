<!-- user editing form -->
<?php
	require_once '../bootstrap.php';

	if(Input::has('edit_user'))
	{
		if(Input::get('password') == Input::get('confirm_password'))
		{
			//redirect
			$hashed_password = password_hash(trim(Input::get('password')), PASSWORD_DEFAULT);

		} else {
			
			echo "password confirmation doesn't match";
		}

		extract($_REQUEST);


		$new_user = new User();
		if (Input::has('first_name')) {

			$stmt = $dbc->prepare('UPDATE users
                      SET first_name=:first_name
                      WHERE id=:id');

			$stmt->bindValue(':first_name', Input::get(first_name), PDO::PARAM_STR);
		}
			$stmt->execute()

		if (Input::has('last_name')) {

			$stmt = $dbc->prepare('UPDATE users
                     SET last_name=:last_name
                     WHERE id=:id');
			$stmt->bindValue(':last_name', Input::get(last_name), PDO::PARAM_STR);
		}
			$stmt->execute()

		if (Input::has('email')) {

			$stmt = $dbc->prepare('UPDATE users
                     SET email=:email
                     WHERE id=:id');

			$stmt->bindValue(':email', Input::get(email), PDO::PARAM_STR);

		}
			$stmt->execute()
		if (Input::has('password')) {

			$stmt = $dbc->prepare('UPDATE users
                     SET password=:password
                     WHERE id=:id');

			$stmt->bindValue(':password', Input::get(password), PDO::PARAM_STR);
		}
			$stmt->execute()

		if (Input::has('avatar_img')) {

			$stmt = $dbc->prepare('UPDATE users
                     SET avatar_img=:avatar_img
                     WHERE id=:id');

			$stmt->bindValue(':avatar_img', Input::get(avatar_img), PDO::PARAM_STR);
		}
			$stmt->execute();

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
    <link href="css/register.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
      <div class="container-fluid">
      <?php include_once '../views/partials/navbar.php';?>
    	<hr>
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" id="register-form-link">Edit</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" action="" method="post" role="form">
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="">
									</div>
                                    <div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									<?php if (isset($emailError)) { ?>
									<p class="text-danger"><?= $emailError ?></p>
									<?php } ?>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password">
										<?php if (isset($passwordError)) { ?>
										<p class="text-danger"><?= $passwordError ?></p>
										<?php } ?>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
                                                <input hidden name="edit_user" value="true">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    </body>
</html>