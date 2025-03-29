<?php
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
?>