<?php
// connectie met de database
$db = new PDO('sqlite:' . __DIR__ . '/anime.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// tabel maken als die er nog niet is
$db->exec("CREATE TABLE IF NOT EXISTS anime (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titel TEXT NOT NULL,
    genre TEXT NOT NULL,
    afleveringen INTEGER NOT NULL,
    jaar INTEGER NOT NULL,
    studio TEXT NOT NULL
)");
