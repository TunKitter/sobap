<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
require_once "lib/route/Route.php";
class RouteTest extends TestCase
{
    #[TestDox("Test the same instance every call Route object")]
    public function testInstance()
    {
        $_SERVER['REQUEST_URI'] = "";
        $this->assertSame(Route::getInstance(), Route::getInstance());
    }
}