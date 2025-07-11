<?php

class header extends DOMDecorator
{
    public function render()
    {
        parent::render();
        echo "Welcome to us";
    }

}