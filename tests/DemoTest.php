<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\RequiresFunction;
use PHPUnit\Framework\Attributes\TestDox;
function demoNe()
{
    echo 123;
}
class DemoTest extends TestCase
{
    #[Depends('something')]
    #[Test]
    public function demo($array)
    {
        $this->assertSame('1', 1);
        // $this->markTestSkipped('Shadow');
        // echo "12322312";
        // $this->expectOutputString('demo');
        // echo 'demo';
        // $this->markTestIncomplete('Data not complete bro');
    }
    #[Test]
    public function something()
    {
        $a = [1, 5, 9];
        $this->assertNotEmpty($a);
        return $a;
    }

}