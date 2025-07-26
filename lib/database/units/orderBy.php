<?php
function orderBy($column, $order, &$statement)
{
    $statement['orderBy'] = "ORDER BY $column $order";
    return new DatabaseHandler(['limit','get','getDistinct'], $statement);
}