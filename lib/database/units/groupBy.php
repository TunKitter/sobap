<?php
function groupBy($groupBy, &$statement) {
    $statement['groupBy'] = "GROUP BY $groupBy";
    return new DatabaseHandler(['limit','get','orderBy','getDistinct'], $statement);
}