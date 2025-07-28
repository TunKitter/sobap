<?php
function handleErrorWithDebug($errno, $errstr, $errfile, $errline)
{
    handleExceptionWithDebug(new ErrorException($errstr, $errno, 0, $errfile, $errline));
}
function handleExceptionWithDebug(Throwable $debugs)
{
    function createItem($html, string $name, ...$children)
    {
        $element = $html->createElement('div');
        $item = $html->createElement('strong');
        $item->appendChild($html->createTextNode(htmlspecialchars("$name: ", ENT_QUOTES, 'UTF-8')));
        $element->appendChild($item);
        foreach ($children as $child) {
            switch (gettype($child)) {
                case 'string':
                    $element->appendChild($html->createTextNode($child));
                    break;
                case 'array': {
                    $i = $html->createElement($child[0]);
                    $i->appendChild($html->createTextNode($child[1]));
                    $element->appendChild($i);
                    break;
                }
            }
        }
        return $element;
    }
    $mode = getenv("MODE");
    switch ($mode) {
        case "DEV":
            $html = new DOMDocument;
            @$html->loadHTMLFile(getenv('ROOT_DIR') . "\\lib\\utility\\trace.html");
            $xpath = new DOMXPath($html);
            $wrapper = $xpath->query("//div[contains(@class,'traces')]");
            $traceDiv = $html->createElement("div");
            $traceDiv->setAttribute("class", "trace");
            $wrapper->item(0)->appendChild($traceDiv);
            $prob = createItem($html, 'Found a problem', ['i', $debugs->getFile()], ' at line ', ['b', $debugs->getLine()]);
            $detail = createItem($html, 'Detail', ['i', $debugs->getMessage()]);
            $traceDiv->appendChild($prob);
            $traceDiv->appendChild($detail);
            foreach (explode("\n", $debugs->getTraceAsString()) as $key => $trace) {
                $item = createItem($html, $key + 1, str_replace("#$key", '', $trace));
                $traceDiv->appendChild($item);
            }
            exit($html->saveHTML());
        case "PROD":
            return null;
        default:
            throw new Exception("Invalid environment mode");
    }
}