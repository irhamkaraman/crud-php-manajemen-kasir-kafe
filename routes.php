<?php

require_once 'Controller/BarangController.php';
require_once 'Controller/ErrorController.php';
require_once 'Controller/AuthController.php';

class Router
{
  public static function handleRequest()
  {
    $routes = $_SERVER['REQUEST_URI'];
    $routes = trim(str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $routes), '/');

    $BarangController = [
      '' => 'index',
      'tambah' => 'create',
      'simpan' => 'simpan',
      'edit' => 'edit',
      'update' => 'update',
      'hapus' => 'hapus',
    ];

    $AuthController = [
      'login' => 'login',
      'register' => 'register',
      'logout' => 'logout',
    ];

    if (isset($BarangController[$routes])) {
      $controller = new BarangController();
      $method = $BarangController[$routes];
      $controller->$method();
    } elseif (isset($AuthController[$routes])) {
      $controller = new AuthController();
      $method = $AuthController[$routes];
      $controller->$method();
    } else {
      http_response_code(404);
      $errorController = new ErrorController();
      $errorController->index();
      exit();
    }
  } 
}

function url($path)
{
  return BASE_URL . $path;
}

$router = new Router();
$router->handleRequest();

