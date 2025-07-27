<?php

function sobap_sql_execute($args, &$statement)
{
    $data = Database::getInstance()->prepare(trim(implode(' ', $statement)));
    $data->execute();
    return $data->fetchAll();
}