<?php
function update($table)
{
    $statement['update'] = "UPDATE $table ";
    return new DatabaseHandler(['set'], $statement);
}