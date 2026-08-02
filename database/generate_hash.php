<?php
$hash = password_hash('password123', PASSWORD_DEFAULT);
echo $hash . "\n";
var_dump(password_verify('password123', $hash)); // doit afficher bool(true)