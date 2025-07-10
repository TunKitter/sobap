<?php

class header extends DOMDecorator
{
    public function setup() {
        $this->setName('Homeeeee');
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