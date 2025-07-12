<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
require_once "lib/validate/Validate.php";

class ValidationTest extends TestCase
{
    public function testEmail()
    {
        $this->assertSame(Validate::from('emailsds@gmail.com')->email()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('emailsds')->email()->validate(), ['is_error' => true, 'data' => ['email' => 'Email is not valid']]);
        $this->assertSame(Validate::from('emailsds')->email('something wrong')->validate(), ['is_error' => true, 'data' => ['email' => 'something wrong']]);
    }

    public function testAlphaNumericSpace()
    {
        $this->assertSame(Validate::from('demo')->alphaNumericSpace()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('de mo')->alphaNumericSpace()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('de_mo')->alphaNumericSpace()->validate(), ['is_error' => true, 'data' => ['alphaNumericSpace' => 'The string contains invalid characters']]);
        $this->assertSame(Validate::from('de_mo')->alphaNumericSpace('nooooo')->validate(), ['is_error' => true, 'data' => ['alphaNumericSpace' => 'nooooo']]);
    }
    public function testAlphaNumeric()
    {
        $this->assertSame(Validate::from('demo')->alphaNumeric()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('de mo')->alphaNumeric()->validate(), ['is_error' => true, 'data' => ['alphaNumeric' => 'The string contains invalid characters']]);
        $this->assertSame(Validate::from('de_mo')->alphaNumeric()->validate(), ['is_error' => true, 'data' => ['alphaNumeric' => 'The string contains invalid characters']]);
        $this->assertSame(Validate::from('de_mo')->alphaNumeric('nooooo')->validate(), ['is_error' => true, 'data' => ['alphaNumeric' => 'nooooo']]);
    }

    public function testRegex()
    {
        $this->assertSame(Validate::from('demo123')->regex('/^[a-zA-Z0-9\s]+$/')->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('demo123 ')->regex('/^[a-zA-Z0-9\s]+$/')->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('demo123 ')->regex('/^[a-zA-Z0-9\s]+$/', 'ahihi')->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('demo_123')->regex('/^[a-zA-Z0-9\s]+$/')->validate(), ['is_error' => true, 'data' => ['regex' => 'The string does not match regex pattern']]);
        $this->assertSame(Validate::from('demo_123')->regex('/^[a-zA-Z0-9\s]+$/', 'something went wrong')->validate(), ['is_error' => true, 'data' => ['regex' => 'something went wrong']]);
    }
    public function testNumeric()
    {
        $this->assertSame(Validate::from(123)->numeric()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('123')->numeric()->validate(), ['is_error' => false, 'data' => []]);
        $this->assertSame(Validate::from('123 ')->numeric()->validate(), ['is_error' => true, 'data' => ['numeric' => 'The string must contain only numbers']]);
        $this->assertSame(Validate::from('123 ')->numeric('ahihi')->validate(), ['is_error' => true, 'data' => ['numeric' => 'ahihi']]);
    }
}