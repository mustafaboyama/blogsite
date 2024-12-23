<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $link_dbms=mysqli_connect("localhost","root","");
    if($link_dbms==false){
         die("Error".mysqli_connect_error()."<br>");
     }
 
    echo "Connected succesfully".mysqli_get_host_info($link_dbms)."<br>";


     $sql ="CREATE DATABASE Blog";

     if(mysqli_query($link_dbms,$sql)){
        echo "Database created successfully";
     }
     else{
        echo "Error ".mysqli_error($link_dbms);
     }
     
    ?>
</body>
</html>