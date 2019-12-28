<?php

class Controller 
{

    protected function returnModel($modelName) {

        require_once '../app/models/' . $modelName . '.php';
        return new $modelName();
    }

    protected function showView($viewName, $content = []) {

        require_once '../app/views/' . $viewName . '.php';
    }

}