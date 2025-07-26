<?php
function get($columns, &$statement)
{
    $type = gettype($columns);
    if ($type == 'string')
        $columns = [$columns];
    elseif ($type == 'array' && count($columns) == 0)
        $columns = ['*'];
    $statement['select'] = "SELECT " . implode(',', $columns);
    $sql = '';
    foreach ($statement as $key => $value) {
        $sql .= "$value ";
    }
    $data = Database::getInstance()->prepare($sql);
    $data->execute();
    return $data->fetchAll();
}