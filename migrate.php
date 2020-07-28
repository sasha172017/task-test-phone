<?php

include (__DIR__ . '/config/autoload.php');

$migration = new \Database\Migration\Migration_create_table_phone_country_code();
$migration->up();
