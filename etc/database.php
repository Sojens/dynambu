<?php

$host = '127.0.0.1';    // DBM_SETUP_REPLACE_HOST
$db   = 'dynambu';      // DBM_SETUP_REPLACE_DB
$user = '';             // DBM_SETUP_REPLACE_USER
$pass = '';             // DBM_SETUP_REPLACE_PASS
$charset = 'utf8mb4';   // DBM_SETUP_REPLACE_CHARSET

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $db = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

#PDO::ATTR_EMULATE_PREPARES = true;

function db_query($query, $args = []) {
    
    global $db;
    $q = $db->prepare($query);
    $q->execute($args);
    return $q;
    
}

?>
