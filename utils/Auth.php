<?php

require_once '../bootstrap.php';



class Auth
{


	public static function attempt($email, $password, $dbc)
    {
		$stmtPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT user_id, avatar_img FROM users WHERE email = '$email'
		AND password = '$stmtPassword'";
        $stmt = $dbc->exec($query);
		var_dump($stmt);
        // $results = $stmt->fetchAll();

		$attemptLog = new Log();
		if ($stmt) {
			// var_dump($results);
	        $_SESSION['user_id'] = $results['user_id'];
			$_SESSION['LOGGED_IN_USER'] = $email;
			$_SESSION['avatar_img'] = $results['avatar_img'];
			var_dump($_SESSION['avatar_img']);
	    	$attemptLog->info("User: $email logged in.");
	        return true;
        } else {
        	$attemptLog->error("User: $email failed to log in");
                throw new Exception('No account was found with the  email and password.');
            return false;
        }
    }

    static function currentUser()
    {
        return $_SESSION['LOGGED_IN_USER'];

    }

    static function checkUser()
    {
        return !empty($_SESSION['LOGGED_IN_USER']) && isset($_SESSION['LOGGED_IN_USER']) ? true : false;

    }

    static function logoutUser()
    {
        $closedSessions = new Log();
		$closedSessions->info($_SESSION['LOGGED_IN_USER'] . ' logged out.');
        $_SESSION = array();

        if(ini_get("session.use_cookies"))
        {

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
        }

        session_destroy();

    }

}

?>
