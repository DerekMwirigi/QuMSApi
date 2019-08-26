<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $database = 'qms';
    $user = 'root';
    $pass = 'password';
    $host = 'localhost';
    $port = '3309';
    $dir = dirname(__FILE__) . '/dump.sql';
    echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
    exec("mysqldump --user={$user} --password={$pass} --host={$host} --port={$port} {$database} --result-file={$dir} 2>&1", $output);
    exec("notepad");
    var_dump($output);