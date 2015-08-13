<?php require_once 'auth.login.php'; ?>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Pablo's List</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="ads.show.php" >Pablo's Pick</a></li>
        <li><a href="ads.index.php">Browse</a></li>
        <!-- <li><a href="ron_ducking_swanson.html" >RonDuckingSwanson</a></li> -->
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="!search">
        </div>
        <button type="submit" class="btn btn-default">Search By Tags</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
         <!-- START AUTHENTICATED NAV VIEW -->
         <?php if (isset($_SESSION['LOGGED_IN_USER'])) { ?>
          <li><a><?= $_SESSION['LOGGED_IN_USER'] ?></a></li>
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <img alt="@j-beere" class="avatar" height="30" src="<?= $_SESSION['avatar_img'] ?>" width="30">
            <span class="caret"></span> </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="users.show.php" >Show My Listings</a></li>
              <li><a href="ads.create.php" >Post New Listing</a></li>
              <li><a href="" >My Watchlist</a></li>
              <li class="divider"></li>
              <li><a href="" >Ran Out Of Cool Things</a></li>
              <li class="divider"></li>
              <li><a href="">My Profile</a></li>
              <li><a href="auth.logout.php">Logout</a></li>
            </ul>
          </li>
      <?php } else { ?>
          <!-- END AUTHENTICATED NAV VIEW -->
          <!-- START GUEST NAV VIEW -->
        <li><p class="navbar-text"><a href="users.create.php"><strong>Join Us</strong></a></p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
										</div>
										<div class="form-group">
                                            <? if(!empty($errors) && Input::has('login_attempt')): ?>
                                            <h5 style="color: yellow"><?= $errors[0] ?></h5>
                                            <? endif; ?>
                                             <input hidden name="login_attempt" value="true">
											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox"> keep me logged-in
											 </label>
										</div>
								 </form>
							</div>
					 </div>
				</li>
			</ul>
        </li>
        <?php } ?>
        <!-- END GUEST NAV VIEW -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
