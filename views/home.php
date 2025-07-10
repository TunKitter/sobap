<?php

class home extends DOMDecorator
{
    public function render()
    {
        View::getView('header')->render();
        parent::render();
        View::getView('footer')->render();
    }
    public function setName(string $name)
    {
        $this->document->getElementsByTagName('a')->item(0)->textContent = $name;
    }
    public function setName2(string $name)
    {
        $this->document->getElementsByTagName('a')->item(1)->textContent = $name;
    }
}