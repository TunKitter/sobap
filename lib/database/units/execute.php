<?php

function sobap_sql_execute($args, &$statement)
{
    try {   
    $prepare = [];
    if(isset($statement['data'])) {
        $prepare =$statement['data'];
        unset($statement['data']);
    }
    $data = Database::getInstance()->prepare(trim(implode(' ', $statement)));
    $data->execute($prepare);
    return $data->fetchAll();
    } catch (\Throwable $th) {
        if(isset($args[0])) $args[0]($th);
        return false;
    }
}