<?php

class Core
{
    public function run($routes)
    {
        $url = "/";

        isset($_GET['url']) ? $url .= $_GET['url'] :'';

        ($url != '/') ? $url = rtrim($url ,"/"): $url;

        $routerFound = false;

        foreach ($routes as $route => $controller)
        {
            $patterns = '#^'.preg_replace('/{id}/', '([\w-]+)', $route). '$#';
            
            if (preg_match($patterns, $url, $matches))
            {
                $routerFound = true;
                array_shift($matches);
                
                [$currentController, $action] = explode('@', $controller);

                require_once __DIR__."/../Controllers/$currentController.php";

                $controller = new $currentController();
                $controller->$action($matches);
            }
        }
        if (!$routerFound)
        {
            require_once __DIR__."/../Controllers/NotFoundController.php";
            $controller = new NotFoundController;
            $controller->index();
        }
    }
}