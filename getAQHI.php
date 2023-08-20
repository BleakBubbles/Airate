<?php

$host = "localhost";
$dbname = "user_db";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT total, count FROM location";  //This is where I specify what data to query
$result = mysqli_query($conn, $sql);

$data = array();
while($enr = mysqli_fetch_assoc($result)){
    $a = array($enr['total'], $enr['count']);
    array_push($data, $a);
}

echo json_encode($data);