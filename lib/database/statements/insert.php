<?php
function insert($table)
{
    $statement['insert'] = "INSERT INTO $table ";
    return new DatabaseHandler(['columns'], $statement);
}