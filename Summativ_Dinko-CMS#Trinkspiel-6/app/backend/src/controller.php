<?php
// Session Start
session_start();

// Klasse Controller: Schwestern Klasse der *Controller Klassen
class Controller
{
    // Model laden, übergebe data
    public function model(string $model, $data = null)
    {
        file_exists($path = APPROOT."/backend/models/{$model}.php") ? 
        require_once $path : 
        die('Bitte Model überprüfen!');
        return new $model($data);
    }

    // Controller: View laden, übergebe data
    public function view(string $view, $data = [])
    {
        file_exists($path = APPROOT. "/view/templates/{$view}.php") ? 
        require_once $path : 
        die('Bitte View überprüfen!');
    }
}