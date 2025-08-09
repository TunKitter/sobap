<?php
function createDynamicClass()
{
    return new class {
        public function __construct(private stdClass $handlers = new stdClass())
        {
        }
        public function __set($name, $value)
        {
            $this->handlers->{$name} = $value;
        }
        public function __get($name)
        {
            return $this->handlers->{$name};
        }
        public function __call($name, $arguments)
        {
            return ($this->handlers->{$name})(...$arguments);
        }
    };
}

function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}


function setHeader($type,$value)
{
    header("$type: $value");
}
function setCSP($args) {
    if(headers_sent()) return false;
    $check = [
        'default' =>['self','none'],
        'script' =>['self','unsafe-inline','unsafe-eval','none'],
        'style' =>['self','unsafe-inline','none'],
        'img' =>['self']
    ];
    $header = '';
    foreach ($args as $key => $value) {
        if(!isset($check[$key]) || !in_array($value,$check[$key])) return false;
        $header .= "$key-src '$value';";
    }
    setHeader('Content-Security-Policy',$header);
    return true;
}
function setCORS(string $origin) {
    if(headers_sent()) return false;
    setHeader('Access-Control-Allow-Origin',$origin);
    return true;
}
function csrf() {
    require_once getenv("ROOT_DIR") . "/configs/csrf.php";
    return new class {
        public function render() {
            $token = bin2hex(random_bytes(32));
            $dir = getenv('ROOT_DIR'). "/lib/csrf/sessions/$token";
            $file = fopen($dir, 'w');
            fwrite($file, time() + CSRF['expires']);
            fclose($file);
            return $token;
        }
        public function check(string $token) {
            if(file_exists(getenv('ROOT_DIR'). "/lib/csrf/sessions/$token")) {
                if(time() < file_get_contents(getenv('ROOT_DIR'). "/lib/csrf/sessions/$token")) return 1;
                else {
                    unlink(getenv('ROOT_DIR'). "/lib/csrf/sessions/$token");
                    return 0;
                }
            }
            return -1;
        }
        public function destroy(string $token) {
            if(file_exists(getenv('ROOT_DIR'). "/lib/csrf/sessions/$token")) 
                return unlink(getenv('ROOT_DIR'). "/lib/csrf/sessions/$token");
            return false;
        }
    };
}
function enco_html($text,$full = false)
{
    if($full) return htmlentities($text, ENT_QUOTES, 'UTF-8');
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}