<?php
include "../common.php";

function set_tokens() {
    global $allsokenbangames;
    global $areainfo;
    try {
        //checks for errors
        if ($_FILES['saveFile']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['saveFile']["tmp_name"])) { //checks that file is uploaded
            $save_data = file_get_contents($_FILES['saveFile']["tmp_name"]);
            $newvalue = $_POST['tokenNumber'];
            $n = 16 + count($allsokenbangames);
            // Load inventory
            // print (save_data[n:n+2])
            $SAVEinventorytokens = $newvalue;
            while (strlen($SAVEinventorytokens) < 2) {
                $SAVEinventorytokens = "0" . $SAVEinventorytokens;
            }
            $save_data = substr($save_data,0,$n) . $SAVEinventorytokens . substr($save_data,$n + 2);
            header ("Content-Type: application/octet-stream");
            header ("Content-disposition: attachment; filename=SAVE.txt");
            print($save_data);


        }
    } catch (Exception $e) {
        print("Could not load save file");
    }
}


    set_tokens();
?>