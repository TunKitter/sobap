<?php
require_once getenv("ROOT_DIR"). "/configs/auth.php";
function auth_jwt()
{
    return new class implements AuthMethod {
        public function check(Request $request): array
        {
            $return = ['status' => false,'data'=> null];
            $token = $request->cookie('Auth', null);
            if ($token === null) return $return;
            $data = explode('.', $token);
            if (count($data) !== 3) return $return;
            [$header, $payload, $signature] = $data;
            $expected_header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
            if(!hash_equals($header,$expected_header)) return $return;
            $expected_signature = base64url_encode(hash_hmac('sha256', "$header.$payload", getenv('JWT_SECRET')));
            if (!hash_equals($signature, $expected_signature)) return $return;
            $time = json_decode(base64url_decode($payload), true);
            if(!isset($time['exp']) || !is_numeric($time['exp'])) return $return;
            $time = $time['exp']; 
            if (time() > $time) return $return;
            if(file_exists($path = getenv('ROOT_DIR'). "/lib/auth/methods/jwt_blacklist/$signature")) {
                $file = fopen($path, 'r');
                $time = fread($file, filesize($path));
                fclose($file);
                if(time() < $time) return $return;
                setcookie('Auth', '', time() - 100);
                unlink($path);
                return $return;
            }
            $return['status'] = true;
            $return['data'] = json_decode(base64url_decode($payload), true);
            return $return;
        }

        public function generate(array $payload): string
        {
            $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
            $payload['exp'] = time() + Auth['expires'] * 3600;
            $payload = base64url_encode(json_encode($payload));
            $signature = base64url_encode(hash_hmac('sha256', "$header.$payload", getenv('JWT_SECRET')));
            return "$header.$payload.$signature";
        }

        public function login(Request $request): bool
        {
            $payload = [];
            foreach(Auth['data'][2] as $value) {
                $data = $request->get($value, null);
                if ($data === null || Validate::from($data)->alphaNumeric()->validate()['is_error'] ) return false;
                $payload[] = [$value,'=',$data];
            }
            $data = Database::select(Auth['data'][0])->where($payload)->limit(1)->get(...Auth['data'][1]);
            if(count($data) === 0) return false;
            setcookie('Auth', $this->generate($data), time() + Auth['expires'] * 3600);
            return true;
        }

        public function logout(Request $request): bool
        {
            $data = $this->check($request);
            if($data['status'] === false) return false;
            $signature = explode('.', $request->cookie('Auth', null))[2];
            $dir = getenv('ROOT_DIR'). "/lib/auth/methods/jwt_blacklist/$signature";
            $file = fopen($dir, 'w');
            fwrite($file, $data['data']['exp']);
            fclose($file);
            setcookie('Auth', '', time() - 100);
            return true;
        }
    };
}
