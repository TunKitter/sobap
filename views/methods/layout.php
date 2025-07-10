<?php

class layout extends DOMDecorator
{
    public function render()
    {
        View::getView('views/components/header', 'methods/components/header')->render();
        parent::render();
        View::getView('views/components/footer', 'methods/components/footer')->render();
    }
}