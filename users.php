<?php
$USERS_FILE = __DIR__ . '/users.json';

// Чтение пользователей из JSON
function loadUsers() {
    global $USERS_FILE;
    if (!file_exists($USERS_FILE)) return [];
    $json = file_get_contents($USERS_FILE);
    return json_decode($json, true) ?: [];
}

// Сохранение пользователей в JSON
function saveUsers($users) {
    global $USERS_FILE;
    file_put_contents($USERS_FILE, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$USERS = loadUsers();
?>