<?php

require_once '../bootstrap.php';



class Auth
{


	public static function attempt($email, $password, $dbc)
    {
        $query = 'SELECT user_id, password FROM users WHERE email = :email;';
        $stmt  = $dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        $userId  = $results['user_id'];
        $userPassword = $results['password'];

		if(password_verify($password, $userPassword))
        {
        	$_SESSION['LOGGED_IN_USER'] = $email;
            $_SESSION['user_id'] = $userId;

        	Log::info("User: $email logged in.");

            return true;
        }
        else
        {
        	Log::error("User: $email failed to log in");
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
        Log::info($_SESSION['LOGGED_IN_USER'] . ' logged out.');
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
