<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
class CSRFTest extends TestCase
{

    public static function tearDownAfterClass():void {
        putenv("ROOT_DIR=");
    }
    public function testRenderCsrfToken() {
        putenv('ROOT_DIR=C:/laragon/www');
        $token = csrf()->render();
        $this->assertNotNull($token);

        $dir = getenv('ROOT_DIR'). "/lib/csrf/sessions/$token";
        $this->assertTrue(file_exists($dir));
        $this->assertSame(csrf()->check($token),1);

        $file = fopen($dir, 'r');
        $time = fread($file, filesize($dir));
        fclose($file);

        $this->assertNotNull($time);
        $this->assertTrue(time() < $time);
        file_put_contents($dir, time() - 1000);
        $this->assertSame(csrf()->check($token),0);
        $this->assertFalse(file_exists($dir));
        $token = csrf()->render();
        $this->assertTrue(csrf()->destroy($token));
        $this->assertFalse(file_exists($dir));
    }
}
