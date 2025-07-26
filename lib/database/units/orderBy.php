<?php
function orderBy($order, &$statement)
{
    $order = implode(' ', $order);
    $statement['orderBy'] = "ORDER BY $order";
    return new DatabaseHandler(['limit','get','getDistinct'], $statement);
}