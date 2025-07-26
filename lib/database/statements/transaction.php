<?php
function transaction($callback)
{
    $db = Database::getInstance();
    $db->beginTransaction();
    $callback(Database::class, fn() => $db->commit(), fn() => $db->rollBack());
}