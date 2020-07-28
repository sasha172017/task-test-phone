<?php


namespace Validate;


use Database\DB;
use PDO;

class PhoneValidate extends Validate
{
    public function isCountryCode(array $codes)
    {
        $db = DB::getInstance();
        $sql = 'SELECT id FROM country_code WHERE ID IN(';
        $countCode = count($codes);
        $i = 0;
        $newCountArray = [];
        foreach ($codes as $key => $code) {
            $i = $i + 1;
            $newKey = ":Key$key";
            $sql = $sql . $newKey;
            if ($i != $countCode) {
                $sql = $sql . ', ';
            }
            $newCountArray[$newKey] = $code;
        }
        $sql = $sql . ')';
        $query = $db->prepare($sql);
        $query->execute($newCountArray);
        $result = $query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
        $isCodes = [];
        foreach ($result as $key => $item) {
            $isCodes[] = $key;
        }
        $diff = array_diff($codes, $isCodes);
        if (count($diff) == 0) {
            return true;
        }
        $this->setOneError('Country Code', ['exist' => 'does not exist this code country ']);
        return false;
    }

    public function requiredCount($count)
    {
        if (trim($count) == '') {
            $this->setOneError('Count', ['required' => 'does not exist this code country ']);
            return false;
        }
    }

    public function intCount($count)
    {
        if (!is_int($count)) {
            $this->setOneError('Count', ['int' => 'this field should not be int']);
            return false;
        }
    }

    public function isZero($count)
    {
        if ($count === 0) {
            $this->setOneError('Count', ['zero' => 'this field should not be zero']);
            return false;
        }
    }
}