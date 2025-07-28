<?php
class HomeController
{
    public static function index(Request $request)
    {
        // var_dump(Validate::with('Demo')->from('sadas')->justDemo());
        // var_dump(Database::select('something')->join('ahihi','ahihi.something_id', '=', 'something.id')->get());
        // Database::transaction(function ($db, $commit, $rollback) {
        //     $a = false;
        //     $db::insert('something')->columns('name', 'age')->withData(['ahihi' . rand(1, 100), rand(1, 1000)])->execute();
        //     $db::insert('something')->columns('name', 'age')->withData(['ahihi' . rand(1, 100), rand(1, 1000)])->execute();
        //     $a == true ? $commit() : $rollback();
        // });
        // var_dump(Database::update('something')->set(['name' => 'ahihi' . rand(1, 100), 'age' => rand(1, 1000)])->where([['id', '=', '193'], ['name', '=', 'demo']])->where('age', '=', '15')->execute());
        // var_dump(Database::delete('something')->where([['id', '=', '195'], ['name', '=', 'assds']])->execute());
        // var_dump(Database::insert('something')->columns('name', 'age')->withData(['asdds',17])->execute());
        // var_dump(Database::select('something')->where('id', '>=', '194')->orWhere('name', '=', 'demo')->getDistinct('name'));
        // var_dump(Database::select('something')->where([['id', '=', '193'], ['name', '=', 'demo']])->where([['age', '=', '12']])->get('name'));
        // var_dump(Database::raw('INSERT INTO something (name,age) VALUES ("test",18)')->execute());
        // var_dump(Database::distinct('something')->get());
        // var_dump(Database::raw('SELECT DISTINCT name FROM something')->execute());
        // var_dump(Database::raw('DELETE FROM something WHERE id = 203')->execute());
        // Database::transaction(function ($commit, $rollback) {
        // $a = 0;
        // Database::delete('something', 'id = 193');
        // Database::delete('something', 'id = 195');
        // $a == 1 ? $commit() : $rollback();
        // });
        // var_dump($a);
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName("Edited Home");
        $view->layout->render();
    }
}