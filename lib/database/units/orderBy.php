<?php
function sobap_sql_orderBy($order, &$statement): DatabaseHandler
{
    $order = implode(' ', $order);
    $statement['orderBy'] = "ORDER BY $order";
    return new DatabaseHandler(['limit','get','getDistinct'], $statement);
}