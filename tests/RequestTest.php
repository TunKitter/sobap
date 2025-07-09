<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
require_once "lib/Request.php";
class RequestTest extends TestCase
{
    #[TestDox("Test the same value between Request object and GET global variable")]
    public static function fakeData()
    {
        return [
            'Test with a' => ['a', 'a value'],
            'Test with b' => ['b', 'b value'],
            'Test with c' => ['c', 'c value'],
        ];
    }
    #[DataProvider('fakeData')]
    public function testSameValueGetRequest($key, $value)
    {
        $_GET = array_combine([$key], [$value]);
        $request = new Request();
        foreach ($_GET as $key => $value) {
            $this->assertSame($request->get($key), $value);
        }
    }
    #[DataProvider('fakeData')]
    public function testSameValuePostRequest($key, $value)
    {
        $_POST = array_combine([$key], [$value]);
        $request = new Request();
        foreach ($_POST as $key => $value) {
            $this->assertSame($request->post($key), $value);
        }
    }
    #[TestDox("Test the default value Request object")]
    public function testDefaultValueGetRequest()
    {
        $request = new Request();
        $this->assertSame($request->get('demo', 'ahihi'), 'ahihi');
        $this->assertSame($request->post('demo', 'ahihi'), 'ahihi');
    }
}