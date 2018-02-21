<?php

namespace app\controllers;

use app\Controller;

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
                    return $this->render('security/login.php');
                }
            }

            return $this->render('security/login.php');
        }

        return $this->redirectToRoute('adminpage');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['auth']))
        {
            unset($_SESSION['auth']);
        }

        return $this->redirectToRoute('loginpage');
    }
}