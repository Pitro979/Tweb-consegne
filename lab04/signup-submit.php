<?php 
    include "top.html";
    //update file
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data= implode(',',$_POST);
        $data=$data."\n";
        file_put_contents("singles.txt",$data,FILE_APPEND);
    }
    //Draw screen with user name
?>

<div>
    <p><strong>Thank you!</strong></p>
    <p>Welcome to NerdLuv, <?= $_POST['name']; ?></p>
    <p>Now <a href="matches.php">log in to see your matches!</a></p>
</div>

<?php include "bottom.html" ?>