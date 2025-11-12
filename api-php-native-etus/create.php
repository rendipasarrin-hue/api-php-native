<?php
$password="223611198";
// password enkripsi password
$password_hash = password_hash($password, PASSWORD_DEFAULT);
//menampilakan password_hash
echo $password_hash;