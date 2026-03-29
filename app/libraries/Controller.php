<?php
class Controller
{
    public function model($model)
    {
        $modelPath = APPROOT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $model . '.php';

        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            die('Model does not exist: ' . $model . '<br>Expected path: ' . $modelPath);
        }
    }

    public function view($view, $data = [])
    {
        $viewPath = APPROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die('View does not exist: ' . $view . '<br>Expected path: ' . $viewPath);
        }
    }
}