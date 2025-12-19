<?php
$db = new PDO('sqlite:'.__DIR__.'/../database/database.sqlite');
$st = $db->query('SELECT id,email,password,role FROM users');
foreach ($st as $r) {
    echo $r['id'].' '.$r['email'].' '.substr($r['password'],0,10).' role:'.($r['role'] ?? '').PHP_EOL;
}
