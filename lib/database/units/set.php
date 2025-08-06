<?php
function sobap_sql_set($args, &$statement): DatabaseHandler
{
    $sql = '';
    foreach ($args[0] as $key => $value) {
        $sql .= "$key = ?,";
        $statement['data'][] = $value;
    }
    $sql = trim($sql, ',');
    $statement['set'] = "SET $sql ";
    return new DatabaseHandler(['where','execute'], $statement);
}