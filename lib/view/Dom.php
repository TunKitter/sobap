<?php
class DOMDecorator
{
    protected DOMDocument $document;
    public function __construct(DOMDocument $document)
    {
        $this->document = $document;
        method_exists($this, 'setup') && $this->setup();
    }
    public function query(string $query)
    {
        $xpath = new DOMXPath($this->document);
        return $xpath->query($query);
    }
    public function render()
    {
        echo $this->document->saveHTML();
    }
}