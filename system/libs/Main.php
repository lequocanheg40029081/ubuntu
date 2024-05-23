<?php

class Main {
    public $url;
    public $controllerName = "index";
    public $methodName = "index";
    public $controllerPath = "app/controllers/";
    public $controller;

    public function __construct() {
        $this->getUrl();
        $this->loadController();
        $this->callMethod();
    }
    

    public function getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;

        if ($url !== NULL) {
            $url = rtrim($url, '/');
            $this->url = explode('/', filter_var($url, FILTER_SANITIZE_URL));
        } else {
            $this->url = null; // Explicitly set to null if no URL is provided
        }
    }

    public function loadController() {
        if (isset($this->url) && isset($this->url[0])) {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . '.php';

            if (file_exists($fileName)) {
                include $fileName;

                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName();
                }
            } else {
                // Handle the case where the controller file doesn't exist
                header("Location: " . BASE_URL . "/error"); // Or a custom error page
            }
        } 
    }

    public function callMethod() {
        if (isset($this->url) && isset($this->url[1])) {
            $this->methodName = $this->url[1];

            if ($this->controller !== null && method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2] ?? null); // Pass optional third parameter
            } else {
                header("Location: " . BASE_URL . "/error"); // Or a custom error page
            }
        } else {
            if ($this->controller !== null && method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}();
            } else {
                header("Location: " . BASE_URL . "/error"); // Or a custom error page
            }
        }
    }
}

?>
