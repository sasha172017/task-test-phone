<?php


namespace Controller;


use Model\Phone;
use Validate\PhoneValidate;

class PhoneController extends Controller
{
    public function create()
    {
        $result = null;
        $phoneValidate = new PhoneValidate();
        $phone = new Phone();
        $codes = $phone->getCountryCode();

        if ($this->isPost()) {
            $count = intval($this->post('count'));
            $postCodes = $this->post('code');
            $phoneValidate->isCountryCode($postCodes);
            $phoneValidate->requiredCount($count);
            $phoneValidate->intCount($count);
            $phoneValidate->isZero($count);
            if ($phoneValidate->isValid()) {
                $postCodes = array_unique($postCodes);
                $countForEach = [];
                $newCount = 0;
                $i = 1;
                shuffle($postCodes);
                foreach ($postCodes as $key => $code) {
                    if ($i == count($postCodes)) {
                        $minInt = $count - $newCount;
                    } else {
                        $minInt = 1;
                    }
                    $maxInt = $count - $newCount - count($postCodes) + $i;
                    $rand = rand($minInt, $maxInt);
                    $countForEach[$code] = [];
                    for($j = 0; $j < $rand; $j++){
                        $countForEach[$code][] = $codes[$code]['value'] . rand(1000000000,9999999999);
                    }
                    $newCount = $newCount + $rand;
                    $i++;
                }
                $result = $phone->insertNumber($countForEach);
                header('Location: /show');
            }
        }
        $errors = $phoneValidate->getError();
        require(__DIR__ . '/../View/phone/create.php');
        return true;
    }

    public function show(){
        $data = $this->data();
        $totalCount = $data['totalCount'];
        $moreCountryCount = $data['moreCountryCount'];
        $lessCountryCount = $data['lessCountryCount'];
        $countryCodeWithNumbers = $data['countryCodeWithNumbers'];
        require(__DIR__ . '/../View/phone/show.php');
        return true;
    }

    public function report(){
        $data = $this->data();
        $totalCount = $data['totalCount'];
        $moreCountryCount = $data['moreCountryCount'];
        $lessCountryCount = $data['lessCountryCount'];
        $countryCodeWithNumbers = $data['countryCodeWithNumbers'];
        $numbersExplode = $data['numbersExplode'];

        header('Content-Type: text/html; charset=windows-1251');
        header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-transfer-encoding: binary');
        header('Content-Disposition: attachment; filename=numbers.xls');
        header('Content-Type: application/x-unknown');

        echo include(__DIR__ . '/../View/phone/report.php');
    }

    public function data(){
        $phone = new Phone();
        $totalCount = $phone->getTotalCountNumbers();
        $numbers = [];
        $countryCodeWithNumber = $phone->getCountryCodeWithNumber();
        $moreCountryCount = ['count' => 0, 'code' => null];
        $lessCountryCount = ['count' => 0, 'code' => null];
        $countryCodeWithNumbers = [];
        foreach ($countryCodeWithNumber as $item) {
            $countryCodeWithNumbers[] = ['code' => $item['code'], 'numbers' => strtr($item['numbers'], '/', ' ')];
            $arrayNumber = explode('/', $item['numbers']);
            $countArrayNumber = count($arrayNumber);
            $numbers[$item['code']]['count'] = $countArrayNumber;
            if($countArrayNumber > $moreCountryCount['count']){
                $moreCountryCount = ['count' => $countArrayNumber, 'code' => $item['code']];
            }
            if($lessCountryCount['count'] == 0){
                $lessCountryCount = ['count' => $countArrayNumber, 'code' => $item['code']];
            }elseif ($countArrayNumber < $lessCountryCount['count']){
                $lessCountryCount = ['count' => $countArrayNumber, 'code' => $item['code']];
            }
            $numbers[$item['code']][] = $arrayNumber;
        }
        return [
            'totalCount' => $totalCount,
            'moreCountryCount' => $moreCountryCount,
            'lessCountryCount' => $lessCountryCount,
            'countryCodeWithNumbers' => $countryCodeWithNumbers,
            'numbersExplode' => $numbers
        ];
    }
}