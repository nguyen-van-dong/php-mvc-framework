<?php
use app\core\Application;
use app\controllers\TaskController;
use app\controllers\HomeController;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'./../');
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/fetch-event', [TaskController::class, 'index']);

$app->router->get('/create-task', [TaskController::class, 'create']);
$app->router->post('/create-task', [TaskController::class, 'create']);

$app->router->get('/edit-task', [TaskController::class, 'edit']);
$app->router->post('/edit-task', [TaskController::class, 'edit']);

$app->router->get('/delete-task', [TaskController::class, 'delete']);

$app->run();
