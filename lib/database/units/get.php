<?php
function sobap_sql_get($columns, &$statement)
{
    if (count($columns) == 0) $columns = ['*'];
    $statement['select'] = "SELECT " . implode(',', $columns);
    $sql = '';
    foreach ($statement as $key => $value) $sql .= "$value ";
    $data = Database::getInstance()->prepare($sql);
    $data->execute();
    return $data->fetchAll();
}