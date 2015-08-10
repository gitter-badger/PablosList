<?php
require_once 'Log.php';

class Auth
{
	public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';

	public static function attempt($username, $password)
	{
		$loggedIn = new log('Auth');
		if ( $username == 'guest' && (password_verify($password, self::$password)) ){

			$loggedIn->info("User $username logged in.");
			$_SESSION['LOGGED_IN_USER'] = $username;
			return true;

		} else{

			$loggedIn->error("User $username failed to log in!");
			header("Location: http://pabloslist.dev/login.php?status=failed");
            exit;

		}

	}

// Auth::check() will return a boolean whether or not a user is logged in.
	public static function check()
	{
		return isset($_SESSION['LOGGED_IN_USER']) ? true : false;
	}

// Auth::user() will return the username of the currently logged in user.
	public static function user()
	{
		return self::check() ? $_SESSION['LOGGED_IN_USER'] : null;
	}

// Auth::logout() will end the session, just like we did in the sessions exercise.
	public static function logout()
	{
	    // Unset all of the session variables.
	    $_SESSION = [];

	    // If it's desired to kill the session, also delete the session cookie.
	    // Note: This will destroy the session, and not just the session data!
	    if (ini_get("session.use_cookies")) {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	        );
	    }

	    // Finally, destroy the session.
	    session_destroy();
	    header("Location: http://pabloslist.dev/index.php");
	    exit;
	}






}
// END Auth class
