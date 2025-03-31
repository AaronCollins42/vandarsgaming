<?php 
include "common.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lingo Panel Solver</title>
</head>
<body>

    <form action="panelresult.php" method="post" enctype="multipart/form-data">
    <h1>Lingo Panel Solver</h1>
    <h2>Mid</h2>
    <p>
    <label for="mid_color">Middle Color</label>
    <select name="mid_color">
            <?php
            foreach ($supportedMidColors as $x) {
                echo '<option>'.$x.'</option>';
            }
            ?>
        </select><br/>
        <label for="mid_clue">Middle Clue</label>
        <input type="text" name="mid_clue" id="mid_clue">(separate with commas if you have more than one clue that give the same answer)<br/>
        <input type="checkbox" name="norepeat" id="norepeat">
        <label for="norepeat">Disallow Repeated uses of letters</label><br/>
        <label for="clue_length">Answer Length</label>
        <input type="text" name="clue_length" id="clue_length"><br/>
        <label for="clue_length">Starting Letters</label>
        <input type="text" name="start_letters" id="clue_length"><br/>
        <input type="submit" value="Submit" name="submit">
    </p>
    </form>

</body>
</html>
