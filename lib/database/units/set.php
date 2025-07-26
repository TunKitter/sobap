<?php
function set($args, &$statement)
{
    $sql = '';
    foreach ($args[0] as $key => $value) $sql .= "$key = '$value',";
    $sql = trim($sql, ',');
    $statement['set'] = "SET $sql ";
    return new DatabaseHandler(['where','execute'], $statement);
}