<?php

include (__DIR__ . '/config/autoload.php');

$db = \Database\DB::getInstance();

$codes = [
    '+63','+672','+90','+1','+1242','+380','+1264','+1670','+20','+224'
];
$stmt = $db->prepare("INSERT INTO country_code (`value`) VALUES (?)");

try {
    $db->beginTransaction();
    foreach ($codes as $code)
    {
        $stmt->execute([$code]);
    }
    $db->commit();
    print("Created Fake Data Code.\n");
}catch (Exception $e){
    $db->rollback();
    throw $e;
}
