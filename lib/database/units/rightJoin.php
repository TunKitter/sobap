<?php
function sobap_sql_rightJoin($args, $statement): DatabaseHandler
{
    $statement['join'] = "RIGHT JOIN $args[0] ON $args[1] $args[2] $args[3] ";
    return new DatabaseHandler(['where', 'get', 'getDistinct'], $statement);
}