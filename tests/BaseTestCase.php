<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

abstract class BaseTestCase extends TestCase
{
    use CreatesApplication;
}