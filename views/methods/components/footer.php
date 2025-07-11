<?php

class footer extends DOMDecorator
{
    public function render()
    {
        parent::render();
        echo "Copyright " . date('Y');
    }
}