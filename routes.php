<?php

require_once 'Controller/ErrorController.php';
require_once 'Controller/AuthController.php';
require_once 'Controller/DashboardController.php';
require_once 'Controller/Admin/MenuController.php';
require_once 'Controller/Admin/AkunController.php';
require_once 'Controller/Member/KeranjangController.php';
require_once 'Controller/Member/RiwayatController.php';
require_once 'Controller/Admin/KonfirmasiController.php';

class Router
{
  public static function handleRequest()
  {
    $routes = trim(str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']), '/');

    $controllers = [
      'AuthController' => [
        'login' => 'login',
        'login/auth' => 'auth',
        'register' => 'register',
        'register/store' => 'store',
        'logout' => 'logout',
      ],
      'DashboardController' => [
        '' => 'index',
        'profile' => 'profile',
        'profile/update' => 'update',
      ],
      'MenuController' => [
        'menu/create' => 'create',
        'menu/store' => 'store',
        'menu/{id}/edit' => 'edit',
        'menu/update/{id}' => 'update',
        'menu/{id}/delete' => 'delete',
      ],
      'AkunController' => [
        'akun' => 'index',
        'akun/{id}/edit' => 'edit',
        'akun/{id}/delete' => 'delete',
        'akun/update/{id}' => 'update',
      ],
      'KeranjangController' => [
        'keranjang' => 'index',
        'keranjang/{id}/store' => 'store',
        'keranjang/{id}/delete' => 'delete',
        'keranjang/{id}/bayar' => 'paid',
      ],
      'RiwayatController' => [
        'riwayat' => 'index',
        'riwayat/{id}/tandai' => 'tanda',
        'riwayat/{id}/delete' => 'delete',
      ],
      'KonfirmasiController' => [
        'konfirmasi' => 'index',
        'konfirmasi/{id}/update' => 'konfirmasi',
      ],
    ];

    foreach ($controllers as $controllerName => $methods) {
      foreach ($methods as $pattern => $method) {
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $pattern);
        $pattern = str_replace('/', '\/', $pattern);

        if (preg_match('/^' . $pattern . '$/', $routes, $matches)) {
          $controller = new $controllerName();
          if (isset($matches['id'])) {
            $controller->$method($matches['id']);
          } else {
            $controller->$method();
          }
          return;
        }
      }
    }

    http_response_code(404);
    $errorController = new ErrorController();
    $errorController->index();
    exit();
  }
}

function url($path)
{
  return BASE_URL . $path;
}

$router = new Router();
$router->handleRequest();
