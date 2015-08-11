<?php
    require_once '../bootstrap.php';
    session_start();

    if(Input::has('login_attempt'))
    {
        try {
            if(Auth::attempt(Input::get('email'), Input::get('password'), $dbc))
            {
                header('Location: index.php');
            }
        } catch (Exception $e) {
                $errors[] =  $e->getMessage();
        }
    }

    $_SESSION['LOGGED_IN_USER'] = $email;
    $_SESSION['user_id'] = $userId;
?>
