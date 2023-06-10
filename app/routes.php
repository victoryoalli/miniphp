 <?php

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('whoops', 'PagesController@whoops');

$router->get('users', 'UsersController@index');
$router->post('users', 'UsersController@store');
