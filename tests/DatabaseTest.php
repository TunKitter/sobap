<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
require_once "lib/database/Database.php";
require_once "lib/database/DatabaseHandler.php";
require "bootstrap/exception.php";
set_error_handler("handleErrorWithDebug");
set_exception_handler("handleExceptionWithDebug");
class DatabaseTest extends TestCase
{
    public function testTheSameInstance()
    {
        $this->assertSame(Database::getInstance(), Database::getInstance());
    }
    public function testSelect()
    {
        $this->assertIsArray(Database::select('something')->get());
        $this->assertIsArray(Database::select('something')->getDistinct());
        $this->assertIsArray(Database::select('something')->where('id', '=', '1')->get());
        $this->assertIsArray(Database::select('something')->where('id', '=', '1')->where([['id', '=', '2'], ['name', '=', 'demo']])->get());
        $this->assertIsArray(Database::select('something')->groupBy('id')->get());
        $this->assertIsArray(Database::select('something')->groupBy('id')->limit(1)->get());
        $this->assertIsArray(Database::select('something')->orderBy('id', 'desc')->get());
        $this->assertIsArray(Database::select('something')->orderBy('id', 'desc')->limit(1)->get());
        $this->assertIsArray(Database::select('something')->join('ahihi', 'ahihi.something_id', '=', 'something.id')->get());
        $this->assertIsArray(Database::select('something')->leftJoin('ahihi', 'ahihi.something_id', '=', 'something.id')->get());
        $this->assertIsArray(Database::select('something')->rightJoin('ahihi', 'ahihi.something_id', '=', 'something.id')->get());
        $this->assertEquals(Database::insert('something')->columns('name', 'age')->withData(['testing', 123])->execute(), []);
        $this->assertEquals(Database::update('something')->set(['name' => 'testing', 'age' => 123])->where([['id', '=', '1'], ['name', '=', 'demo']])->execute(), []);
        $this->assertEquals(Database::delete('something')->where([['id', '=', '1'], ['name', '=', 'demo']])->execute(), []);
        $this->assertIsArray(Database::raw('SELECT * FROM something')->usingData()->execute());
        $this->assertEquals(Database::raw('DELETE FROM something WHERE 0 = ?')->usingData(1)->execute(), []);
        $this->assertNull(Database::transaction(function ($db, $commit, $rollback) {}));
    }
    public function nonMethodDataProvider()
    {
        return [
            'Select with none exist method' => [fn() => Database::select('something')->sasdss('sdas')],
            'Select with none exist method 2' => [(fn() => Database::select('something')->sasdss('sdas')->sdasdas3())],
            'Select after select' => [(fn() => Database::select('something')->limit(1)->select('something'))],
            'Insert with none exist method' => [fn() => Database::insert('something')->sasdss('sdas')],
            'Insert with none exist method 2' => [(fn() => Database::insert('something')->sasdss('sdas')->sdasdas3())],
            'Insert after insert' => [(fn() => Database::insert('something')->limit(1)->insert('something'))],
            'Update with none exist method' => [fn() => Database::update('something')->sasdss('sdas')],
            'Update with none exist method 2' => [(fn() => Database::update('something')->sasdss('sdas')->sdasdas3())],
            'Update after update' => [(fn() => Database::update('something')->limit(1)->update('something'))],
            'Delete with none exist method' => [fn() => Database::delete('something')->sasdss('sdas')],
            'Delete with none exist method 2' => [(fn() => Database::delete('something')->sasdss('sdas')->sdasdas3())],
            'Delete after delete' => [(fn() => Database::delete('something')->limit(1)->delete('something'))],
            'Raw with none exist method' => [fn() => Database::raw('SELECT * FROM something')->sasdss('sdas')],
            'Raw with none exist method 2' => [(fn() => Database::raw('SELECT * FROM something')->sasdss('sdas')->sdasdas3())],
            'Raw after raw' => [(fn() => Database::raw('SELECT * FROM something')->limit(1)->raw('SELECT * FROM something'))],
            'Transaction with none exist method' => [fn() => Database::transaction(function ($commit, $rollback) {})],
            'Transaction with none exist method 2' => [(fn() => Database::transaction(function ($commit, $rollback) {})->sdasdas3())],
            'Transaction after transaction' => [(fn() => Database::transaction(function ($commit, $rollback) {})->limit(1)->transaction(function ($commit, $rollback) {}))],
        ];
    }

    #[DataProvider('nonMethodDataProvider')]
    public function testNonMethodWithStatements($method)
    {
        $this->expectException(Exception::class);
        $method();
    }
    public function testNonMethod()
    {
        $this->expectException(Error::class);
        Database::nonExistMethod();
    }
}
