<?php
include "common.php";
$start_letters = strtolower($_POST['start_letters']);
$mid_color = $_POST['mid_color'];
$top_color = $_POST['top_color'];
$clue_length = 0;
if (isset($_POST['clue_length']))
    $clue_length = (int)$_POST['clue_length'];
$mid_clue = $_POST['mid_clue'];
$result = array();
$norepeat = false;
if (isset($_POST['norepeat']))
{
    $norepeat = true;
}
if  ($mid_color && in_array($mid_color,$supportedMidColors)) {
    if ($mid_color == 'white') {
        $result = array($mid_clue);
    }
    if ($mid_color == 'black') {
        $result = array(strrev($mid_clue));
    }
    if ($mid_color == 'red') {
        $in = fopen('words.txt', 'r');
        while (($line = fgets($in)) !== false) {
            try {
                $line = strtolower(rtrim($line, "\n"));
                if ($start_letters === '' || (strpos($line, $start_letters) === 0)) {
                    if ((($clue_length == 0) || (strlen($line) == $clue_length)) && (strlen($line) < strlen($mid_clue))){
                        $last_index = 0;
                        $pass = true;
                        foreach (str_split($line) as $char){
                            $last_index = strpos($mid_clue, $char,$last_index);

                            if ($last_index === false){
                                $pass = false;
                                break;
                            }
                            else
                                ++$last_index;
                        }
                        if ($pass)
                            array_push($result,$line);
                    }
                    if ($line[0] === 'right')
                        print ($line[0].','.$line[1]);
                    if (strlen($line[1]) >= strlen($meta))
                        $len = strlen($line[1]);
                    else
                        $len = strlen($meta);
                    if (similar_text($line[1], $meta) >= ($len - 1))
                        array_push($options,$line[0]);
                }
            }
            catch (Exception $e){
                print ('Message: ' .$e->getMessage());
            }
        }

    }
    if ($mid_color == 'blue') {
        $in = fopen('words.txt', 'r');
        while (($line = fgets($in)) !== false) {
            try {
                $line = strtolower(rtrim($line, "\n"));
                if ($start_letters === '' || (strpos($line, $start_letters) === 0)) {

                    if ((($clue_length == 0) || (strlen($line) == $clue_length)) && (strlen($line) > strlen($mid_clue))){
                        $last_index = 0;
                        $pass = true;
                        foreach (str_split($mid_clue) as $char){
                            $last_index = strpos($line, $char,$last_index);

                            if ($last_index === false){
                                $pass = false;
                                break;
                            }
                            else
                                ++$last_index;
                        }
                        if ($pass){
                            if ($norepeat){
                                $checkletters = array();
                                foreach (str_split($line) as $char){
                                    if (in_array($char, $checkletters)){
                                        $pass = false;
                                        break;
                                    }
                                    else
                                        array_push($checkletters, $char);
                                }
                            }
                            if ($pass){
                                array_push($result,$line);
                            }
                        }
                    }
                    if ($line[0] === 'right')
                        print ($line[0].','.$line[1]);
                    if (strlen($line[1]) >= strlen($meta))
                        $len = strlen($line[1]);
                    else
                        $len = strlen($meta);
                    if (similar_text($line[1], $meta) >= ($len - 1))
                        array_push($options,$line[0]);
                }
            }
            catch (Exception $e){
                print ('Message: ' .$e->getMessage());
            }
        }

    }
}
if  ($top_color && in_array($top_color,$supportedTopColors)) {
    if ($top_color == 'white') {
        print (similar_text('RT', 'RFT'));
        // print(soundex('right').', '.soundex('write'));
        $in = fopen('words.csv', 'r');
        $options = array();
        $meta = metaphone($_GET['top_clue']);
        // print ($meta);
        while (($line = fgetcsv($in)) !== false) {
            try {
                $line = rtrim($line,"\n");
                if ($line[0] === 'right')
                    print ($line[0].','.$line[1]);
                if (strlen($line[1]) >= strlen($meta))
                    $len = strlen($line[1]);
                else
                    $len = strlen($meta);
                // print ('before');
                if (similar_text($line[1], $meta) >= ($len - 1))
                    array_push($options,$line[0]);
            }
            catch (Exception $e){
                print ('Message: ' .$e->getMessage());
            }
        }
        if (count($result)==0)
            $result = $options;
    }
}

// if (count($result)==0)
//     $result = 'Could Not solve';
foreach ($result as $word)
    print($word."<br/>");

?>