<?php
include 'hsfileutils.php';

// print $_FILES["saveFile"]["tmp_name"];
try{
    //checks for errors
    if ($_FILES['saveFile']['error'] == UPLOAD_ERR_OK               
    && is_uploaded_file($_FILES['saveFile']["tmp_name"])) { //checks that file is uploaded
        $save_contents = file_get_contents($_FILES['saveFile']["tmp_name"]); 
        $total_steps = substr($save_contents, 0, 10); // text2
        // $save_contents = substr($save_contents, 10, strlen($save_contents));
        // print $total_steps;
        // print "<br />";
        // print $save_contents;
        $save_data = unscramble($save_contents, (int)$total_steps);
        // print $save_data;

    }
} catch(Exception $e){
    echo $e->getMessage();
}



?>