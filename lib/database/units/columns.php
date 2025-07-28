<?php
function sobap_sql_columns($columns, &$statement): DatabaseHandler
{
    $statement['columns'] = '(' . implode(',', $columns) . ') ';
    return new DatabaseHandler(['withData'], $statement);
}