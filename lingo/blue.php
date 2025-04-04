<?php
include_once "common.php";

function mid_blue_check($clue, $line): bool{
    $last_index = 0;
    $pass = true;
    foreach (str_split($clue) as $char){
        $last_index = strpos($line, $char,$last_index);

        if ($last_index === false){
            $pass = false;
            break;
        }
        else
            ++$last_index;
    }
    return $pass;
}

function mid_blue($clues, $norepeat, $start_letters,$clue_length): array {
    $res = array();
    $in = fopen('words.txt', 'r');
    while (($line = fgets($in)) !== false) {
        try {
            $line = strtolower(rtrim($line, "\n"));
            if ($start_letters === '' || (strpos($line, $start_letters) === 0)) {
                if ($norepeat && !check_norepeat($line)){
                    continue;
                }
                // If string matches clue length go ahead
                if (($clue_length == 0) || (strlen($line) == $clue_length)){
                    $pass = true;
                    foreach ($clues as $clue) {
                        // If the string is smaller than any of the clues we fail.
                        if ($pass && (strlen($line) <= strlen($clue)))
                            $pass = false;

                        // If it doesn't follow the rules it fails move along
                        if ($pass && !mid_blue_check($clue, $line)){
                            $pass = false;
                        }
                    }
                    if ($pass)
                        array_push($res,$line);
                }
            }
        }
        catch (Exception $e){
            print ('Message: ' .$e->getMessage());
        }
    }
    return $res;
}

?>