<?php
$file = fopen(".env", "r+");
while ($data = fgets($file)) {
    $data = explode("#", $data)[0];
    $data = trim(str_replace("\"", "", $data));
    putenv($data);
}