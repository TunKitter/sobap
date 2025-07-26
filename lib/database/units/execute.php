<?php

function execute($args, &$statement)
{
    $data = Database::getInstance()->prepare(trim(implode(' ', $statement)));
    $data->execute();
    return $data->fetchAll();
}