<?php

namespace app\controllers;

use app\Controller;

class SecurityController extends Controller
{
    const LOGIN = 'admin';
    const PASS = 'admin';

    public function loginAction()
    {
        if (!$this->auth->checkAuth()) {

            if (isset($_POST['l_submit'])) {
                $login = trim(htmlspecialchars($_POST['l_login']));
                $pass = md5($_POST['l_pass']);


                if($this->auth->login($login, $pass))
                    return redirectToRoute('adminpage');
            }

            return $this->render('security/login.php');
        }

        return redirectToRoute('adminpage');
    }

    public function logoutAction()
    {
        return $this->auth->logout();
    }
}