<?php
class Router
{
    protected $controller = 'ProductController';
    protected $action = 'index';
    protected $params = [];

    public function route(array $segments)
    {
        if (!empty($segments[0])) {
            $this->controller = ucfirst($segments[0]) . 'Controller';
            array_shift($segments);
        }

        if (!empty($segments[0])) {
            $this->action = $segments[0];
            array_shift($segments);
        }

        $this->params = $segments;

        $controllerFile = __DIR__ . '/../controllers/' . $this->controller . '.php';
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "Controller not found";
            exit;
        }

        require_once $controllerFile;
        $controllerInstance = new $this->controller();

        if (!method_exists($controllerInstance, $this->action)) {
            http_response_code(404);
            echo "Action not found";
            exit;
        }

        return call_user_func_array([$controllerInstance, $this->action], $this->params);
    }
}
