<?php 

$routes = [
    "/"            => "HomeController@index",
    "/users/{id}"  => "UserController@show",
    "/login"       => "UserController@login",
    "/cadastro"    => "UserController@cadastro",
    "/register"    => "UserController@store", // Rota para processar o cadastro
];