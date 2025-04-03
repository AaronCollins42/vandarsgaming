<?php
include_once "common.php";
include "blue.php";
include "red.php";

$start_letters = strtolower($_POST['start_letters']);
$mid_color = $_POST['mid_color'];
// $top_color = $_POST['top_color'];
$clue_length = 0;
if (isset($_POST['clue_length']))
    $clue_length = (int)$_POST['clue_length'];
$mid_clue = strtolower($_POST['mid_clue']);
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
        $clues = explode(',', $mid_clue);
        $result = mid_red($clues,$norepeat,$start_letters, $clue_length);

    }
    if ($mid_color == 'blue') {
        $clues = explode(',', $mid_clue);
        $result = mid_blue($clues,$norepeat,$start_letters, $clue_length);
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