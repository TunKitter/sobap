<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
require_once "lib/view/Dom.php";
class DOMTest extends DOMDecorator
{
    public function setup()
    {
        echo "I am setup";
    }
}
class ViewTest extends TestCase
{
    #[TestDox("Test output HTML")]
    public function testHTML()
    {
        $dom = new DOMDocument();
        $dom->loadHTML('<h1>hello</h1>');
        $view = new DOMDecorator($dom);
        $this->expectOutputString($dom->saveHTML());
        $view->render();
    }
    #[TestDox("Test auto run 'setup' method")]
    public function testSetupMethod()
    {
        $aa = $this->createMock(DOMTest::class);
        $aa->expects($this->once())->method('setup');
        $aa->__construct(new DOMDocument());
    }
}