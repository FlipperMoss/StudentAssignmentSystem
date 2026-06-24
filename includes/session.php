<?php
$projectRoot = __DIR__;

if (basename($projectRoot) === 'student' || basename($projectRoot) === 'lecturer') {
    $projectRoot = dirname($projectRoot);
}

$sessionDir = $projectRoot . '/sessions';

if (!is_dir($sessionDir)) {
    mkdir($sessionDir, 0777, true);
}

session_save_path($sessionDir);
session_start();
