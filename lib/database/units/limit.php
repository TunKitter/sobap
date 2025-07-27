<?php
function sobap_sql_limit($limit, &$statement): DatabaseHandler
{
    $limit = implode(',', $limit);
    $statement['limit'] = "LIMIT $limit";
    return new DatabaseHandler(['get','getDistinct'], $statement);
}