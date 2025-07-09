<?php
function handle_http_method($args, Request $data)
{
    for ($i = 1; $i < count($args); $i++) {
        switch (gettype($args[$i])) {
            case 'object':
                if (is_callable($args[$i])) $args[$i]($data);
                break;
            case 'string': {
                require_once getenv('ROOT_DIR') . "/handlers/" . substr($args[$i], 0, strrpos($args[$i], '::')) . ".php";
                $call = substr($args[$i], ($p = strrpos($args[$i], '/', -1)) != false ? $p + 1 : 0);
                $call($data);
                break;
            }
            default:
                if (is_callable($args[$i])) $args[$i]($data);
                break;
        }
    }
}