<?php
function sobap_sql_withData($args, &$statement): DatabaseHandler
{
    $data = '';
    foreach ($args as $key => $value)  $data .= "('" . implode("','", $value) . "'),";
    $data = trim($data, ',');
    $statement['withData'] = "VALUES $data";
    return new DatabaseHandler(['execute'], $statement);
}