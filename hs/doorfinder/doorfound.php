<?php
include '../save_file_upload.php';


function rand_lookup($missing_doors)
{
    include 'hinttext.php';
    if ($missing_doors != null && sizeof($missing_doors) > 0)
    {
            $rand_num = rand(0,sizeof($missing_doors)-1);

            $rand_door = $missing_doors[$rand_num];
            $split_rand_door = explode(":", $rand_door);
            $door_map = explode(".",$split_rand_door[0])[0];
            $doorColor = "Gold";

            if ($split_rand_door[1] == "s")
                $doorColor = "Silver";

            $doorText = $HINT_TEXT[$door_map][0];

            print "<br/>";
            print "One ".$doorColor." Door is ".$doorText;
    }
}


$data = read_save_file();
// $door_lines = file_get_contents("doors.txt"); 
$missing_doors = array();

foreach(file("doors.txt") as $line) {
    // print $line."<br/>";
    $split_line = explode(':',$line);
    //print_r( $split_line);//."<br/>"."<br/>";
    if (!array_key_exists($split_line[0],$data["flags"])) 
    {
        $missing_doors[] = $line;
    }
}
if (sizeof($missing_doors) > 0)
    print "You have ". sizeof($missing_doors) ." doors left to find";
else
    print "You seem to have opened all Gold and Silver Doors";

rand_lookup($missing_doors);



?>
