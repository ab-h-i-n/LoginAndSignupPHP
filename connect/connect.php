<?php

$dbcon = mysqli_connect("localhost","root","","mydb");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

