<?php

class header2 extends DOMDecorator
{
    public function setupMe()
    {
        $this->setName('DEmooooooo');
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