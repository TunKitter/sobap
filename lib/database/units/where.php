<?php
function where($wheres, &$statement)
{
    $sql = '';
    foreach ($wheres as $where) {
        $sql .= "AND {$where[0]} {$where[1]} '{$where[2]}' ";
    }
    $sql = "(" . trim(ltrim($sql, 'AND')) . ")";
    if (!isset($statement['where'])) $statement['where'] = "WHERE $sql";
    else $statement['where'] .= " OR $sql";
    return new DatabaseHandler(['limit', 'get', 'orderBy', "groupBy", 'getDistinct', 'where'], $statement);
}