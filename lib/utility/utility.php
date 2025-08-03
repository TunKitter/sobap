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
