<?php
function sobap_sql_get($args, &$statement)
{    
    try {   
        $prepare = [];
        if(isset($statement['data'])) {
            $prepare = $statement['data'];
            unset($statement['data']);
        }
     if (empty($args[0])) $args[0] = ['*'];
     $statement['select'] = "SELECT " . implode(',', $args[0]);
     $sql = '';
     foreach ($statement as $key => $value) $sql .= "$value ";
     $data = Database::getInstance()->prepare($sql);
     $data->execute($prepare);
    return $data->fetchAll();
    } catch (\Throwable $th) {
        if(isset($args[1])) $args[1]($th);
        return false;
    }
}