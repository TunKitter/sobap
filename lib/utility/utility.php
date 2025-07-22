<?php
function handleExceptionWithDebug(int $index)
{
    if (!is_int($index) || $index < 0) {
        throw new InvalidArgumentException('Index must be a non-negative integer');
    }
    $mode = getenv("MODE");
    switch ($mode) {
        case "DEV":
            $debugs = debug_backtrace();
            $html = new DOMDocument;
            $html->loadHTMLFile(__DIR__ . DIRECTORY_SEPARATOR . "trace.html");
            $xpath = new DOMXPath($html);
            $wrapper = $xpath->query("//div[contains(@class,'traces')]");
            if ($wrapper->length === 0 || !isset($debugs[$index])) {
                throw new RuntimeException("Trace container not found in template");
            }
            $traceDiv = $html->createElement("div");
            $traceDiv->setAttribute("class", "trace");
            $wrapper->item(0)->appendChild($traceDiv);
            $strong = $html->createElement("strong");
            $strong->nodeValue = "Found a problem: ";
            $span_file = $html->createElement("i");
            $span_file->setAttribute("class", "trace_file");
            $span_file->nodeValue = htmlspecialchars($debugs[$index]['file'], ENT_QUOTES, 'UTF-8');
            $span = $html->createElement("b");
            $span->setAttribute("class", "trace_line");
            $span->nodeValue = htmlspecialchars($debugs[$index]['line'], ENT_QUOTES, 'UTF-8');
            $prob = $html->createElement("div");
            $prob->appendChild($strong);
            $prob->appendChild($html->createTextNode(" "));
            $prob->appendChild($span);
            $prob->appendChild($span_file);
            $prob->appendChild($html->createTextNode(" at line "));
            $prob->appendChild($span);
            $traceDiv->appendChild($prob);
            $span = $html->createElement("span");
            $span->setAttribute("class", "trace_detail");
            $span->nodeValue = htmlspecialchars($debugs[$index]['args'][0], ENT_QUOTES, 'UTF-8');
            $detail = $html->createElement("div");
            $detail_title = $html->createElement("strong");
            $detail_title->nodeValue = "Detail: ";
            $detail->appendChild($detail_title);
            $detail->appendChild($span);
            $traceDiv->appendChild($detail);
            exit($html->saveHTML());
        case "PROD":
            return null;
    }
}