<?php
function sobap_sql_get($columns, &$statement)
{
   if (empty($columns)) $columns = ['*'];
    $statement['select'] = "SELECT " . implode(',', $columns);
    $sql = '';
    foreach ($statement as $key => $value) $sql .= "$value ";
    $data = Database::getInstance()->prepare($sql);
    $data->execute();
    return $data->fetchAll();
}