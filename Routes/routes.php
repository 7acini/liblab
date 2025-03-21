<?php 

$routes = [
    "/"           => "HomeController@index",
    "/users/{id}" => "UserController@show",
    "/login"      => "UserController@login"
];
