<?php
function sobap_sql_withData($args, &$statement): DatabaseHandler
{
    $data = '';
    foreach ($args as $key => $value){
        $data .= "(". ltrim(str_repeat(',?', count($value)), ',') ."),";
        array_map(function($item) use (&$statement) {
            $statement['data'][] = $item;
        },$value);
    };
    $data = trim($data, ',');
    $statement['withData'] = "VALUES $data";
    return new DatabaseHandler(['execute'], $statement);
}