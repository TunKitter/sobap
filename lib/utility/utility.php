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