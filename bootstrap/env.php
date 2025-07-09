<?php
$file = fopen(".env", "r");
while ($data = fgets($file)) {
    $data = explode("#", $data)[0];
    $data = trim(str_replace("\"", "", $data));
    if (empty($data)) continue;
    if (strpos($data, '=') !== false) {
        putenv($data);
    }
}
fclose($file);
putenv("ROOT_DIR=" . (substr(__DIR__, 0, strrpos(__DIR__, DIRECTORY_SEPARATOR, -1))));