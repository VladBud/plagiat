<?php

                                        //FRONT CONTROLLER

    //Загальні налаштування

//1. На час розробки проекту включаємо показ помилок

ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Включаємо сессію для всіх сторінок

session_start();

//3. Задаємо константою шлях

$dirname = str_replace('\\', '/', dirname(__FILE__));
define('ROOT', $dirname);
define('SITE_NAME', 'Перевірка на антиплагіат');
define('ERROR404', ROOT . '/views/404/404.php');
define('MAX_FILE_SIZE', 30000);
//Підключення файлів системи
require_once(ROOT . '/components/Router.php');

//З'єднання з БД
require_once(ROOT . '/components/Db.php');

//Виклик роутера
$router = new Router;
$router->start();