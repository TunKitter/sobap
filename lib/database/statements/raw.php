<?php
function raw($query): DatabaseHandler
{
    return new DatabaseHandler(['execute'], ['raw' => $query]);
}