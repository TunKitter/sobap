<?php
function limit($limit, &$statement)
{
    $limit = implode(',', $limit);
    $statement['limit'] = "LIMIT $limit";
    return new DatabaseHandler(['get','getDistinct'], $statement);
}