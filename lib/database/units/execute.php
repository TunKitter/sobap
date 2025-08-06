<?php

function sobap_sql_execute($args, &$statement)
{
    try {   
    $prepare =$statement['data'];
    unset($statement['data']);
    $data = Database::getInstance()->prepare(trim(implode(' ', $statement)));
    $data->execute($prepare);
    return $data->fetchAll();
    } catch (\Throwable $th) {
        $args[0]($th);
        return false;
    }
}