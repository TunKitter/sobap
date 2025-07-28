<?php
function sobap_sql_join($args, &$statement): DatabaseHandler
{
    if (!isset($statement['join'])) $statement['join'] = '';
    $statement['join'] .= "INNER JOIN $args[0] ON $args[1] $args[2] $args[3] ";
    return new DatabaseHandler(['where', 'join', 'get', 'getDistinct'], $statement);
}