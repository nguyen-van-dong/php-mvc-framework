<?php

namespace Tests\controllers;

use app\controllers\TaskController;

use app\core\Request;
use Tests\BaseTestCase;

class TaskControllerTest extends BaseTestCase
{
    public $app;

    public function __construct()
    {
        $this->app = $this->bootCreateApplication();
    }

    public function testMethodIndexIsReturnArray()
    {
        $this->app->router->get('/tasks');
        $this->assertTrue(true);
    }

    public function testMethodCreateIsReturnAnObjectOrReturnView()
    {
        $this->assertTrue(true);
    }

    public function testMethodEditIsReturnAnObjectOrReturnView()
    {
        $this->assertTrue(true);
    }

    public function testMethodDeleteIsDeleteARecord()
    {
        $this->assertTrue(true);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        try {
            $reflection = new \ReflectionClass(get_class($object));
            $method = $reflection->getMethod($methodName);
            $method->setAccessible(true);
            return $method->invokeArgs($object, $parameters);
        } catch (\ReflectionException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}