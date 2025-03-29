<HTML>
<head>
    <script>
        function GetRandomPopText()
        {
            text = ''
            switch (Math.floor(Math.random()*3)) {
                case 0:
                    text += '1.72 Left feet detected, expected integer, consult doctor if problem persists....\n';
                    break;
                case 1:
                    text += 'Out of Cheese Error. Redo from start....\n';
                    break;
                case 2:
                    text += 'left foot detector not enabled....\n';
                    break;
                default:
                    text += "Maybe I don't know how rands work...\n";
            }
            text += 'Bypassing left foot detector....\n';
            text += '........\n........\n\n';
            text += 'Are you sure you wish to continue and reveal spoilers?';
            return confirm(text);
        }
    </script>
    <style>
        #textarea {
            display: none; /* hidden by default */
        }

        #textarea:target {
            display: block; /* shown when a link targeting this id is clicked */
        }

        #textarea + ul.controls {
            list-style-type: none; /* aesthetics only, adjust to taste, irrelevant to demo */
        }

        /* hiding the hide link when the #textarea is not targeted,
        hiding the show link when it is selected: */
        #textarea + ul.controls .hide,
        #textarea:target + ul.controls .show {
            display: none;
        }

        /* Showing the hide link when the #textarea is targeted,
        showing the show link when it's not: */
        #textarea:target + ul.controls .hide,
        #textarea + ul.controls .show {
            display: inline-block;
        }

    </style>
</head>
<body>
<?php
include "../common.php";


function checksokobanmachines() {
    global $allsokenbangames;
    global $areainfo;
    try {
        //checks for errors
        if ($_FILES['saveFile']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['saveFile']["tmp_name"])) { //checks that file is uploaded
            $save_data = file_get_contents($_FILES['saveFile']["tmp_name"]);

            $n = 15;
            $i = 0;
            $count_unfound = 0;
            $count_optimized = 0;
            $count_done = 0;
            print('<p>Machines left to optimize:</p>');
            print('<ul>');
            // print_r($gamesdone);
            $unfound_data= '<ul>';
            while ($i < count($allsokenbangames)) {
                if ($areainfo[$i]['moves'] != 0) {
                    if (((int)$save_data[$n]) == 1)
                    {
                        ++$count_done;
                        print(sprintf('<li>Machine #%d (%s): {%s}</li>', $i, $allsokenbangames[$i],$areainfo[$i]["loc"]));
                    } else if (((int)$save_data[$n]) == 0) {
                        $unfound_data .= sprintf('<li>Machine #%d (%s): {%s}</li>', $i, $allsokenbangames[$i],$areainfo[$i]["loc"]);

                        ++$count_unfound;
                    } else {
                        ++$count_optimized;
                    }
                }
                ++$n;
                ++$i;
            }
            $unfound_data.='</ul>';
            print('</ul>');
            if (($count_unfound + $count_optimized + $count_done) != 100)
                print ("Something went wrong");
            print(sprintf('<p>You have %d machine(s) left to find</p>', $count_unfound,$count_unfound + $count_optimized + $count_done));

            // Hidden Stuff below
            print('<div id="textarea">');
            print(sprintf('<p>With a total of %d machines altogether</p>',$count_unfound + $count_optimized + $count_done));
            print(sprintf('<p>Unfound machines can be found in the following locations:</p>',$count_unfound + $count_optimized + $count_done));
            print ($unfound_data);
            print('</div>');
            print('<ul class="controls">');
            print('<li class="show">');
            print('<a href="#textarea" onclick="return GetRandomPopText()">To show Spoilers click here and wiggle your left foot</a></li>');
            print('<li class="hide"><a href="#">Hide Spoiler zone</a></li>');
            print('</ul>');

            }
        } catch (Exception $e) {
            print("Could not load save file");
        }
}


checksokobanmachines();

?>
</body>
</HTML>