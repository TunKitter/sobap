<?php
function getDistinct($columns, &$statement)
{
    if (count($columns) == 0) $columns = ['*'];
    $statement['select'] = "SELECT DISTINCT " . implode(',', $columns);
    $sql = '';
    foreach ($statement as $key => $value) $sql .= "$value ";
    $data = Database::getInstance()->prepare($sql);
    $data->execute();
    return $data->fetchAll();
}