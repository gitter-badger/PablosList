<?php
    require_once '../bootstrap.php';
    // session_start();

    if(Input::has('login_attempt'))
    {
        try {
            if(Auth::attempt(Input::get('email'), Input::get('password'), $dbc))
            {

            }
        } catch (Exception $e) {
                $errors[] =  $e->getMessage();
        }
    }

?>
