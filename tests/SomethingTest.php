<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;

class SomethingTest extends TestCase
{
    #[Depends('something2')]
    #[Test]
    public function demo22($array)
    {
        $this->assertSame($array, [1, 5, 9]);
        // $this->markTestSkipped('Shadow');
        // echo "12322312";
        // $this->expectOutputString('demo');
        // echo 'demo';
        // $this->markTestIncomplete('Data not complete bro');
    }
    #[Test]
    public function something2()
    {
        $a = [1, 5, 9];
        $this->assertNotEmpty($a);
        return $a;
    }

}