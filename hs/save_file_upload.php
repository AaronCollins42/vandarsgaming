<?php
include 'hsfileutils.php';

function read_save_file() {
    try{
        //checks for errors
        if ($_FILES['saveFile']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['saveFile']["tmp_name"])) { //checks that file is uploaded
            $save_contents = file_get_contents($_FILES['saveFile']["tmp_name"]);
            $total_steps = substr(string: $save_contents, offset: 0, length: 10);

            $save_data = unscramble($save_contents, (int)$total_steps);
            $data = json_decode($save_data, true);
            return $data;


        }
    } catch(Exception $e){
        print $e->getMessage();
    }
}


?>