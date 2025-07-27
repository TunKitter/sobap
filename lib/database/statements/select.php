<?php
function select($table)
{
    $sql = ['where', 'join','leftJoin', 'rightJoin','orderBy', 'groupBy', 'limit', 'get', 'getDistinct'];
    $statement = ['select' => "SELECT *"];
    $statement['from'] = "FROM $table";
    return new DatabaseHandler($sql, $statement);
}