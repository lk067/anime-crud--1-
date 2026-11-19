<?php
// connectie met de database
// LOKAAL testen op je Mac: SQLite bestand
$db = new PDO('sqlite:' . __DIR__ . '/ingredienten.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
