<?php
function groupBy($groupBy, &$statement) {
    $statement['groupBy'] = "GROUP BY {$groupBy[0]}";
    return new DatabaseHandler(['limit','get','orderBy','getDistinct'], $statement);
}