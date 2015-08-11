<?php

require_once '../bootstrap.php';



class Auth
{


	public static function attempt($email, $password, $dbc)
    {
        $query = 'SELECT user_id, password, avatar_img FROM users WHERE email = :email;';
        $stmt  = $dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
		$userAvatarPath = $results['avatar_img'];
        $userId  = $results['user_id'];
        $passwordHash = $results['password'];
		$attemptLog = new Log();

		if(password_verify($password, $passwordHash))
        {
        	$attemptLog->info("User: $email logged in.");
			$_SESSION['LOGGED_IN_USER'] = $email;
			$_SESSION['user_id'] = $userId;
			$_SESSION['avatar_img'] = $userAvatarPath;
            return true;
        }
        else
        {
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
