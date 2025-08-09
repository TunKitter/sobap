<?php
function sobap_sql_where($args, &$statement): DatabaseHandler
{
    $sql = '';
    switch (gettype($args[0])) {
        case 'string': {
            $sql = "{$args[0]} {$args[1]} ? ";
            $statement['data'][] = $args[2];
            break;
        }
        case 'array': {
            foreach ($args[0] as $where) {
                $sql .= "AND {$where[0]} {$where[1]} ? ";
                $statement['data'][] = $where[2];
            }
            $sql = trim(ltrim($sql, 'AND'));
            break;
        }
    }
    $sql = "(" . trim(ltrim($sql, 'AND')) . ")";
    if (!isset($statement['where'])) $statement['where'] = "WHERE $sql";
    else $statement['where'] .= " OR $sql";
    return new DatabaseHandler(['limit', 'get','execute', 'orderBy', "groupBy", 'getDistinct', 'where'], $statement);
}