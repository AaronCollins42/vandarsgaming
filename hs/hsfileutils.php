<?php

function flip($s) {
    $text = "";
    $num = min(8, strlen($s));
    for ($i = $num - 1; $i >= 0; $i--)
    {
        $text .= $s[$i];
    }
    return $text;
}

function unshift($s, $offset) {
    $text = "";
    $num = min(8, strlen($s));
    $offset = min($num - 1, $offset);

    for ($i = strlen($s) - $offset; $i < $num; $i++)
    {
        $text .= $s[$i];
    }
    for ($j = 0; $j < strlen($s) - $offset; $j++)
    {
        $text .= $s[$j];
    }
    return $text;
}


function decode($s,$seed) {

    $text = $s;
    if (($seed + 1) % 3 == 0)
        $text = flip($text);
    
    if ($seed % 3 == 0 && strlen($s) == 8)
        $stuff = ($seed + 5) % 7 + 1;
        $text = unshift($text, $stuff);
    
    if (($seed + 2) % 3 == 0)
        $text = flip($text);
    
    if ($seed % 3 == 0)
        $text = flip($text);
    
    if (($seed + 2) % 3 == 0 && strlen($s) == 8)
        $text = unshift($text, ($seed + 3) % 7 + 1);
    
    if (($seed + 1) % 3 == 0)
        $text = flip($text);
    
    if (($seed + 2) % 3 == 0)
        $text = flip($text);
    if (($seed + 1) % 3 == 0 && strlen($s) == 8)
        $text = unshift($text, $seed % 7 + 1);
    
    if ($seed % 3 == 0)
        $text = flip($text);
    
    return $text;
}

function unscramble($text, $totalSteps) {
    // print $text;
    $text2 = substr($text, 10);
    $text3 = substr($text2, 0, 4);
    $text2_len = strlen($text2);
    for ($i = 0; $i <= ($text2_len - 4) / 8; $i++)
    {
        $s = substr($text2, min($text2_len - 1, $i * 8 + 4), min(8, $text2_len - ($i * 8 + 4)));
        $text3 .= decode($s, $totalSteps + $i);
    }
    $text2 = $text3;
    $text3 = "";
    $text2_len = strlen($text2);
    for ($j = 0; $j <= $text2_len / 8; $j++)
    {
        $s2 = substr($text2, $j * 8, min(8, $text2_len - $j * 8));

        $text3 .= decode($s2, $TotalSteps + $j);
        print $text3;
        print '<br/>';
        print '<br/>';
    }
    return $text3;
}

?>