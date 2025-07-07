<?php
$file = fopen(".env", "r+");
while ($data = fgets($file)) {
    $data = explode("#", $data)[0];
    $data = trim(str_replace("\"", "", $data));
    if (empty($data)) continue;
    if (strpos($data, '=') !== false) {
        putenv($data);
    }
}
fclose($file);