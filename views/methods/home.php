<?php

class home extends DOMDecorator
{
    public function setName(string $name)
    {
        $this->document->getElementsByTagName('h1')->item(0)->textContent = $name;
    }
}