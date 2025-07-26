<?php
function limit($limit, &$statement)
{
    $statement['limit'] = "LIMIT $limit";
    return new DatabaseHandler(['get','getDistinct'], $statement);
}