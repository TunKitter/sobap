<?php
function delete($table)
{
    $statement['delete'] = "DELETE FROM $table ";
    return new DatabaseHandler(['where'], $statement);
}