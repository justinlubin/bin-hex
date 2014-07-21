<?php

class Utility {
    public static function formatHundredth($number) {
        $stringNumber = '' . $number;
        if($number < 10) {
            $stringNumber = '0' . $stringNumber;
        }
        if($number < 100) {
            $stringNumber = '0' . $stringNumber;
        }
        return substr($stringNumber, 0, strlen($stringNumber) - 2) . "." . substr($stringNumber, strlen($stringNumber) - 2); 
    }
}