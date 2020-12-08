<?php
class Router
{
    public static function page($link)
    {
        $routes = [
            "/" => '/index.view.php',
            "/about" => "/about.php",
            "/edit" => "/edit.php",
            "/add" => "/addpost.php",
            "/delete" => "/deletepost.php"
        ];

        preg_match('/^([^?]+)(\?.*?)?(#.*)?$/', $link, $matches);
        $route = $matches[1];

        if (array_key_exists($route, $routes)){
            $file = $_SERVER['DOCUMENT_ROOT'] . $routes[$route];
            
        } else {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        }

        return $file;


    }
}