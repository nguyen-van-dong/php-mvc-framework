<?php

namespace app\core;

use app\core\Router;

class Application
{
    public static string $ROOT_DIR;

    public Router $router;

    public Request $request;

    public Response $response;

    public static Application $app;

    public Controller $controller;

    public Database $db;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;

        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        require_once $rootPath . '/helpers/helpers.php';
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
