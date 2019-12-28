<?php

class App {


    protected $defaultController = 'Home';
    protected $defaultMethod = 'searchProducts';
    protected $params = [];


    public function __construct() {

        $url = $this->parseUrl();

        if(file_exists('../app/controllers/' . $url[0] . '.php' )) {

            $this->defaultController = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->defaultController . '.php';

        $this->defaultController = new $this->defaultController;
        
        if(isset($url[1])) {

            if(method_exists($this->defaultController, $url[1])) {

                $this->defaultMethod = $url[1];
                unset($url[1]);

                $this->params = $url ? array_values($url) : [];

                call_user_func_array([$this->defaultController, $this->defaultMethod], $this->params);
            }
            else {
                echo 'method does not exists';
            }

        }

    }


    public function parseUrl() {

        if(isset($_GET['url'])) {
            //echo $_GET['url'];

            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

        }
    }

}