<?php
class HomeController
{
    public static function index(Request $request)
    {
        // var_dump(csrf()->render());
        // var_dump(csrf()->destroy('70532ec762ca140cec1957ae6b9942311e07cd7104cf54936b1bfbb4a901c2fe'));
        // var_dump(csrf()->check("55b6dfa39e088422083e717feb21d20efe2a8e5e4a82afd0e294d5f79472d688"));
        // var_dump(Database::raw('SELECT * FROM something')->usingData()->execute(function($th){
            // echo "something went wrong";
        // }));
        // var_dump(Database::update('something')->set(['name' => 'ah"iii','age'=>11])->where('id', '=', '274')->execute(function ($th) {
            // var_dump($th);
        // }));
        // var_dump(Database::select('something')->groupBy('id')->get(['name,COUNT(age)'],function($th)
        // {
            // var_dump($th);
        // }));
        // var_dump(Database::raw('SELECT * FROM something WHERE id = ? AND name = ?')->usingData('275','tunk')->execute(function($th){
            // echo "something went wrong";
        // }));
        // Database::insert('something')->columns('name', 'age')->withData(['something',10],['demo','9'])->execute(function ($th) {
            // var_dump($th);  
        // });
        // var_dump(Database::select('something')->where([['age','>=',12],['name','=','tunk'],['name','!=','something']])->where('age','=',12)->orderBy('name')->get());
        // Database::delete('something')->where('id','=','391')->limit(1)->execute(function($th){
            // echo "something went wrong";
        // });
        // var_dump(Database::delete('something')->where([['age','=',"123'"],['id','=','387']])->limit(1)->execute(function($th){
            // echo "something went wrong";
        // }));

        // setcookie('ahihi', 'sdasds1232ahihi', time() + 3600, '/');
        // var_dump(json_encode(base64_encode(json_encode(['ahihi' => 'ahihi','something' => '@@123femsdas']))));
        // var_dump(Auth::use('jwt')->login($request));
        // var_dump($_COOKIE['sdas']);
        // require_once getenv("ROOT_DIR"). "/configs/auth.php";
        // $payload = [];
        // $payload['name'] = 'tunk';
        // $payload['age'] = 12;
        // $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        // $payload['exp'] = time() + Auth['expires'] * 3600;
        // $payload = base64url_encode(json_encode($payload));
        // $signature = base64url_encode(hash_hmac('sha256', "$header.$payload", getenv('JWT_SECRET')));
        // var_dump("$header.$payload.$signature");
        // $_COOKIE['Auth'] = "$header.$payload.$signature";
        // var_dump(Auth::use('jwt')->check($request));
        // var_dump(Auth::use('jwt')->logout($request));
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
        // setHeader('Content-Security-Policy', "default-src 'none'");
        // setHeader('Content-Security-Policy', "style-src 'unsafe-inline'");
        // setCSP('default','none');
        // var_dump(setCSP(['style'=>'unsafe-inline','script'=>'none']));
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName(enco_html("<script>mame?@@.á</script>",true));    
        $view->layout->render();
    }
}