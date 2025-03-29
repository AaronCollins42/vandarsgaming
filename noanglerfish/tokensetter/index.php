<!DOCTYPE html>
<html>
<head>
    <title>No Anglerfish Machine Checker</title>
</head>
<body>
    <form action="tokenset.php" method="post" enctype="multipart/form-data">
        <h1>Welcome to the No Anglerfish Token Setter.</h1>
        <p>Select Save File to upload (These can be found in the install folder of the game):</p>
        <p><input type="file" name="saveFile" id="saveFile" /><br/></p>
        <p>Number of tokens to set for your save (This is the new value not added)<input type="number" name="tokenNumber" id="tokenNumber"/><br/></p>
        <p><input type="submit" value="Upload Save File" name="submit" /></p>
        <br/>
        <p style="color:red;">* Reminder to backup your old save before applying this one</p>
    </form>
</body>
</html>
