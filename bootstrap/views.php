<?php
require_once getenv('ROOT_DIR') . "/lib/view/Dom.php";
class View
{
    private static function getSingleView($view)
    {
        $path = getenv('ROOT_DIR') . "/views/" . $view . ".html";
        $file = fopen($path, "r");
        return fread($file, filesize($path));
    }
    private static function getSingleHandler($handler, $document) {
        require getenv('ROOT_DIR') . "/views/" . $handler . ".php";
        $data = explode('/', $handler);
        $handler = end($data);
        return new $handler($document);
    }

    public static function getView($view, $handler = null)
    {
        $html = '';
        if (gettype($view) == 'string') $html = static::getSingleView($view);
        else foreach ($view as $v) $html .= static::getSingleView($v);
        $document = new DomDocument();
        @$document->loadHTML($html);
        if ($handler == null) return new DOMDecorator($document);
        elseif (gettype($handler) == 'string') return static::getSingleHandler($handler, $document);
        $hs = new stdClass;
        foreach ($handler as $h) 
         {
            $data = explode('/', $h);
            $data = end($data);
            $hs->{$data} = static::getSingleHandler($h, $document);
         }
        $hs->base = new DOMDecorator($document);
        return $hs;
    }
}