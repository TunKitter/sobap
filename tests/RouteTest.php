<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
require_once "lib/route/Route.php";
interface Demo
{
    public function ahihi(): string;
}

interface Demo2
{

}
class Something implements Demo, Demo2
{
    public function ahihi(): string
    {
        return "ahihi";
    }
    public function doSomething()
    {
        return "tunkit";
    }
    public function doSomethingElse()
    {
        return "tunkit222";
    }
}
class RouteTest extends TestCase
{
    #[TestDox("Test the same instance every call Route object")]
    public function testInstance()
    {
        $this->assertSame(Route::getInstance(), Route::getInstance());
    }
}