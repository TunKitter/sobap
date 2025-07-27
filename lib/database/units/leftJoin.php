<?php
function sobap_sql_leftJoin($args, $statement): DatabaseHandler
{
    $statement['join'] = "LEFT JOIN $args[0] ON $args[1] $args[2] $args[3] ";
    return new DatabaseHandler(['where', 'get', 'getDistinct'], $statement);
}