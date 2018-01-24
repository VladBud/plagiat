<?php


 /** Set route as
  'name' => [
           'defaults' => 'NameController/methodAction',
           'path' => ''
           ]

  Route with parameters
  name' => [
           'defaults' => 'NameController/methodAction/$1/$2',
           'path' => 'path/([0-9]+)/([a-zA-Z]+)'
           ]
 */


return [

    'loginpage' => [
        'defaults' => 'Security/login',
        'path' => '/login'
    ],
    'adminpage' => [
        'defaults' => 'Admin/index',
        'path' => '/admin'
    ],
    'homepage' => [
        'defaults' => 'Index/index',
        'path' => '/'
    ],
];