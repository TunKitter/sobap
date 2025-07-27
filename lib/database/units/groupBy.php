<?php
function sobap_sql_groupBy($groupBy, &$statement): DatabaseHandler
{
    $statement['groupBy'] = "GROUP BY {$groupBy[0]}";
    return new DatabaseHandler(['limit','get','orderBy','getDistinct'], $statement);
}