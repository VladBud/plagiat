<?php

namespace app\controllers;

use App\Controller;

class SecurityController extends Controller
{
    const LOGIN = 'admin';
    const PASS = 'admin';

    public function loginAction()
    {
        if (!(isset($_SESSION['auth']))) {

            if (isset($_POST['l_submit'])) {
                $login = trim(htmlspecialchars($_POST['l_login']));
                $pass = trim(htmlspecialchars($_POST['l_pass']));

                if (self::LOGIN == $login && self::PASS == $pass) {
                    $_SESSION['auth'] = true;
                    
                    return $this->redirectToRoute('adminpage');
                    
                } else {
                    return $this->render('/views/security/login.php');
                }
            }

            return $this->render('/views/security/login.php');
        }

        return $this->redirectToRoute('adminpage');
    }
}