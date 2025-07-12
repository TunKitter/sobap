<?php
class Demo extends Validate
{
    public function justDemo()
    {
        $this->handleValidate($this->input === 'demo', 'justDemo', 'This is just demo');
        return $this;
    }
}