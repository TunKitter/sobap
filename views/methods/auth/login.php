<?php

class login extends DOMDecorator
{
    public function setName(string $name)
    {
        $this->document->getElementsByTagName('h2')->item(0)->textContent = $name;
    }
}