<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
require "lib/route/Route.php";
class RouteTest extends TestCase
{
    #[TestDox("Test the same instance every call Route object")]
    public function testInstance()
    {
        $this->assertSame(Route::getInstance(), Route::getInstance());
    }
}