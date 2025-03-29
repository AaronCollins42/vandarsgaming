<?php
$supportedTopColors = array();
$supportedMidColors = array('blue', 'red', 'white', 'black');
$supportedBotColors = array();


function check_norepeat($line): bool{
    $res = true;
    $checkletters = array();
    foreach (str_split($line) as $char){
        if (in_array($char, $checkletters)){
            $res = false;
            break;
        }
        else
            array_push($checkletters, $char);
    }
    return $res;
}

?>