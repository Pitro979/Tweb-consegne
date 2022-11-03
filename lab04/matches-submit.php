<?php include "top.html";
//function to check personality compatibility
function check_pers($usr,$comp){
    return $usr[0]==$comp[0] ||
    $usr[1]==$comp[1] ||
    $usr[2]==$comp[2] ||
    $usr[3]==$comp[3];
}

//Map data using arr
function map($usr_data){
    $ret = array(
    "name" => $usr_data[0],
    "gender" => $usr_data[1],
    "age" => $usr_data[2],
    "personality" => $usr_data[3],
    "os" => $usr_data[4],
    "min_age" => $usr_data[5],
    "max_age" => $usr_data[6],
    );
    //Check if gender preference is specifed
    if(array_key_exists(7,$usr_data)){
        $ret["wants"] = $usr_data[7];
    }
    return $ret;
}
//Check compatibility
function is_compatible($user_data,$single_data,$desired){
    return (strcmp($desired,'A') or $single_data["gender"]==$desired)
    && $single_data["age"]<=$user_data["max_age"]
    && $single_data["age"]>=$user_data["min_age"]
    && check_pers($user_data["personality"],$single_data["personality"])
    && $single_data["os"] == $user_data["os"];
}
//Get data for user and potential matches
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $usr=$_GET['name'];

    $users=file("singles.txt");
    foreach($users as $comp){
        $comp_arr=explode(',',$comp);
        if($comp_arr[0]==$usr){
            $usr_data=map($comp_arr);
        }
        else{
            $singles[]=map($comp_arr);
        }
    }
}
?>

<p><strong>Matches for <?= $usr_data['name'] ?></strong></p><br>

<?php 
    if(array_key_exists("wants",$usr_data)){
        $desired=$usr_data["wants"];
    }
    else if($usr_data["gender"] == "M"){
        $desired="F";
    }
    else{
        $desired="M";
    }
    foreach($singles as $single){
        if(is_compatible($usr_data,$single,$desired)){
?>
                <div class="match">
                    <p><?=$single["name"] ?></p>
                    <img src="https://courses.cs.washington.edu/courses/cse190m/12sp/homework/4/user.jpg" alt="user-img">
                    <ul>
                        <li><strong>gender: </strong><?= $single['gender'] ?></li>
                        <li><strong>age: </strong><?= $single['age'] ?></li>
                        <li><strong>type: </strong><?= $single['personality'] ?></li>
                        <li><strong>os: </strong><?= $single['os'] ?></li>
                    </ul>
                </div>
            <?php
        };
    }
?> 

<?php include "bottom.html"; ?>