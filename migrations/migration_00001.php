<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */

$server_db_prefix = AfwSession::currentDBPrefix();
try {
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
