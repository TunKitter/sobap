<?php
require_once getenv('ROOT_DIR') . "/lib/view/Dom.php";
class G
{
    public static function getView($view, $handler = null): DOMDecorator
    {
        $path = getenv('ROOT_DIR') . "/views/" . $view . ".html";
        $file = fopen($path, "r");
        $document = new DomDocument();
        @$document->loadHTML(fread($file, filesize($path)));
        fclose($file);
        if ($handler == null) return new DOMDecorator($document);
        require getenv('ROOT_DIR') . "/views/" . $handler . ".php";
        return new $handler($document);
    }
}