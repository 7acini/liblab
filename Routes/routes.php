<?php 

$routes = [
    "/"            => "HomeController@index",
    "/users/{id}"  => "UserController@show",
    "/login"       => "UserController@login",
    "/login/auth"  => "UserController@auth",
    "/logout"       => "UserController@logout",
    "/cadastro"    => "UserController@cadastro",
    "/register"    => "UserController@store", // Rota para processar o cadastro
];