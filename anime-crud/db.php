<?php
$db = new PDO('sqlite:' . __DIR__ . '/ingredienten.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
