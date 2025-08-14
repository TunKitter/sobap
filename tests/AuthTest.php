<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
putenv('ROOT_DIR=C:/laragon/www');
require_once getenv("ROOT_DIR"). "/bootstrap/env.php";
require_once "lib/auth/Auth.php";
require_once "lib/Request.php";
require_once "lib/Request.php";
require_once "lib/utility/utility.php";
class AuthTest extends TestCase
{
    public static function tearDownAfterClass():void {
        putenv("ROOT_DIR=");
    }
    public function testNoAuthToken() {
        $request = new Request();
        $this->assertNotTrue(Auth::use('jwt')->check($request));
        $this->assertSame(true,true);
    }
    public function invalidAuthToken(){
        return [
            'empty string' => [''],
            'random text #1' => ['sdsdasdasccx'],
            'random text #2' => ['sd22312We23.dasbs.12312'],
            'random text #3' => ['c29tZXRoaW5n.ZGVtbzEyMw==.b2tlZTEyMw=='],
            'empty header #1' => ['eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.YjYyY2FhNDgwNTcyNDUwMjQyNmYzOTI3ZDFiN2U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA'],
            'empty header #2' => ['.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.YjYyY2FhNDgwNTcyNDUwMjQyNmYzOTI3ZDFiN2U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA'],
            'modify header with none algorithm' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5NDI4fQ.MTJhYTIxOWYyNzUzMWI4MDA0ZjAwNDllY2QwOWQxNmViMzdhOWY2NjYwODI3NjI3NTI1MTg3NTMwYWFhMWRiNA'],
            'empty payload #1' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.YjYyY2FhNDgwNTcyNDUwMjQyNmYzOTI3ZDFiN2U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA'],
            'empty payload #2' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..YjYyY2FhNDgwNTcyNDUwMjQyNmYzOTI3ZDFiN2U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA'],
            'expired date' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6MTc1NDE3NTk4M30.ZDk3MDVlMGFjNTcwNDk1MzZmNjI1OTc2ZjYyZDRlZDRmZmQyNDA3YWQ2MmE0NjZkNTAxZmFmM2ZjYjBhMjdmYQ'],
            'invalid date #1' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6MH0.MTFhODViMjIyODBlMmRlNzQ5NWM4NGM1OTJiNzNlMTUxMzQxMmYxYmJlZjRkYTU5YWM3YjBmMTc1OWM1YjE4Mw'],
            'invalid date #2' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6bnVsbH0.ZTNkMTcxMzAxMGU4Y2FiZmQyOGFlNTQwOGNkZWQ1MDYxNjk0ZmUwOWEyYTczODQzOGMwNjQ4Yjg5ZjYxNjllOA'],
            'invalid date #3' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6InNkYWRzIn0.NTY1M2Q0MDRhYzNlMjE2MzczNjkxNjRiMDdlNWMyOGRlODIwNWRhOWM4M2I2YmNhODlmNWU0ZTE5Y2I1ZDc4Nw'],
            'empty signature #1' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ'],
            'empty signature #2' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.'],
            'invalid signature #1' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.sdasdasdq2'],
            'invalid signature #2' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.YjYyY2UwMjQyNmYzOTI3ZDFiNDS123TZDAS12U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA'],
            'invalid signature #3' => ['eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.MjA1NTdlMGNiZmNlOTU1NmU1ZTRjNjM0OGVjNjdlMDU2ZGRmODI3ZjI4NzU2MGZmYzc0NzAxZjlhZmYwZjQ4Yg'],
        ];
    }
    #[DataProvider('invalidAuthToken')]
    public function testInvalidAuthToken($token) {
        $_COOKIE['Auth'] = $token;
        $request = new Request();
        $this->assertNotTrue(Auth::use('jwt')->check($request)['status']);
    }

    public function testValidAuthToken() {
        $_COOKIE['Auth'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoidHVuayIsImFnZSI6MTIsImV4cCI6ODY0MDAxNzU0MDk5MzQ0fQ.YjYyY2FhNDgwNTcyNDUwMjQyNmYzOTI3ZDFiN2U4MTU3YmI2YTdlYmEzZTM4N2RkODQ4M2M3YzVmNzY5ZTRhOA';
        $request = new Request();
        $this->assertTrue(Auth::use('jwt')->check($request)['status']);
    }
    public function testValidAuthLogin() {
        $_POST['name'] = 'tunk';
        $_POST['age'] = 12;
        $this->assertTrue(Auth::use('jwt')->login(new Request()));
    }
    public function unvalidAuthLoginData() {
        return [
            'all empty' => ['',''],
            'empty name' => ['',12],
            'empty age' => ['tunk',''],
            'invalid age' => ['tunk','sdasd'],
            'non-exist data' => ['something','64'],
        ];
    }
    #[DataProvider('unvalidAuthLoginData')]
     public function testUnvalidAuthLogin($name,$age) {
        $_POST['name'] = $name;
        $_POST['age'] = $age;
        $this->assertNotTrue(Auth::use('jwt')->login(new Request()));
    }
    public function testLogoutAndBlackListtAuthData() {
        $_POST['name'] = 'tunk';
        $_POST['age'] = 12;
        $request = new Request();
        $this->assertTrue(Auth::use('jwt')->login($request));
        $data = Auth::use('jwt')->check($request);
        $this->assertNotNull($_COOKIE['Auth']);
        $token = explode('.',$_COOKIE['Auth']);
        $this->assertTrue(Auth::use('jwt')->logout($request));
        $file = getenv("ROOT_DIR"). "/lib/auth/methods/jwt_blacklist/{$token[2]}";
        $this->assertTrue(file_exists($file));
        $_COOKIE['Auth'] = implode('.',$token);
        $this->assertNotTrue(Auth::use('jwt')->check($request));
        $this->assertNotTrue(file_put_contents($file,time()-1000));
        $this->assertNotTrue(Auth::use('jwt')->check($request));
        $this->assertNotTrue(file_exists($file));
        
    }
}
