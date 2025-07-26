<?php
function withData($args, &$statement) {
    $data = '';
    foreach ($args as $key => $value)  $data .= "('" . implode("','", $value) . "'),";
    $data = trim($data, ',');
    $statement['withData'] = "VALUES $data";
    return new DatabaseHandler(['execute'], $statement);
}