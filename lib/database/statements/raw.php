<?php
function raw($query): DatabaseHandler
{
    return new DatabaseHandler(['usingData'], ['raw' => $query]);
}