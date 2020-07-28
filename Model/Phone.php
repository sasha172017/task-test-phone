<?php


namespace Model;

use Database\DB;
use PDO;

class Phone
{
    public function getCountryCode()
    {
        $db = DB::getInstance();
        try {
            $result = $db->query("SELECT * FROM country_code")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
            $countryCode = array_map('reset', $result);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
        return $countryCode;
    }

    public function getNumbers()
    {
        $db = DB::getInstance();
        try {
            $query = $db->query("SELECT n.id, n.value, cc.id, cc.value AS code FROM number as n
                                               INNER JOIN country_code AS cc
                                               ON cc.id = n.country_code_id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
        return $result;
    }

    public function getTotalCountNumbers(){
        $db = DB::getInstance();
        try {
            $query = $db->query("SELECT COUNT(*) AS total_count FROM number");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
        return $result;
    }

    public function getCountryCodeWithNumber()
    {
        $db = DB::getInstance();
        try {
            $query = $db->query("SELECT cc.value AS code,
                                            GROUP_CONCAT(n.value SEPARATOR '/') AS numbers
                                            FROM country_code AS cc
                                            INNER JOIN number AS n
                                            ON cc.id = n.country_code_id
                                            GROUP BY cc.id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
        return $result;
    }

    public function insertNumber(array $countForEach)
    {
        $db = DB::getInstance();
        $insert = $db->prepare("INSERT INTO number (`value`, country_code_id) VALUES (?, ?)");
        try {
            $db->beginTransaction();
            foreach ($countForEach as $id => $numbers) {
                foreach ($numbers as $number) {
                    $insert->execute([$number, $id]);
                }
            }
            $db->commit();
            return true;
        } catch (\Exception $e) {
            $db->rollback();
            throw $e;
        }
    }
}