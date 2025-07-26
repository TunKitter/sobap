<?php
function columns($columns, &$statement)
{
    $statement['columns'] = '(' . implode(',', $columns) . ') ';
    return new DatabaseHandler(['withData'], $statement);
}