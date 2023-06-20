<?php

function up(PDO $pdo) {
    $query = 'CREATE TABLE users (id INT PRIMARY KEY, name VARCHAR(100))';
    $pdo->exec($query);
}

function down(PDO $pdo) {
    $query = 'DROP TABLE users';
    $pdo->exec($query);
}
