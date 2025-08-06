<?php
function sobap_sql_usingData($args, &$statement): DatabaseHandler
{
    if(count($args) != substr_count($statement['raw'], '?')) throw new Exception("Invalid statement");
    foreach($args as $key => $value) $statement['data'][] = $value;
    return new DatabaseHandler(['execute'], $statement);
}