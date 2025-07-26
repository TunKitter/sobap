<?php
function raw($query)
{
    return new DatabaseHandler(['execute'], ['raw' => $query]);
}