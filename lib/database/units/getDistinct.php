<?php
function getDistinct($columns, &$statement)
{
    $type = gettype($columns);
    if ($type == 'string') $columns = [$columns];
    elseif ($type == 'array' && count($columns) == 0) $columns = ['*'];
    $statement['select'] = "SELECT DISTINCT " . implode(',', $columns);
    $sql = '';
    foreach ($statement as $key => $value) {
        $sql .= "$value ";
    }
    $data = Database::getInstance()->prepare($sql);
    $data->execute();
    return $data->fetchAll();
}