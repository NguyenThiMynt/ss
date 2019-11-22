<?php
/**
 * Created by PhpStorm.
 * User: sato
 */

define("REGEX_PASSWORD", '/^.{8,30}$/');
define("REGEX_EMAIL", '/(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/');

define("API_RET_SUCCESS", true);
define("API_RET_FAIL", false);

function genUUIDv4(){
    return Ramsey\Uuid\Uuid::uuid4()->toString();
}

function isUUIDv4($id){
    $regex = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    if (!preg_match($regex, $id)) {
        return false;
    }
    return true;
}

/**
 * function avoid case: 65105/(449*0.2) = 725.0 but floor or int is converted to 724
 * @param $number
 * @return int
 */
function roundDown($number){
    $strNumber = strval($number);
    $intVal = intval($strNumber);
    return $intVal;
}

function timeNowInMillis(){
    return round(microtime(true) * 1000);
}