<?php
// include "../index.php";
// index.php
header('Content-Type: application/json');// NGUBAH FORMAT JSON
header('Access-Control-Allow-Origin: http://localhost:3000'); // API React

$users = [
    ['id' => 1, 'name' => 'John Doe'],
    ['id' => 2, 'name' => 'Jane Smith'],
    ['id' => 3, 'name' => 'Hylmi Muhammad Fiary Mahdi'],
];

echo json_encode($users);
?>