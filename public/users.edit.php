 <?php
	require_once '../bootstrap.php';
        $id = (int)$_SESSION['user_id'];

        if(Input::get('password') !== Input::get('confirm_password'))
        {
			$passwordError = "Password confirmation doesn't match password.";
		}

		if(Input::get('password') == Input::get('confirm_password'))
        {
			$hashed_password = password_hash(trim(Input::get('password')), PASSWORD_DEFAULT);
		}

		if (Input::has('first_name') && Input::has('last_name') && Input::has('email') && isset($hashed_password))
        {
    		$new_user = new User();
    		$new_user->id = $id;
            $new_user->first_name = Input::get('first_name');
            $new_user->last_name = Input::get('last_name');
            $new_user->email = Input::get('email');
            $new_user->password = $hashed_password;
            $new_user->update();

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
								<a href="#" id="register-form-link">Edit User Information</a>
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
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Save Changes">
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
