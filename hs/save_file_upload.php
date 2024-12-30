<?php
include 'hsfileutils.php';

// print $_FILES["saveFile"]["tmp_name"];
try{
    //checks for errors
    if ($_FILES['saveFile']['error'] == UPLOAD_ERR_OK               
    && is_uploaded_file($_FILES['saveFile']["tmp_name"])) { //checks that file is uploaded
        $save_contents = file_get_contents($_FILES['saveFile']["tmp_name"]); 
        $total_steps = substr($save_contents, 0, 10);

        $save_data = unscramble($save_contents, (int)$total_steps);
        $data = json_decode($save_data, true);
        print $save_data;

    }
} catch(Exception $e){
    echo $e->getMessage();
}



?>